<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Accommondation;

use Illuminate\Http\Request;

class AccommondationController extends Controller
{
    public function index()
    {
        $accommondations = Accommondation::all();

        return Inertia::render('Home', [
            'accommondations' => $accommondations,
        ]);
    }
}
