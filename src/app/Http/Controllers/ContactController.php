<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }
    public function confirm(ContactRequest $request)
    {
         // 電話番号の各部分を取得
        $tel1 = $request->input('tel1');
        $tel2 = $request->input('tel2');
        $tel3 = $request->input('tel3');
    // 電話番号を結合
        $tel = $tel1 . '-' . $tel2 . '-' . $tel3;
        $contact = $request->only([ 'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',]);
            // 電話番号を連想配列に追加
        $contact['tel'] = $tel;

        return view('confirm',['contact'=>$contact]);
    }
        // 送信処理
    public function send(Request $request)
    {
        // データをcontactsテーブルに保存
        Contact::create([
            'category_id' => $request->category_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'tel' => $request->tel,
            'address' => $request->address,
            'building' => $request->building,
            'detail' => $request->detail,
        ]);

        // サンクスページにリダイレクト
        return redirect()->route('thanks');
    }

    // 修正画面
    public function edit(Request $request)
    {
        return redirect()->route('contact.index')->withInput($request->all());
    }
}

