<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Materiais;

class PastaMateriaisController extends Controller
{
    public function index() {
        $pastas = DB::table('pastas')
        ->select('pastas.*') 
        ->where('tipo', 'Material') 
        ->get();

        return view('admin.materiais.PastaMateriais', compact('pastas'));
    }
}
