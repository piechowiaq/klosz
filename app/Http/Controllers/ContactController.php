<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function send(ContactRequest $request)
    {
        Password::sendResetLink($request->only('email'));
//        Mail::to('contact@timelyrecord.com')->send(new ContactMail($request->name, $request->email, $request->body));

        return to_route('welcome');
    }
}
