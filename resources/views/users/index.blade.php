@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'Gestao', 'title' => __('Gestao')])
@extends('layouts.modal-message')
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 text-right">
                    <a href="{{route('add-user')}}" class="btn btn-sm btn-primary">Add Usuário</a>
                </div>
                <input class="form-control" id="pesquisa" type="text" placeholder="Procurar..">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    @forelse($users as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <th>{{$user->name}}</th>
                            @if($user->block == 1)
                                <th class="text-danger">Bloqueado</th>
                            @else
                                <th>Normal</th>
                            @endif
                            <th>{{$user->email}}</th>
                            <th>{{$user->tipo}}</th>
                            <th>
                                <a href="javascript:void(0);"
                                   data-action="{{route('delete-user', $user->id)}}"
                                   class="delete_item_sweet">
                                    <i class="fas fa-trash mr-2 text-danger"></i>
                                </a>
                                <a href="{{route('user.block', $user->id)}}"><i class="fa fa-lock mr-2 ml-2"></i></a>
                                <a href="{{route('edit-user', $user->id)}}"><i class="fa fa-user" style="color: #2180e8"></i></a>

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
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
@endsection
