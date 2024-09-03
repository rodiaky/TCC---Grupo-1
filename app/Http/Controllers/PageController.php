<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Conteudo;

class PageController extends Controller
{
   public function index()
   {
   	return view('welcome');
   }

   public function uploadpage()
   {
   	return view('product');
   }

   public function store(Request $request)
   {
        $data = new Conteudo();
        $file = $request->file('filename');
        
        // Gera um nome único para o arquivo
        $filename = time() . '.' . $file->getClientOriginalExtension();
        
        // Move o arquivo para a pasta 'assets'
        $file->move(public_path('assets'), $filename);

        $data->filename = $filename;
        $data->nome = $request->nome;
        $data->telefone = $request->telefone;
        $data->email = $request->email;
        $data->save();

        return redirect()->back();
   }

   public function show()
   {
        $data = Conteudo::all();
        return view('showproduct', compact('data'));
   }

   public function download(Request $request, $filename)
   {
        return response()->download(public_path('assets/' . $filename));
   }

   public function view($id)
   {
        $data = Conteudo::find($id);
        return view('viewproduct', compact('data'));
   }

   public function saveImage(Request $request)
   {
        $data = Conteudo::where('filename', $request->filename)->first();

        if ($data) {
            $imageData = $request->input('image');
            $image = str_replace('data:image/png;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            $imagePath = public_path('assets/' . $data->filename);

            // Salva a imagem no local original, sobrescrevendo o arquivo existente
            file_put_contents($imagePath, base64_decode($image));

            return response()->json(['success' => true, 'message' => 'Imagem salva com sucesso!']);
        }

        return response()->json(['success' => false, 'message' => 'Erro ao salvar a imagem.']);
   }

   public function delete($id)
   {
        $data = Conteudo::find($id);
        if ($data) {
            // Exclui o arquivo associado
            $filePath = public_path('assets/' . $data->filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Exclui o registro do banco de dados
            $data->delete();
        }
        return redirect()->back()->with('success', 'Registro excluído com sucesso!');
   }
}
