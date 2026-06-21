<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\View\View;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of extracurricular activities.
     */
    public function index(): View
    {
        $extracurriculars = Extracurricular::orderBy('name')->get();
        return view('extracurriculars.index', compact('extracurriculars'));
    }
}
