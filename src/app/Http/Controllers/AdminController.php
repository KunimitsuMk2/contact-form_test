<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact; 

class AdminController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $contacts = Contact::paginate(7); // 7件ごとのページネーション


        return view('admin',compact('categories', 'contacts'));
    }
    public function search(Request $request)
    {
        //検索条件を取得
        $searchName = $request->input('search_name');
        $searchEmail = $request->input('search_email');
        $searchGender = $request->input('search_gender');
        $searchCategory=$request->input('search_category');
        $searchDate = $request->input('search_date');

        $contacts = Contact::query();

        //名前検索（部分一致）
        if($searchName)
        {
            $contacts->where(function($query)use($searchName){
                $query->where('first_name', 'like', "%{$searchName}%")
                      ->orWhere('last_name', 'like', "%{$searchName}%");
            });
        
        }
         // メールアドレス検索（部分一致）
        if ($searchEmail) {
            $contacts->where('email', 'like', "%{$searchEmail}%");
        }
        // 性別検索
        if ($searchGender && $searchGender != '性別') {
            $contacts->where('gender', $searchGender);
        }

        // お問い合わせ種類検索
        if ($searchCategory && $searchCategory != 'お問い合わせの種類') {
            $contacts->where('category_id', $searchCategory);
        }

        // 日付検索
        if ($searchDate) {
            $contacts->whereDate('created_at', $searchDate);
        }
        // ページネーション（7件ごと）
        $contacts = $contacts->paginate(7);

        // カテゴリを取得してビューに渡す
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
    public function export(Request $request)
    {
        // クエリパラメータを元に検索結果を取得
        $searchName = $request->input('search_name');
        $searchEmail = $request->input('search_email');
        $searchGender = $request->input('search_gender');
        $searchCategory = $request->input('search_category');
        $searchDate = $request->input('search_date');

        $contacts = Contact::query();

        // 名前検索（部分一致）
        if ($searchName) {
            $contacts->where(function ($query) use ($searchName) {
                $query->where('first_name', 'like', "%{$searchName}%")
                      ->orWhere('last_name', 'like', "%{$searchName}%");
            });
        }

        // メールアドレス検索（部分一致）
        if ($searchEmail) {
            $contacts->where('email', 'like', "%{$searchEmail}%");
        }

        // 性別検索
        if ($searchGender && $searchGender != '性別') {
            $contacts->where('gender', $searchGender);
        }

        // お問い合わせ種類検索
        if ($searchCategory && $searchCategory != 'お問い合わせの種類') {
            $contacts->where('category_id', $searchCategory);
        }

        // 日付検索
        if ($searchDate) {
            $contacts->whereDate('created_at', $searchDate);
        }

        // 結果を取得
        $contacts = $contacts->get();

        // CSVエクスポート
        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '日付']);

            foreach ($contacts as $contact) {
                $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->category->content,
                    $contact->created_at,
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="contacts.csv"');

        return $response;
    }
}
