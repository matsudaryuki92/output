<?php

namespace App\Contacts\UseCase;

use App\Models\Contact;
use Illuminate\Http\Request;

final class CsvExportUseCase
{
    // ここで実装していきたいのはファットコントローラーを避けるためのメソッド定義をしていきたい
    // 目的：検索機能の切り出し

    public function handle(Request $request)
    {
        $searchWord = $request->input('keyword');
        $searchGender = $request->input('gender_key');
        $searchCategory = $request->input('category_key');
        $searchDate = $request->input('date_key');

        $contacts = Contact::query();

        if ($searchWord) {
            $contacts->NameSearch($searchWord);
        }

        if ($searchGender) {
            $contacts->GenderSearch($searchGender);
        }

        if ($searchCategory) {
            $contacts->CategorySearch($searchCategory);
        }

        if ($searchDate) {
            $contacts->DateSearch($searchDate);
        }

        return $contacts->get();
    }
}
