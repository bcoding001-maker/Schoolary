<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            // Kirim email ke admin
            Mail::to(config('mail.admin_email', 'admin@smkn4bogor.sch.id'))
                ->send(new ContactMail($validated));

            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, terjadi kesalahan. Silakan coba lagi nanti.'
            ], 500);
        }
    }
}
