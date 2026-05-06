<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    /**
     * Tampilkan halaman form kontak / bantuan.
     */
    public function index()
    {
        return view('landing.contact');
    }

    /**
     * Kirim pesan dari form kontak ke email admin.
     */
    public function send(Request $request)
    {
        $data = $request->validate([
            'nama'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'pesan'   => ['required', 'string', 'max:5000'],
        ]);

        // Kirim email ke raff.support@gmail.com
        Mail::to('nabillkysn@gmail.com')->send(new ContactMail($data));

        return back()->with('success', 'Pesan berhasil dikirim! Tim kami akan segera menghubungi Anda.');
    }
}

