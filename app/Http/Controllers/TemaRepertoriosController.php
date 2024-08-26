<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Materiais;

class TemaRepertoriosController extends Controller
{
    public function index() {
        $temas = DB::table('materiais')
        ->select('materiais.*') // Select all fields from temas and banca name
        ->get();

        return view('site.temaRepertorios', compact('temas'));
    }
}
