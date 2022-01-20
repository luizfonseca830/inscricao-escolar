<?php

namespace App\Http\Controllers\PNE;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\Models\Transparencia;
use Illuminate\Http\Request;

class AvaliacaoPNERecusarController extends Controller
{
    //
    public function show($id){
        $pessoa = Pessoa::findOrFail($id);

        if ( !is_null($pessoa->status_pericia_pne)){
            session()->put('error', 'Parece que alguem já verificou!');
            return redirect()->route('avaliacao-pne');
        }
        if ($pessoa->portador_deficiencia == 0){
            session()->put('error', 'Parece que alguem já verificou!');
            return redirect()->route('avaliacao-pne');
        }
        else {
            //CASO DE TUDO CERTO
            return view('pages.avaliacao-pne.avaliacao-pne-recusar', [
                'pessoa' => $pessoa
            ]);
        }
        //ERROS EM GERAIS
        session()->put('error', 'Parece que alguem já verificou!');
        return redirect()->route('avaliacao-pne');
    }

    public function update(Request $request, $id){
        $pessoa = Pessoa::FindOrFail($id);

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
                'status_pericia_pne' => 0,
            ]);
            session()->put('sucess', 'Staus atualizado com Sucesso!');

            Transparencia::create([
                'pessoa_id' => $id,
                'instrutor_id' => auth()->id(),
                'tela' => 'Avaliação PNE',
                'motivo' => $request->motivo_recusar,
            ]);
            return redirect()->route('avaliacao-pne');
        }

        session()->put('error', 'Parece que algo de errado aconteceu!');
        return redirect()->route('avaliacao-pne');
    }

}
