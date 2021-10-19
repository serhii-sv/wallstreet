<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Models\CloudFile;
use App\Models\CloudFileFolder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/*
 * Cloud files in Digital Ocean. Visual uploading/downloading/viewing.
 */

class CloudFilesController extends Controller
{
    /**
     * Manage files
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manager(Request $request, $view='manager')
    {
        /** @var CloudFile $files */
        $files = CloudFile::orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $files->where('name', 'like', '%' . strtolower($request->search) . '%');
        }

        if ($request->has('folder')) {
            $files = CloudFileFolder::findOrFail($request->folder)->files()->paginate(50);
        } else {
            $files = $files->paginate(50);
        }

        $filesTotalCount = CloudFile::count();

        $filesByFolders = [];

        foreach (CloudFileFolder::all() as $folder) {
            $filesByFolders[] = [
                'folder' => $folder,
                'totalCount' => $folder->files->count()
            ];
        }

        return view('pages.cloud_files.'.$view, [
            'files' => $files,
            'filesByFolders' => $filesByFolders,
            'filesTotalCount' => $filesTotalCount
        ]);

    }//end manager()

    /**
     * Upload files
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function upload(UploadFileRequest $request)
    {
        $file = $request->file('file');
        $folder_id = $request->folder_id;
        $newName = md5($file->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $file->getExtension();

        try {
            DB::transaction(function () use ($newName, $file, $folder_id) {
                if (!is_null($folder_id)) {
                    $folder = CloudFileFolder::findOrFail($folder_id);

                    $upload = Storage::disk('do_spaces')->putFileAs(
                        $folder->folder_name, $file, $newName
                    );
                } else {
                    $upload = Storage::disk('do_spaces')->put($newName, $file, 'private');
                }

                $user = auth()->user();

                /** @var User $createdBy */
                $createdBy = $user;

                $cloudFile = CloudFile::create([
                    'created_by' => $createdBy->id,
                    'name' => strtolower($file->getClientOriginalName()),
                    'ext' => $file->getExtension(),
                    'mime' => $file->getMimeType(),
                    'url' => $upload,
                    'cloud_file_folder_id' => $folder_id,
                    'last_access' => null,
                    'size' => $file->getSize(),
                ]);
            });
        } catch (\Exception $exception) {
            die($exception->getMessage());
            // TODO: make controller notifications
        }

        // TODO: make controller notifications
        return redirect()->route('cloud_files.manager', !is_null($folder_id) ? ['folder' => $folder_id] : [])
            ->with('success_short', 'Файл успешно загружен');
    }//end upload()

    /**
     * Open file
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function open(Request $request, string $id)
    {
        /** @var CloudFile $file */
        $file = CloudFile::findOrFail($id);

        $checkExists = Storage::disk('do_spaces')->exists($file->url);

        if (false === $checkExists) {
            $file->delete();

            // TODO: make controller notifications
            return redirect()->route('cloud_files.manager')->with('error_short', 'Файл не найден в облаке. По этому мы его сейчас удалили из базы данных.');
        }

        $fileFromStorage = Storage::disk('do_spaces')->get($file->url);

        $file->last_access = now();
        $file->save();

        return response($fileFromStorage, 200, [
            'Content-type' => $file->mime,
        ]);
    }//end manager()

    /**
     * Destroy files
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Request $request, string $id)
    {
        /** @var CloudFile $file */
        $file = CloudFile::findOrFail($id);

        $checkExists = Storage::disk('do_spaces')->exists($file->url);

        if (false === $checkExists) {
            $file->delete();

            // TODO: make controller notifications
            return redirect()->route('cloud_files.manager')->with('error_short', 'Файл не найден в облаке. По этому мы его сейчас удалили из базы данных.');
        }

        $deleteFromStorage = Storage::disk('do_spaces')->delete($file->url);
        $file->delete();

        // TODO: make controller notifications
        return redirect()->route('cloud_files.manager', !is_null($request->folder_id) ? ['folder' => $request->folder_id] : [])
            ->with('success_short', 'Файл успешно удален');
    }//end destroy()

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function folderCreate(Request $request)
    {
        $folder = CloudFileFolder::where('folder_name', $request->folder_name)->first();

        if (!is_null($folder)) {
            return redirect()->route('cloud_files.manager')->with('error_short', 'Такая папка уже существует.');
        }

        CloudFileFolder::create([
            'folder_name' => $request->folder_name
        ]);

        Storage::disk('do_spaces')->makeDirectory($request->folder_name);

        return redirect()->route('cloud_files.manager')->with('success_short', 'Папка успешно добавлена.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function folderDestroy($id)
    {
        $folder = CloudFileFolder::findOrFail($id);

        if (is_null($folder)) {
            return redirect()->route('cloud_files.manager')->with('error_short', 'Такой папки не существует.');
        }

        $folder->files()->delete();
        $folder->delete();

        Storage::disk('do_spaces')->deleteDirectory($folder->folder_name);

        return redirect()->route('cloud_files.manager')->with('success_short', 'Папка успешно удалена.');
    }

    public function perfectmoneyLayout(Request $request)
    {
        return $this->manager($request, 'perfectmoney.layout');
    }

    public function perfectmoneyPage(Request $request)
    {
        return view('pages.cloud_files.perfectmoney.index');
    }


}//end class
