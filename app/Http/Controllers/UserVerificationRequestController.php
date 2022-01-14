<?php

namespace App\Http\Controllers;

use App\Models\Setting;
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
            $verificationRequests = UserVerification::where('accepted', false)->where('rejected', false)
                ->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            $recordsFiltered = $verificationRequests->count();
            $verificationRequests->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($verificationRequests->get() as $verificationRequest) {
                $data[] = [
                    'empty' => '',
                    'email' => $verificationRequest->user->email,
                    'timer_buttons' => view('pages.user-verification-requests.partials.timer_buttons', compact('verificationRequest'))->render(),
                    'timer_left' => view('pages.user-verification-requests.partials.timer_left', compact('verificationRequest'))->render(),
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

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function reject($id)
    {
        $verificationRequest = UserVerification::findOrFail($id);

        $request_updated = $verificationRequest->update([
            'rejected' => true,
        ]);

        if ($request_updated) {
            return redirect(route('verification-requests.index'))->with('success_short', 'Заявка отклонена');
        }

        return back()->with('error_short', 'Заявка не отклонена');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTimerStatus(Request $request)
    {
        try {
            Setting::setValue('autoaccept_documents_timer_enablde', $request->timer);
            return back()->with('success_short', $request->timer == 'on' ? 'Таймер включен' : 'Таймер отключен');
        } catch (\Exception $exception) {
            return back()->with('error_short', 'Действие невозможно');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTimerHours(Request $request)
    {
        try {
            Setting::setValue('autoaccept_documents_timer_hours', $request->hours);
            return response()->json([
                'success' => true,
                'message' => 'Количество часов обновлено до: ' . $request->hours
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Действие невозможно'
            ]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAutoAccept(Request $request, $id)
    {
        $verificationRequest = UserVerification::findOrFail($id);

        if ($verificationRequest->update([
            'autoaccept' => $request->timer == 'on'
        ])) {
            return back()->with('success_short', $request->timer == 'on' ? 'Таймер включен' : 'Таймер отключен');
        }
        return back()->with('error_short', 'Действие невозможно');
    }
}
