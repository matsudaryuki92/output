<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function check(Request $request)
    {
        $contact = $request->input('name');
        session()->put($contact);

        return redirect()->route('index.confirm');
    }

    public function confirm()
    {
        return view('confirm');
    }

    // public function fix(Request $request)
    // {
    //     $contact = $request->only(['name']);

    //     return redirect('/')->with(compact('contact'));
    // }

    // public function store(Request $request)
    // {
    //     $contact = $request->only(['name']);

    //     Contact::create($contact);
    //     session()->forget($contact);

    //     return redirect('/thanks');
    // }
}
