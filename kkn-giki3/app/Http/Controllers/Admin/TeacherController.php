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
        $predefined = Teacher::getPredefinedPositions();
        $teachers = Teacher::all()->sort(function ($a, $b) use ($predefined) {
            // Get positions as arrays
            $posA = array_map('trim', explode(',', $a->position));
            $posB = array_map('trim', explode(',', $b->position));
            
            // Find highest priority for A (lowest index)
            $priorityA = 999;
            foreach ($posA as $p) {
                $idx = array_search($p, $predefined);
                if ($idx !== false && $idx < $priorityA) {
                    $priorityA = $idx;
                }
            }
            
            // Find highest priority for B (lowest index)
            $priorityB = 999;
            foreach ($posB as $p) {
                $idx = array_search($p, $predefined);
                if ($idx !== false && $idx < $priorityB) {
                    $priorityB = $idx;
                }
            }
            
            if ($priorityA !== $priorityB) {
                return $priorityA <=> $priorityB;
            }
            
            // If priority is the same, sort by the positions string alphabetically
            $posStringA = implode(', ', $posA);
            $posStringB = implode(', ', $posB);
            $posComp = strcasecmp($posStringA, $posStringB);
            if ($posComp !== 0) {
                return $posComp;
            }
            
            // 2. Name alphabetically
            return strcasecmp($a->name, $b->name);
        })->values();

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
            $data['photo'] = ImageOptimizer::optimize($request->file('photo'), 'teachers', 500, 500, 75);
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
            $data['photo'] = ImageOptimizer::optimize($request->file('photo'), 'teachers', 500, 500, 75);
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
