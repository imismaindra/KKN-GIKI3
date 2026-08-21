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
        $categories = Extracurricular::distinct()->pluck('category')->filter()->values()->toArray();
        return view('extracurriculars.index', compact('extracurriculars', 'categories'));
    }
}
