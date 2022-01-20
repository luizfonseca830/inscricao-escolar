@extends('layouts.app', ['activePage' => 'ListaCarrossel', 'titlePage' => __('ListaCarrossel')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-end" >
                    <a href="{{route('carrossel.create')}}"><input type="button" class="btn btn-outline-primary float-right" value="Novo Banner"></a>
                </div>
                <div class="row">

                    <input class="form-control" id="pesquisa" type="text" placeholder="Procurar..">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Banner</th>
                            <th scope="col">Link</th>
                            <th scope="col">Opções</th>
                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @forelse($carrossels as $key=>$carrossel)
                            <tr>
                                <th>{{$key+1}}</th>
                                <th><a target="_blank" href="{{asset('images/caruosel/'.$carrossel->url_img)}}">Imagem</a></th>
                                <th><a href="{{$carrossel->url_link}}" target="_blank">LINK</a></th>
                                <th>
                                    <a href="{{route('carrossel.edit', $carrossel->id)}}">
                                        <i class="material-icons" style="color: blue">create</i>
                                    </a>
                                    <a href="{{route('carrossel.delete', $carrossel->id)}}">
                                        <i class="material-icons" style="color: red">delete</i>
                                    </a>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Nenhum Resultado Encontrado</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div style="width: 100%; margin-left: 50%">
                        {!! $carrossels->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
@endsection
