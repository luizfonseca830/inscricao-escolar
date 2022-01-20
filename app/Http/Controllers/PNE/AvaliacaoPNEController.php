<?php

namespace App\Http\Controllers\PNE;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\Models\Transparencia;
use Illuminate\Http\Request;

class AvaliacaoPNEController extends Controller
{
    //
    public function index()
    {
        $pessoas = Pessoa::where('status', 1)->where('status_aprovado', 1)->where('portador_deficiencia', 1)->paginate(15);
        return view('pages.avaliacao-pne.avaliacao-pne', [
            'pessoas' => $pessoas
        ]);
    }

    public function update($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        if (!is_null($pessoa->status_pericia_pne)) {
            session()->put('error', 'Parece que alguem já verificou!');
            return redirect()->route('avaliacao-pne');
        }

        if ($pessoa->portador_deficiencia != 1) {
            session()->put('error', 'Parece que algo de errado aconteceu!');
            return redirect()->route('avaliacao-pne');
        }
        else {
            $pessoa->update([
                'status_pericia_pne' => 1,
            ]);
            session()->put('sucess', 'Staus atualizado com Sucesso!');

            Transparencia::create([
                'pessoa_id' => $id,
                'instrutor_id' => auth()->id(),
                'tela' => 'Avaliação PNE',
            ]);
            return redirect()->route('avaliacao-pne');
        }
        session()->put('error', 'Parece que algo de errado aconteceu!');
        return redirect()->route('avaliacao-pne');
    }
}
