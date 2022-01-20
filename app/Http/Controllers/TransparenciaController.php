<?php

namespace App\Http\Controllers;

use App\Models\Transparencia;
use App\User;
use Illuminate\Http\Request;

class TransparenciaController extends Controller
{
    //
    public function index()
    {
        return view('pages.transparencia', [
            'transparencias' => Transparencia::paginate(40),
        ]);
    }

    public function show($id)
    {
        return view('pages.transparencia-unico', [
            'transparencia' => Transparencia::findOrFail($id),
        ]);
    }

    public function search(Request $request)
    {
        $instrutor = User::where('name', 'LIKE', '%' . $request->procurar . '%')->first();
        if (!is_null($instrutor)) {
            $transparencias = Transparencia::where('instrutor_id', $instrutor->id)->paginate('40');
        }
        else {
            $transparencias = Transparencia::where('tela', 'LIKE', '%' . $request->procurar . '%')->paginate('40');
        }
        if (is_null($transparencias)) {
            return redirect()->route('lista-transparencia');
        }
        return view('pages.transparencia', [
            'transparencias' => $transparencias
        ]);
    }
}
