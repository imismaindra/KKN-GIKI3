<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PublicContactController extends Controller
{
    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'subject.max' => 'Subjek tidak boleh lebih dari 255 karakter.',
            'message.required' => 'Isi pesan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        $schoolEmail = Setting::value('email');
        if ($schoolEmail) {
            Mail::to($schoolEmail)->send(new ContactFormMail($contactMessage));
        }

        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda berhasil terkirim. Terima kasih telah menghubungi kami!'
        ], 201);
    }
}
