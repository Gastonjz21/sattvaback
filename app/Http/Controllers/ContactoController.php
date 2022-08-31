<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contacto;

use Mail;

class ContactoController extends Controller
{
    public function index() {
        return view('contact-us');
    }

    public function save(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'phone_number' => 'required',
            'message' => 'required'
        ]);

        $contacto = new Contacto;

        $contacto->name = $request->name;
        $contacto->email = $request->email;
        $contacto->subject = $request->subject;
        $contacto->phone_number = $request->phone_number;
        $contacto->message = $request->message;

        $contact->save();

        \Mail::send('contact email',
                    array(
                        'name' => $request->get('name'),
                        'email' => $request->get('email'),
                        'subject' => $request->get('subject'),
                        'phone_number' => $request->get('phone_number'),
                        'user_message' => $request->get('message'),

                    ), function ($message) use ($request)
                    {
                        $message->from($request->email);
                        $message->to('gastonjzabala@gmail.com');
                    });

        return back() ->whit('Enviado', 'Gracias por contactarnos');
    }
}
