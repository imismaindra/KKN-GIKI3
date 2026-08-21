<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeacherRequest;
use App\Http\Requests\Admin\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use App\Helpers\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        $teachers = Teacher::sorted();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create(): View
    {
        return view('admin.teachers.create');
    }

    public function store(StoreTeacherRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $result = ImageOptimizer::optimize($request->file('photo'), 'teachers', 500, 500, 75);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload foto. Silakan coba lagi.');
            }
            $data['photo'] = $result;
        }

        Teacher::create($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Guru/Staf berhasil ditambahkan.');
    }

    public function edit(Teacher $teacher): View
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $result = ImageOptimizer::optimize($request->file('photo'), 'teachers', 500, 500, 75);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload foto. Silakan coba lagi.');
            }
            $data['photo'] = $result;
        } else {
            unset($data['photo']);
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Guru/Staf berhasil diperbarui.');
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Guru/Staf berhasil dihapus.');
    }
}
