<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Language;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    
    public function index(Request $request) {
        $language_id = $request->get('language_id');
        if ($language_id){
            $faqs = Faq::where('language_id', $language_id)->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $faqs = Faq::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('pages.faqs.index',[
            'languages' => Language::all(),
            'faqs' => $faqs,
        ]);
    }
    
    public function store(Request $request) {
        $request->validate([
            'language_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);
        $language = Language::where('id', $request->get('language_id'))->first();
        if ($language === null){
            return redirect()->back()->with('error', 'Язык не найден');
        }
        $faq = new Faq($request->all());
        $faq->save();
        return redirect()->back()->with('success', 'Данные успешно добавлены!');
    }
    
    public function update(Request $request) {
        $request->validate([
            'id' => 'required',
            'language_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);
        $id = $request->get('id');
        $faq = Faq::where('id', $id)->first();
        if ($faq === null){
            return redirect()->back()->with('error', 'Запись не найдена');
        }
        $language = Language::where('id', $request->get('language_id'))->first();
        if ($language === null){
            return redirect()->back()->with('error', 'Язык не найден');
        }
        $faq->update($request->all());
        return redirect()->back()->with('success', 'Данные успешно обновлены!');
    }
    
    public function delete($id) {
        $faq = Faq::where('id', $id)->first();
        if ($faq === null){
            return redirect()->back()->with('error', 'Запись не найдена');
        }
        $faq->delete();
        return redirect()->back()->with('success', 'Данные успешно удалены!');
    }
}
