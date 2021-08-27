<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreReferral;
use App\Http\Requests\RequestUpdateRefferal;
use App\Models\Referral;
use App\User;
use Illuminate\Http\Request;

/**
 * Class ReferralController
 * @package App\Http\Controllers
 */
class ReferralController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $referrals = Referral::orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            $recordsFiltered = $referrals->count();
            $referrals->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($referrals->get() as $referral) {
                $data[] = [
                    'empty' => '',
                    'level' => $referral->level,
                    'percent' => $referral->percent . '%',
                    'on_load' => $referral->on_load ? 'Да' : 'Нет',
                    'on_profit' => $referral->on_profit ? 'Да' : 'Нет',
                    'on_task' => $referral->on_task ? 'Да' : 'Нет',
                    'actions' => view('pages.referrals.partials.actions', compact('referral'))->render(),
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => Referral::count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('pages.referrals.index');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.referrals.create');
    }

    /**
     * @param RequestStoreReferral $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(RequestStoreReferral $request)
    {
        $referral = Referral::create($request->except([
            'on_load',
            'on_profit',
            'on_task',
        ]));

        if (!$referral) {
            return back()->with('error_short', __('Unable to create referral level'))->withInput($request->input());
        }

        $referral->on_load = !empty($request->on_load) ? 1 : 0;
        $referral->on_profit = !empty($request->on_profit) ? 1 : 0;
        $referral->on_task = !empty($request->on_task) ? 1 : 0;
        $referral->save();

        return redirect()->route('referrals.index')->with('success_short', __('Referral level has been created'));
    }

    /**
     * @param $referral
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($referral)
    {
        $referral = Referral::findOrFail($referral);
        return view('pages.referrals.edit', [
            'referral' => $referral
        ]);
    }

    /**
     * @param RequestUpdateRefferal $request
     * @param $referral
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RequestUpdateRefferal $request, $referral)
    {
        $referral = Referral::findOrFail($referral);
        $referral->update($request->except([
            'on_load',
            'on_profit',
            'on_task',
        ]));

        if (!$referral) {
            return back()->with('error_short', __('Unable to update referral level'))->withInput($request->input());
        }

        $referral->on_load = !empty($request->on_load) ? 1 : 0;
        $referral->on_profit = !empty($request->on_profit) ? 1 : 0;
        $referral->on_task = !empty($request->on_task) ? 1 : 0;
        $referral->save();

        return redirect()->route('referrals.index')->with('success_short', __('Referral level has been updated'));
    }

    /**
     * @param $referral
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($referral)
    {
        $referral = Referral::find($referral);

        if ($referral->delete()) {
            return redirect()->route('referrals.index')->with('success_short', __('Referral level has been deleted'));
        }

        return redirect()->route('referrals.index')->with('error_short', __('Unable to delete referral level'));
    }
}
