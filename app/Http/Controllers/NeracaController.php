<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NeracaController extends Controller
{
    public function index(): View
    {
        $jenis = Jenis::all();
        return view('Neraca.index', compact(
                'jenis'
            ));
    }
}
