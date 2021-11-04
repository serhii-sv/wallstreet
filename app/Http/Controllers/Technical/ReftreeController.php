<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Technical;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ReftreeController
 * @package App\Http\Controllers\Technical
 */
class ReftreeController extends Controller
{
    /**
     * @param null $id
     * @return null|string
     * @throws \Exception
     */
    public function show($id = null)
    {
        if (null == $id) {
            throw new \Exception('reftree id is null');
        }

        /** @var User $user */
        $user = User::findOrFail($id);

        return view('pages.users.reftree', [
            'referrals_data' => $user->referrals()
                ->wherePivot('line', 1)
                ->first(),
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function referralsRedistribution(Request $request, $id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        return response()->json($user->referralsRedistribution($request->referrals));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addReferral(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $request->new_referral)) {
            /** @var User $referral */
            $referral = User::where('id', $request->new_referral)
                ->first();
        } else {
            /** @var User $referral */
            $referral = User::orWhere('email', $request->new_referral)
                ->orWhere('login', $request->new_referral)
                ->first();
        }

        if (is_null($referral)) {
            return response()->json([
                'success' => false,
                'message' => 'Пользователь с таки данными не зарегистрирован'
            ]);
        }

        if ($referral->id == $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Нельзя стать собственным рефералом'
            ]);
        }

        if (in_array($referral->id, $user->referrals()->pluck('id')->toArray())) {
            return response()->json([
                'success' => false,
                'message' => 'Пользователь уже является рефералом'
            ]);
        }

        if ($referral->partner_id == $user->my_id || $user->partner_id == $referral->my_id) {
            return response()->json([
                'success' => false,
                'message' => 'Нельзя создавать взаимную связь рефералов, выберите другого пользователя'
            ]);
        }

        $referral->partners()->sync([]);
        $referral->referrals()->detach($user->id);

        $referral->partner_id = $user->my_id;
        $referral->save();

        $referral->generatePartnerTree();

        return response()->json([
            'success' => true,
            'message' => 'Добавлен новый реферал'
        ]);
    }


}
