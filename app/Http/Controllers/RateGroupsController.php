<?php

namespace App\Http\Controllers;

use App\Models\RateGroup;
use Illuminate\Http\Request;

class RateGroupsController extends Controller
{
    //
    public function index() {

        return view('pages.rate-groups.index',[
            'rate_groups' => RateGroup::orderBy('id', 'desc')->get(),
        ]);
    }
    
    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'reinvest' => 'required',
            'refund_deposit' => 'required',
        ]);
        if (RateGroup::where('id', $request->get('id'))->first()->update($request->all())){
            return redirect()->back()->with('success', 'Данные успешно обновлены!');
        }
        return redirect()->back()->with('error', 'Не удалось обновить данные! Попробуйте позже!');
    }
}
