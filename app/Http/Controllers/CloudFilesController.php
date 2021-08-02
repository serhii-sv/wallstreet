<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Models\CloudFile;
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
    public function manager(Request $request)
    {
        /** @var CloudFile $files */
        $files = CloudFile::orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $files->where('name', 'like', '%'.strtolower($request->search).'%');
        }

        $files = $files->paginate(50);

        return view('pages.cloud_files.manager', [
            'files' => $files,
        ]);

    }//end manager()

    /**
     * Upload files
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function upload(UploadFileRequest $request)
    {
        $file       = $request->file('file');
        $newName    = md5($file->getClientOriginalName().rand(0, 1000000).microtime()).'.'.$file->getExtension();

        try {
            DB::transaction(function() use($newName, $file) {
                $upload = Storage::disk('do_spaces')->put($newName, $file, 'private');

                /** @var User $createdBy */
                $createdBy = auth()->user();

                $cloudFile = CloudFile::create([
                    'created_by'    => $createdBy->id,
                    'name'          => strtolower($file->getClientOriginalName()),
                    'ext'           => $file->getExtension(),
                    'mime'          => $file->getMimeType(),
                    'url'           => $upload,
                    'last_access'   => null,
                    'size'          => $file->getSize(),
                ]);
            });
        } catch (\Exception $exception) {
            die($exception->getMessage());
            // TODO: make controller notifications
        }

        // TODO: make controller notifications
        return redirect()->route('cloud_files.manager')->with('success', 'Файл успешно загружен');
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
            return redirect()->route('cloud_files.manager')->with('error', 'Файл не найден в облаке. По этому мы его сейчас удалили из базы данных.');
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
            return redirect()->route('cloud_files.manager')->with('error', 'Файл не найден в облаке. По этому мы его сейчас удалили из базы данных.');
        }

        $deleteFromStorage = Storage::disk('do_spaces')->delete($file->url);
        $file->delete();

        // TODO: make controller notifications
        return redirect()->route('cloud_files.manager')->with('success', 'Файл успешно удален');
    }//end destroy()


}//end class
