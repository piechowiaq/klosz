<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function send(ContactRequest $request)
    {
        Mail::to('contact@timelyrecord.com')->send(new ContactMail($request->name, $request->email, $request->body));

        return Inertia::render('Welcome');
    }
}
