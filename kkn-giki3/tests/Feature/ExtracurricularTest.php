<?php

use App\Models\User;
use App\Models\Extracurricular;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('public user can view extracurricular page', function () {
    $ekskul = Extracurricular::create([
        'name' => 'Futsal Club',
        'slug' => 'futsal-club',
        'category' => 'Olahraga',
        'description' => 'Klub futsal bergengsi.',
        'pembina' => 'Coach Budi',
        'schedule' => 'Sabtu, 08:00 - 10:00',
    ]);

    $response = $this->get(route('ekstrakurikuler.index'));
    $response->assertStatus(200);
    $response->assertSee('Futsal Club');
    $response->assertSee('Coach Budi');
});

test('guest cannot access admin extracurricular list', function () {
    $response = $this->get(route('admin.extracurriculars.index'));
    $response->assertRedirect(route('admin.login'));
});

test('admin can access admin extracurricular list', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get(route('admin.extracurriculars.index'));
    $response->assertStatus(200);
});

test('admin can store extracurricular', function () {
    $user = User::factory()->create();
    Storage::fake('public');

    $response = $this->actingAs($user)->post(route('admin.extracurriculars.store'), [
        'name' => 'Klub Musik',
        'category' => 'Seni & Budaya',
        'description' => 'Latihan alat musik modern.',
        'pembina' => 'Ibu Maria',
        'schedule' => 'Rabu, 14:00 - 16:00',
        'icon' => 'music_note',
        'image_path' => UploadedFile::fake()->image('musik.jpg'),
    ]);

    $response->assertRedirect(route('admin.extracurriculars.index'));
    $this->assertDatabaseHas('extracurriculars', [
        'name' => 'Klub Musik',
        'slug' => 'klub-musik',
        'category' => 'Seni & Budaya',
        'pembina' => 'Ibu Maria',
    ]);

    $ekskul = Extracurricular::where('name', 'Klub Musik')->first();
    $this->assertNotNull($ekskul->image_path);
    Storage::disk('public')->assertExists($ekskul->image_path);
});

test('admin can update extracurricular', function () {
    $user = User::factory()->create();
    $ekskul = Extracurricular::create([
        'name' => 'Paskibra',
        'slug' => 'paskibra',
        'description' => 'Pasukan pengibar bendera.',
    ]);

    $response = $this->actingAs($user)->put(route('admin.extracurriculars.update', $ekskul->id), [
        'name' => 'Paskibra Update',
        'description' => 'Pasukan pengibar bendera diperbarui.',
        'pembina' => 'Bapak Joko',
        'schedule' => 'Senin, 15:00',
    ]);

    $response->assertRedirect(route('admin.extracurriculars.index'));
    $this->assertDatabaseHas('extracurriculars', [
        'id' => $ekskul->id,
        'name' => 'Paskibra Update',
        'slug' => 'paskibra-update',
        'pembina' => 'Bapak Joko',
    ]);
});

test('admin can delete extracurricular', function () {
    $user = User::factory()->create();
    Storage::fake('public');
    
    $imagePath = 'extracurriculars/test.webp';
    Storage::disk('public')->put($imagePath, 'dummy image content');

    $ekskul = Extracurricular::create([
        'name' => 'Pramuka',
        'slug' => 'pramuka',
        'description' => 'Kegiatan pramuka.',
        'image_path' => $imagePath,
    ]);

    Storage::disk('public')->assertExists($imagePath);

    $response = $this->actingAs($user)->delete(route('admin.extracurriculars.destroy', $ekskul->id));

    $response->assertRedirect(route('admin.extracurriculars.index'));
    $this->assertDatabaseMissing('extracurriculars', ['id' => $ekskul->id]);
    Storage::disk('public')->assertMissing($imagePath);
});
