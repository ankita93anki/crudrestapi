<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'first_name'=>'required|min:2|max:100',
            'last_name'=>'required',
            'email'=>'required|email|unique:contacts',
            'job_title'=>'required',
            'city'=>'required',
            'country'=>'required'

        ]);
        $contact = new Contact([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'job_title'=>$request->job_title,
            'city'=>$request->city,
            'country'=>$request->country

        ]);

        $contact->save();
        return redirect('/')->with('success','contact saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'=>'required|min:2|max:100',
            'last_name'=>'required',
            'email'=>'required',
            'job_title'=>'required',
            'city'=>'required',
            'country'=>'required'        
        ]);

        $contact = Contact::find($id);
        $contact->first_name =  $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->job_title = $request->job_title;
        $contact->city = $request->city;
        $contact->country = $request->country;
        $contact->save();

        return redirect('/')->with('success', 'Contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return redirect('/')->with('success', 'Contact deleted!');
    }
}
