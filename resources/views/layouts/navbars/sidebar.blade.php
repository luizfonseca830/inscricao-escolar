<div class="sidebar" data-color="orange" data-background-color="white"
     data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="{{route('home')}}" class="simple-text logo-normal">
            {{ __('Início') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @if(auth()->user()->tipo == 'Admin')
                <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
                      <i class="material-icons">settings</i>
                        <p>{{ __('Configurações') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="laravelExample">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'TituloAlterar' ? ' active' : '' }}">
                                <a class="nav-link" href="{{route('titulo.index')}}">
                                    <span class="sidebar-mini"> ATS </span>
                                    <span class="sidebar-normal"> {{ __('Alterar Título do Sistema') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'ListaCarrossel' ? ' active' : '' }}">
                                <a class="nav-link" href="{{route('lista.carrossel.index')}}">
                                    <span class="sidebar-mini"> C/AB </span>
                                    <span class="sidebar-normal"> {{ __('Criar/Alterar  Banner') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'Gestao' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    <span class="sidebar-mini"> GU </span>
                                    <span class="sidebar-normal"> {{ __('Gestão de Usuário') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'TelaCriar' ? ' active' : '' }}">
                                <a class="nav-link" href="{{route('tela-criar')}}">
                                    <span class="sidebar-mini"> LT </span>
                                    <span class="sidebar-normal"> {{ __('Criar Tela/Anexos') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'TelaLiberar' ? ' active' : '' }}">
                                <a class="nav-link" href="{{route('tela-liberar')}}">
                                    <span class="sidebar-mini"> LT </span>
                                    <span class="sidebar-normal"> {{ __('Liberar Tela/Anexos') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'list_formulario_ativo' ? ' active' : '' }}">
                                <a class="nav-link" href="{{route('lista.formularios')}}">
                                    <span class="sidebar-mini"> LFA </span>
                                    <span class="sidebar-normal"> {{ __('Lista de Formulários Ativos') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'lista_participantes' ? ' active' : '' }}">
                                <a class="nav-link" href="{{route('lista.candidatos.index')}}">
                                    <span class="sidebar-mini"> CA </span>
                                    <span class="sidebar-normal"> {{ __('Candidatos') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if (auth()->user()->tipo == 'Admin' || auth()->user()->tipo == 'Avaliador' || auth()->user()->tipo == 'Supervisor')
                <li class="nav-item{{ $activePage == 'avaliacao' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('visualizacao.escolher.edital') }}">
                        <i class="material-icons">library_books</i>
                        <p>{{ __('Avaliação') }}</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->tipo == 'Admin' || auth()->user()->tipo == 'Revisor' || auth()->user()->tipo == 'Supervisor')
                <li class="nav-item{{ $activePage == 'revisao' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('revisao.escolher.edital') }}">
                        <i class="material-icons">filter_none</i>
                        <p>{{ __('Revisão') }}</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->tipo == 'Admin' || auth()->user()->tipo == 'Recurso' || auth()->user()->tipo == 'Supervisor')
                <li class="nav-item{{ $activePage == 'recurso' ? ' active' : '' }}">
                    <a class="nav-link" href="{{route('recurso.escolher.edital')}}">
                        <i class="material-icons">folder_open</i>
                        <p>{{ __('Recurso') }}</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->tipo == 'Admin' || auth()->user()->tipo == 'Supervisor')
                <li class="nav-item{{ $activePage == 'relatorio' ? ' active' : '' }}">
                    <a class="nav-link" href="{{route('relatorio.selecionar.edital')}}">
                        <i class="material-icons">subject</i>
                        <p>{{ __('Relatório') }}</p>
                    </a>
                </li>
                <li class="nav-item{{ $activePage == 'transparencia' ? ' active' : '' }}">
                    <a class="nav-link" href="{{route('lista-transparencia')}}">
                        <i class="material-icons">visibility</i>
                        <p>{{ __('Transparência') }}</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
