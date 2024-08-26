<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temas;
use Illuminate\Support\Facades\DB;
use App\Models\Bancas;


class TemaController extends Controller
{
    public function index(){
        $temas = DB::table('temas')
        ->join('bancas', 'temas.id_banca', '=', 'bancas.id')
        ->select('temas.*', 'bancas.nome as banca_nome') // Select all fields from temas and banca name
        ->get();

    return view('site.temaRedacoes', compact('temas'));
    }
}
