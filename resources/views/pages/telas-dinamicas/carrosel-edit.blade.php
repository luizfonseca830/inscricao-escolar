@extends('layouts.app', ['activePage' => 'TituloAlterar', 'titlePage' => __('TituloAlterar')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">

@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <form id="formulario_registro" method="post" action="{{route('carrossel.update', $carrossel->id)}}" enctype="multipart/form-data">
                        @csrf
                        <ul id="progress">
                            <li class="ativo" style="width: 100%">Carrossel</li>
                        </ul>

                        <fieldset>
                            <div class="tela">
                                <p>Adicionar Imagem do Banner</p>
                                <input type="file" id="fupload1" name="file_img"  class="fupload form-control"/>
                                <h5><strong>Banner</strong></h5>
                                <div class="row justify-content-center">
                                    <img src="{{asset('storage/'.$carrossel->url_img)}}" width="420px" alt="IMAGEM NÃO ENCONTRADA">
                                </div>
                            </div>
                            @error('file_img')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                            <div class="tela">
                                <p>Link para acesso. (Somente se nescessário)</p>
                                <input type="text" name="url_link" placeholder="Informe a url"/>
                                <p><a href="{{$carrossel->url_link}}">LINK</a></p>
                            </div>
                            @error('url_link')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="submit" name="next" id="confirma" class="acao" value="Criar"/>
                        </fieldset>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
@endsection
