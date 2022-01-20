@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'Gestao', 'title' => __('Gestao')])
@extends('layouts.modal-message')
@section('css')
    <style>
        label {
            position: initial !important;
        }
    </style>
@endsection
@section('content')
    <div class="container" style="margin-top: 60px; margin-bottom: 60px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"
                         style="background-color: #5680e9; font-weight: bold; color: white">{{ __('Login') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update-user', $usuario->id) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Nome Completo:') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" value="{{$usuario->name}}"
                                           required autofocus>

                                    @if ($errors->has('name'))
                                        <div id="email-error" class="error text-danger pl-3" for="email"
                                             style="display: block;">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Endereço de E-mail:') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{$usuario->email}}" required autocomplete="email" autofocus>

                                    @if ($errors->has('email'))
                                        <div id="email-error" class="error text-danger pl-3" for="email"
                                             style="display: block;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Senha:') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @if ($errors->has('password'))
                                        <div id="email-error" class="error text-danger pl-3" for="email"
                                             style="display: block;">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirma senha:') }}</label>

                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control" required>

                                    @if ($errors->has('password_confirmation'))
                                        <div id="email-error" class="error text-danger pl-3" for="email"
                                             style="display: block;">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="type"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Conta:') }}</label>

                                <div class="col-md-6">
                                    <select name="type" id="type" class="form-control">
                                        @if ($usuario->tipo == 'Avaliador')
                                            <option value="Avaliador" selected>Avaliador</option>
                                        @else
                                            <option value="Avaliador">Avaliador</option>
                                        @endif

                                        @if ($usuario->tipo == 'Revisor')
                                            <option value="Revisor" selected>Revisor</option>
                                        @else
                                            <option value="Revisor">Revisor</option>
                                        @endif

                                        @if ($usuario->tipo == 'Recurso')
                                            <option value="Recurso" selected>Recurso</option>
                                        @else
                                            <option value="Recurso">Recurso</option>
                                        @endif

                                        @if ($usuario->tipo == 'Supervisor')
                                            <option value="Supervisor" selected>Supervisor</option>
                                        @else
                                            <option value="Supervisor">Supervisor</option>
                                        @endif

                                        @if ($usuario->tipo == 'Admin')
                                            <option value="Admin" selected>Administrador</option>
                                        @else
                                            <option value="Admin">Administrador</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-outline-primary">
                                        {{ __('EDITAR') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/area-restrita/avaliar-radio-recusar.js')}}"></script>
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('js/registro/function.js')}}"></script>
@endsection
