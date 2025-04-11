<?php

namespace App\Http\Controllers;

use App\Contacts\UseCase\CsvExportUseCase;
use App\Contacts\UseCase\CsvExportWriteUseCase;
use App\Contacts\UseCase\SearchContactsUseCase;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SearchContactsUseCase $useCase)
    {
        $contacts = $useCase->handle($request);

        // useCaseに下記のコードを移動させたがうまく機能しなかっため一旦この形で。
        return view('contacts.index', [
            // フィルタリング後のデータを表示する為のデータを転送している
            'contacts' => $contacts,
            // ビューに渡して、フォームに再表示するため
            'searchWord' => $request->input('keyword'),
            'searchGender' => $request->input('gender_key'),
            'searchCategory' => $request->input('category_key'),
            'searchDate' => $request->input('date_key'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function show(Contact $contact)
    // {
    //     return view('contacts.index', compact('contact'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index');
    }

    public function csvExport(Request $request, CsvExportUseCase $useCase, CsvExportWriteUseCase $useCaseWrite)
    {
        // CSVエクスポートの処理を実行
        $contacts = $useCase->handle($request);

        return $useCaseWrite->handle($contacts);
    }
}
