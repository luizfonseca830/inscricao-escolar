<?php

namespace App\Http\Controllers\TelasDinamicas;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarrosselRequest;
use App\Models\Carrossel;
use Illuminate\Http\Request;

class CarrosselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carrossels = Carrossel::Paginate(15);
        return view('pages.telas-dinamicas.lista-carrossel', [
            'carrossels' => $carrossels,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.telas-dinamicas.carrosel-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarrosselRequest $request)
    {
        if (isset($request->file_img)) {
//            $fileName = time(). '.'. $request->file_img->extension();
            $fileName = $request->file_img->store('carrossel');

            $carrossel = Carrossel::create([
                'url_img' => $fileName,
            ]);
        }
        if (isset($carrossel) && $request->url_link) {
            $carrossel->update([
                'url_link' => $request->url_link
            ]);
        }
        if (!isset($carrossel)) {

            session()->put('error', 'Ops, algo de errado aconteceu!');
        }
        else {
            session()->put('sucess', 'Carrossel criado com sucesso!');
        }

        return redirect()->route('lista.carrossel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carrossel = Carrossel::findOrFail($id);
        return view('pages.telas-dinamicas.carrosel-edit', [
            'carrossel' => $carrossel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carrosel = Carrossel::findOrFail($id);
        if (isset($request->file_img)) {
            $fileName = $request->file_img->store('carrossel');
           $carrosel->update([
               'url_img' => $fileName,
           ]);
        }

        if (!is_null($request->url_link)) {
            $carrosel->update([
                'url_link' => $request->url_link,
            ]);
        }

        if (!isset($carrosel)) {
            session()->put('error', 'Ops, algo de errado aconteceu!');
        }
        else {
            session()->put('sucess', 'Carrossel alterado com sucesso!');
        }

        return redirect()->route('lista.carrossel.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrosel = Carrossel::findOrFail($id);
        $carrosel->delete();
        session()->put('sucess', 'Carrossel deletado com sucesso!');
        return redirect()->route('lista.carrossel.index');
    }
}
