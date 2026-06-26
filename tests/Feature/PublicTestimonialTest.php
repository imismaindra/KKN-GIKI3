<?php

use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('public user can access write testimonial page', function () {
    $response = $this->get(route('testimonials.create.public'));
    $response->assertStatus(200);
    $response->assertSee('Berikan Testimoni Anda');
});

test('public user can submit testimonial and it is pending approval by default', function () {
    Storage::fake('public');

    $response = $this->post(route('testimonials.store.public'), [
        'name' => 'John Doe Student',
        'relationship' => 'Siswa Aktif',
        'rating' => 5,
        'content' => 'SMA GIKI 3 Surabaya sangat luar biasa dalam mendidik karakter.',
        'avatar' => UploadedFile::fake()->image('avatar.jpg'),
    ]);

    $response->assertRedirect(route('testimonials.create.public'));
    $response->assertSessionHas('success');

    // Confirm it exists in the database but is NOT approved
    $this->assertDatabaseHas('testimonials', [
        'name' => 'John Doe Student',
        'relationship' => 'Siswa Aktif',
        'rating' => 5,
        'content' => 'SMA GIKI 3 Surabaya sangat luar biasa dalam mendidik karakter.',
        'is_approved' => false,
    ]);

    // Check that the avatar was optimized/stored
    $testimonial = Testimonial::where('name', 'John Doe Student')->first();
    $this->assertNotNull($testimonial->avatar);
    Storage::disk('public')->assertExists($testimonial->avatar);
});

test('admin can toggle testimonial approval status', function () {
    $user = User::factory()->create();
    
    $testimonial = Testimonial::create([
        'name' => 'Pending Reviewer',
        'relationship' => 'Alumni',
        'content' => 'Cepat disetujui dong admin.',
        'rating' => 4,
        'is_approved' => false,
    ]);

    // Toggle approval ON
    $response = $this->actingAs($user)
        ->patch(route('admin.testimonials.toggle-approval', $testimonial->id));

    $response->assertRedirect();
    $this->assertDatabaseHas('testimonials', [
        'id' => $testimonial->id,
        'is_approved' => true,
    ]);

    // Toggle approval OFF
    $response = $this->actingAs($user)
        ->patch(route('admin.testimonials.toggle-approval', $testimonial->id));

    $response->assertRedirect();
    $this->assertDatabaseHas('testimonials', [
        'id' => $testimonial->id,
        'is_approved' => false,
    ]);
});

test('admin can store testimonial directly and it is approved by default', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('admin.testimonials.store'), [
            'name' => 'Direct Reviewer',
            'relationship' => 'Wali Murid',
            'content' => 'Langsung tayang tanpa nunggu.',
            'rating' => 5,
        ]);

    $response->assertRedirect(route('admin.testimonials.index'));

    $this->assertDatabaseHas('testimonials', [
        'name' => 'Direct Reviewer',
        'relationship' => 'Wali Murid',
        'content' => 'Langsung tayang tanpa nunggu.',
        'is_approved' => true, // default approved for admin
    ]);
});

test('admin can store testimonial directly with specific approval state', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('admin.testimonials.store'), [
            'name' => 'Direct Pending Reviewer',
            'relationship' => 'Guru',
            'content' => 'Langsung pending oleh admin.',
            'rating' => 3,
            'is_approved' => '0',
        ]);

    $response->assertRedirect(route('admin.testimonials.index'));

    $this->assertDatabaseHas('testimonials', [
        'name' => 'Direct Pending Reviewer',
        'is_approved' => false,
    ]);
});

test('homepage only displays approved testimonials', function () {
    // Create approved testimonial
    Testimonial::create([
        'name' => 'Approved Parent',
        'relationship' => 'Wali Murid',
        'content' => 'Saya sangat puas menyekolahkan anak saya di sini.',
        'rating' => 5,
        'is_approved' => true,
    ]);

    // Create pending testimonial
    Testimonial::create([
        'name' => 'Spam Testimonial',
        'relationship' => 'Lainnya',
        'content' => 'Ini spam iklan obat kuat tidak boleh tampil.',
        'rating' => 1,
        'is_approved' => false,
    ]);

    $response = $this->get('/');
    $response->assertStatus(200);

    // Should see approved
    $response->assertSee('Approved Parent');
    $response->assertSee('Saya sangat puas menyekolahkan anak saya di sini.');

    // Should NOT see pending
    $response->assertDontSee('Spam Testimonial');
    $response->assertDontSee('Ini spam iklan obat kuat tidak boleh tampil.');
});
