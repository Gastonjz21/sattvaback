<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contacto;

//use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $contactos = Contacto::all();
        return response()->json($contactos);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
       $request->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'subject'=> 'required',
            'phone_number'=> 'required',
            'message'=> 'required',
        ]);

        $contacto = new Contacto();
        $contacto->name = $request->name;
        $contacto->email = $request->email;
        $contacto->subject = $request->subject;
        $contacto->phone_number = $request->phone_number;
        $contacto->message = $request->message;

        $contacto->save();


        return response()->json([
            "message" => "Mensaje de contacto enviado.",
            'data' => $contacto
        ], 201);


        // Mail::send('contact email',
        //             array(
        //                 'name' => $request->get('name'),
        //                 'email' => $request->get('email'),
        //                 'subject' => $request->get('subject'),
        //                 'phone_number' => $request->get('phone_number'),
        //                 'message' => $request->get('message'),

        //             ), function ($message) use ($request)
        //             {
        //                 $message->from($request->email);
        //                 $message->to('gastonjzabala@gmail.com');
        //             });

        // return back() ->whit('Enviado', 'Gracias por contactarnos');
    }
}
