<?php

use App\Models\User;
use App\Models\Banner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('admin can store banner with style options', function () {
    Storage::fake('public');
    
    // Create an admin user
    $user = User::factory()->create();

    // Send a store request with style options
    $response = $this->actingAs($user)
        ->post(route('admin.banners.store'), [
            'title' => 'New Banner Test Title',
            'subtitle' => 'New Banner Test Subtitle',
            'image_path' => UploadedFile::fake()->image('banner_new.jpg'),
            'button_text' => 'Click Me',
            'button_url' => 'https://example.com',
            'order' => 5,
            'alignment' => 'right',
            'cta_color' => 'indigo',
            'overlay_opacity' => 80,
            'text_color' => 'dark',
        ]);

    // Check redirection and database persistence
    $response->assertRedirect(route('admin.banners.index'));
    
    $this->assertDatabaseHas('banners', [
        'title' => 'New Banner Test Title',
        'subtitle' => 'New Banner Test Subtitle',
        'button_text' => 'Click Me',
        'button_url' => 'https://example.com',
        'order' => 5,
        'alignment' => 'right',
        'cta_color' => 'indigo',
        'overlay_opacity' => 80,
        'text_color' => 'dark',
    ]);
});

test('admin can update banner with style options', function () {
    Storage::fake('public');
    
    $user = User::factory()->create();
    
    // Create a banner initially
    $banner = Banner::create([
        'title' => 'Original Title',
        'subtitle' => 'Original Subtitle',
        'image_path' => 'banners/dummy.jpg',
        'button_text' => 'Old Button',
        'button_url' => 'https://old.com',
        'order' => 1,
        'alignment' => 'left',
        'cta_color' => 'amber',
        'overlay_opacity' => 60,
        'text_color' => 'light',
    ]);

    // Send an update request modifying the styles and other details
    $response = $this->actingAs($user)
        ->put(route('admin.banners.update', $banner->id), [
            'title' => 'Updated Banner Title',
            'subtitle' => 'Updated Subtitle',
            // image_path is optional on update, leaving it empty to verify it is preserved
            'button_text' => 'New Button Text',
            'button_url' => 'https://new-url.com',
            'order' => 3,
            'alignment' => 'center',
            'cta_color' => 'emerald',
            'overlay_opacity' => 20,
            'text_color' => 'dark',
        ]);

    $response->assertRedirect(route('admin.banners.index'));
    
    // Check if fields were updated and image was preserved
    $this->assertDatabaseHas('banners', [
        'id' => $banner->id,
        'title' => 'Updated Banner Title',
        'subtitle' => 'Updated Subtitle',
        'image_path' => 'banners/dummy.jpg', // Should be preserved
        'button_text' => 'New Button Text',
        'button_url' => 'https://new-url.com',
        'order' => 3,
        'alignment' => 'center',
        'cta_color' => 'emerald',
        'overlay_opacity' => 20,
        'text_color' => 'dark',
    ]);
});

test('homepage renders banners with dynamic custom styling classes', function () {
    Storage::fake('public');
    
    // Create some banners with custom styles
    Banner::create([
        'title' => 'Banner Alignment Right Green',
        'subtitle' => 'Subtitle Right Green',
        'image_path' => 'banners/test_r.jpg',
        'button_text' => 'Go Right',
        'button_url' => 'https://example.com/right',
        'order' => 1,
        'alignment' => 'right',
        'cta_color' => 'emerald',
        'overlay_opacity' => 40,
        'text_color' => 'dark',
    ]);
    
    Banner::create([
        'title' => 'Banner Alignment Center Blue',
        'subtitle' => 'Subtitle Center Blue',
        'image_path' => 'banners/test_c.jpg',
        'button_text' => 'Go Center',
        'button_url' => 'https://example.com/center',
        'order' => 2,
        'alignment' => 'center',
        'cta_color' => 'blue',
        'overlay_opacity' => 80,
        'text_color' => 'light',
    ]);

    // Request the homepage
    $response = $this->get('/');
    $response->assertStatus(200);

    // Verify presence of title text
    $response->assertSee('Banner Alignment Right Green');
    $response->assertSee('Banner Alignment Center Blue');

    // Verify classes and styles are outputted
    // 1. Alignment right: 'items-end text-right ml-auto' (or similar used in our class map)
    // 2. Alignment center: 'items-center text-center mx-auto'
    $response->assertSee('items-end text-right ml-auto', false);
    $response->assertSee('items-center text-center mx-auto', false);

    // 3. CTA Colors
    $response->assertSee('bg-emerald-600 text-white', false);
    $response->assertSee('bg-blue-600 text-white', false);

    // 4. Overlays opacity: style="opacity: 0.4" and style="opacity: 0.8"
    $response->assertSee('style="opacity: 0.4"', false);
    $response->assertSee('style="opacity: 0.8"', false);

    // 5. Text colors
    $response->assertSee('text-slate-900', false); // dark theme text
    $response->assertSee('text-on-primary', false); // light theme text
});

test('admin can toggle active status of a banner', function () {
    $user = User::factory()->create();
    
    $banner = Banner::create([
        'title' => 'Toggle Active Banner Test',
        'image_path' => 'banners/test.jpg',
        'order' => 1,
        'is_active' => true,
        'alignment' => 'left',
        'cta_color' => 'amber',
        'overlay_opacity' => 60,
        'text_color' => 'light',
    ]);

    // Perform toggle request
    $response = $this->actingAs($user)
        ->patch(route('admin.banners.toggle-active', $banner->id));

    $response->assertRedirect();
    
    // Check database has changed to false
    $this->assertDatabaseHas('banners', [
        'id' => $banner->id,
        'is_active' => false,
    ]);

    // Perform toggle request again to reactivate
    $response = $this->actingAs($user)
        ->patch(route('admin.banners.toggle-active', $banner->id));

    $this->assertDatabaseHas('banners', [
        'id' => $banner->id,
        'is_active' => true,
    ]);
});

test('inactive banners are not rendered on homepage', function () {
    Storage::fake('public');
    
    Banner::create([
        'title' => 'Active Banner Title',
        'image_path' => 'banners/active.jpg',
        'order' => 1,
        'is_active' => true,
        'alignment' => 'left',
        'cta_color' => 'amber',
        'overlay_opacity' => 60,
        'text_color' => 'light',
    ]);
    
    Banner::create([
        'title' => 'Inactive Banner Title',
        'image_path' => 'banners/inactive.jpg',
        'order' => 2,
        'is_active' => false,
        'alignment' => 'left',
        'cta_color' => 'amber',
        'overlay_opacity' => 60,
        'text_color' => 'light',
    ]);

    // Request homepage
    $response = $this->get('/');
    $response->assertStatus(200);

    // Verify only the active banner is visible
    $response->assertSee('Active Banner Title');
    $response->assertDontSee('Inactive Banner Title');
});

