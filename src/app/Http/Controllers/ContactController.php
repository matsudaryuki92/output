<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchWord = $request->input('keyword');
        $searchGender = $request->input('gender_key');
        $searchCategory = $request->input('category_key');
        $searchDate = $request->input('date_key');

        $contacts = Contact::query();

        if($searchWord) {
            $contacts->NameSearch($searchWord);
        }

        if($searchGender) {
            $contacts->GenderSearch($searchGender);
        }

        if($searchCategory) {
            $contacts->CategorySearch($searchCategory);
        }

        if($searchDate) {
            $contacts->DateSearch($searchDate);
        }
        $contacts = $contacts->paginate(7);

        return view('contacts.index', compact('contacts', 'searchWord', 'searchGender', 'searchCategory', 'searchDate'));
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
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //存在しないidの場合は自動的に404エラーになる

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contacts.index');
    }
}
