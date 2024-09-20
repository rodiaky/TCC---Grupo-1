<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Materiais;

class TemaRepertoriosController extends Controller
{
    public function index() {
        $pastas = DB::table('pastas')
    ->select('pastas.*') 
    ->where('tipo', 'Repertório') 
    ->get();

        return view('admin.repertorios.temaRepertorios', compact('pastas'));
    }

}
