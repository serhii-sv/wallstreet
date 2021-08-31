<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Backup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

/**
 * Class BackupController
 * @package App\Http\Controllers
 */
class BackupController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $backups = Backup::all();

        return view('pages.backups.index', compact('backups'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function backupDB()
    {
        Artisan::call('make:backup', ['--mode' => 'only-db']);
        return back()->with('success_short', 'Резервная копия создана');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $backup = Backup::findOrFail($id);
        $checkExists = Storage::disk('do_spaces')->exists($backup->path);

        if (false === $checkExists) {
            $backup->delete();

            return redirect()->route('backup.index')->with('error_short', 'Файл не найден');
        }

        Storage::disk('do_spaces')->delete($backup->path);
        $backup->delete();

        return back()->with('success_short', 'Резервная копия удалена');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function download($id)
    {
        $backup = Backup::findOrFail($id);
        $checkExists = Storage::disk('do_spaces')->exists($backup->path);

        if (false === $checkExists) {
            $backup->delete();

            return redirect()->route('backup.index')->with('error_short', 'Резервная копия не найдена');
        }

        return redirect()->to(Storage::disk('do_spaces')->url($backup->path));
    }
}
