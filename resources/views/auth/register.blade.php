@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'Gestao', 'title' => __('Gestao')])
@extends('layouts.modal-message')
@section('css')
<style>
    label{
        position: initial !important;
    }
</style>
@endsection
@section('content')
<div class="container" style="margin-top: 60px; margin-bottom: 60px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #e96b56; font-weight: bold; color: white" >{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('add-create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nome Completo:') }}</label>

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Endereço de E-mail:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @if ($errors->has('email'))
                                    <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @if ($errors->has('password'))
                                    <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirma senha:') }}</label>

                            <div class="col-md-6">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"  required>

                                @if ($errors->has('password_confirmation'))
                                    <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Conta:') }}</label>

                            <div class="col-md-6">
                                <select name="type" id="type" class="form-control">
                                    <option value="Avaliador">Avaliador</option>
                                    <option value="Revisor">Revisor</option>
                                    <option value="Recurso">Recurso</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Admin">Administrador</option>
                                    <option value="Candidato">Candidato</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-outline-danger">
                                    {{ __('Cadastrar') }}
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
