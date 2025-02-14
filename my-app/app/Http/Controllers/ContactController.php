<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $contact = $request->all();

        return view('contact.confirm', compact('contact'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $contact = $request->only('name', 'email', 'message');

        // メール送信処理
        Mail::to(config('mail.from.address'))->send(new ContactMail($contact, 'admin'));

        Mail::to($contact['email'])->send(new ContactMail($contact, 'user'));

        return redirect()->route('contact.complete');
    }

    public function complete()
    {
        return view('contact.complete');
    }
}
