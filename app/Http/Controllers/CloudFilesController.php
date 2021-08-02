<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
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
    public function manager()
    {
        $files = Storage::disk(config('filesystems.default'))->allFiles('/');

        $view = view('pages.cloud_files.manager', [
            'files' => $files,
        ]);
        return $view;

    }//end manager()

    /**
     * Upload files
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function upload(Request $request)
    {
//        $files = Storage::disk(config('filesystems.default'))->allFiles('/');
//
//        $view = view('pages.cloud_files.manager', [
//            'files' => $files,
//        ]);
//        return $view;

    }//end upload()

    /**
     * Destroy files
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Request $request)
    {
//        $files = Storage::disk(config('filesystems.default'))->allFiles('/');
//
//        $view = view('pages.cloud_files.manager', [
//            'files' => $files,
//        ]);
//        return $view;

    }//end destroy()


}//end class
