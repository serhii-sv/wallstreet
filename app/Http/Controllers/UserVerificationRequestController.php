<?php

namespace App\Http\Controllers;

use App\Models\UserVerification;
use Illuminate\Http\Request;

class UserVerificationRequestController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $verificationRequests = UserVerification::where('accepted', false)
                ->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            $recordsFiltered = $verificationRequests->count();
            $verificationRequests->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($verificationRequests->get() as $verificationRequest) {
                $data[] = [
                    'email' => $verificationRequest->user->email,
                    'created_at' => $verificationRequest->created_at->format('d-m-Y H:i'),
                    'actions' => view('pages.user-verification-requests.partials.actions', compact('verificationRequest'))->render()
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => UserVerification::where('accepted', true)->count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('pages.user-verification-requests.index');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $verificationRequest = UserVerification::findOrFail($id);
        return view('pages.user-verification-requests.show', compact('verificationRequest'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id)
    {
        $verificationRequest = UserVerification::findOrFail($id);

        $request_updated = $verificationRequest->update([
            'accepted' => true,
        ]);

        $user_updated = $verificationRequest->user()->update([
            'documents_verified' => true
        ]);

        if ($request_updated && $user_updated) {
            return redirect(route('verification-requests.index'))->with('success_short', 'Заявка подтверждена');
        }

        return back()->with('error_short', 'Заявка не подтверждена');
    }
}
