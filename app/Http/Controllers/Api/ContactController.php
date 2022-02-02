<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    
    public function index()
    {
        $contacts = Contact::all();
        return response()->json([
            'message' => 'All Data Is Here',
            'data' => $contacts
         ],200);
        
    }

    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'first_name'=>'required|min:2|max:100',
            'last_name'=>'required',
            'email'=>'required|email|unique:contacts',
            'job_title'=>'required',
            'city'=>'required',
            'country'=>'required'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'message' => 'validations fails',
                'errors' => $validator->errors()
             ],422);
        }
        $contact = new Contact([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'job_title'=>$request->job_title,
            'city'=>$request->city,
            'country'=>$request->country

        ]);

        $contact->save();
        return response()->json([
            'message' => 'created successful',
            'data' => $contact
         ],200);

    }

    public function edit($id)
    {
        $contacts = DB::select("select first_name,last_name,email,job_title,city,country from contacts where id = ".$id);
        if(empty($contacts))
        {
             return response()->json([
                 'message' => 'Particular id does not exist ',
                 'data' => $contacts
            ],404);
        }
        return response()->json([
            'message' => 'Data Is Here',
            'data' => $contacts
       ],200);

    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'first_name'=>'required|min:2|max:100',
            'last_name'=>'required',
            'email'=>'required',
            'job_title'=>'required',
            'city'=>'required',
            'country'=>'required'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'message' => 'validations fails',
                'errors' => $validator->errors()
             ],422);
        }
        $contact = Contact::where('id',$id)->first();

        $contact->update($request->all());
        return response()->json([
            'message' => 'updated successful',
            'data' => $contact
         ],200);
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if($contact)
        {
            $contact->delete();
            return response()->json([
            'status' => 'success',
            'message' => 'deleted successful'
            ],200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Id is not there'
                ],404);
        }
        
    }

}
