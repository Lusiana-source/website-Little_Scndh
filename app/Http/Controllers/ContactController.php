<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Mail::raw("Pesan dari: {$details['name']} ({$details['email']})\n\n{$details['message']}", function ($mail) {
            $mail->to('admin@littlescndh.com')->subject('Pesan Baru dari Form Kontak');
        });

        return back()->with('success', 'Pesan Anda telah dikirim!');
    }
}
