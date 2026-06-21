<?php

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a user can send contact message through contact form', function () {
    $data = [
        'name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'subject' => 'Pertanyaan PPDB',
        'message' => 'Halo admin, saya ingin menanyakan jadwal pendaftaran siswa baru tahun ajaran ini.'
    ];

    $response = $this->postJson(route('contact.store'), $data);

    $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'message' => 'Pesan Anda berhasil terkirim. Terima kasih telah menghubungi kami!'
        ]);

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'subject' => 'Pertanyaan PPDB',
        'message' => 'Halo admin, saya ingin menanyakan jadwal pendaftaran siswa baru tahun ajaran ini.',
        'is_read' => false
    ]);
});

test('contact form requires name, email, subject, and message', function () {
    $response = $this->postJson(route('contact.store'), []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'email', 'subject', 'message']);
});

test('contact form requires a valid email', function () {
    $data = [
        'name' => 'Budi Santoso',
        'email' => 'invalid-email-format',
        'subject' => 'Pertanyaan',
        'message' => 'Pesan singkat.'
    ];

    $response = $this->postJson(route('contact.store'), $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});
