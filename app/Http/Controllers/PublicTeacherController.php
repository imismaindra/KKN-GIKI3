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
        $teachers = Teacher::sorted();

        return view('teachers.index', compact('teachers'));
    }
}
