<?php

use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('public user can view teachers and staff page', function () {
    $teacher = Teacher::create([
        'name' => 'Budi Utomo, S.Pd.',
        'position' => 'Guru Matematika',
        'order' => 1,
    ]);

    $response = $this->get(route('teachers.index.public'));
    $response->assertStatus(200);
    $response->assertSee('Budi Utomo, S.Pd.');
    $response->assertSee('Guru Matematika');
});
