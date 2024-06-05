<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;


class LeadController extends Controller
{
    public function store(Request $request){

        $data = $request->all();
        $validator = Validator::make($data,
            [
                'name' => 'required|min:2|max:100',
                'email' => 'required|email',
                'message' => 'required|min:5'
            ],
            [
                'name.required' => 'il nome è obbligatorio',
                'name.min' => 'il nome deve avere almeno :min caratteri',
                'name.max' => 'il nome deve avere massimo :max caratteri',

                'email.required' => 'l\'email è obbligatoria',
                'email.email' => 'formato email non corretto',

                'message.required' => 'il messaggio è obbligatorio',
                'message.min' => 'il messaggio deve contenere almeno :min caratteri'
            ]
        );

        if($validator->fails()){
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }

        // salvo i dati nel db
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();


        // invio l'email
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewContact($new_lead));


        $success = true;
        return response()->json(compact('success'));
    }
}
