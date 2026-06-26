<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\View\View;

class PublicTeacherController extends Controller
{
    /**
     * Display a listing of teachers and staff.
     */
    public function index(): View
    {
        // Fetch and sort teachers based on predefined positions
        $predefined = Teacher::getPredefinedPositions();
        $teachers = Teacher::all()->sort(function ($a, $b) use ($predefined) {
            $posA = array_map('trim', explode(',', $a->position));
            $posB = array_map('trim', explode(',', $b->position));
            
            $priorityA = 999;
            foreach ($posA as $p) {
                $idx = array_search($p, $predefined);
                if ($idx !== false && $idx < $priorityA) {
                    $priorityA = $idx;
                }
            }
            
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
            
            $posStringA = implode(', ', $posA);
            $posStringB = implode(', ', $posB);
            $posComp = strcasecmp($posStringA, $posStringB);
            if ($posComp !== 0) {
                return $posComp;
            }
            
            return strcasecmp($a->name, $b->name);
        })->values();

        return view('teachers.index', compact('teachers'));
    }
}
