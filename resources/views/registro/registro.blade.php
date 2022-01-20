@extends('layouts.header-footer')
@section('title')
    <title>Processo Seletvo Simplificado - REGISTRO</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/modal-confirmacao.css')}}">
@endsection

@section('content')
    <main class="container" id="ajuste">
        <div class="row">
            <form id="formulario_registro" method="post" action="{{route('registro/parte1')}}">
                <input type="text" name="type_edital" value="{{$id}}" hidden>
                @csrf
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                    {{session()->forget('error')}}
                @endif
                <ul id="progress">
                    <li class="ativo">Dados Pessoais</li>
                    <li>Endereço</li>
                    <li>Cargo</li>
                </ul>

                <fieldset>
                    <h2>Dados Pessoais</h2>

                    <input type="text" name="nome_completo" id="nome_completo" autocomplete="nome_completo"
                           value="{{old('nome_completo')}}"
                           class="@error('nome_completo') is-invalid @enderror form-control"
                           placeholder="Informe seu Nome Completo"
                           autofocus/>
                    @error('nome_completo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="cpf" id="cpf" autocomplete="cpf" value="{{old('cpf')}}"
                           class="@error('cpf') is-invalid @enderror form-control" placeholder="Informe seu CPF"/>
                    @error('cpf')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="rg" id="rg" autocomplete="rg" value="{{old('rg')}}"
                           class="@error('rg') is-invalid @enderror form-control ajuseLeft"
                           placeholder="Informe seu RG"/>
                    <input type="text" name="orgao_emissor" id="orgao_emissor" autocomplete="orgao_emissor"
                           value="{{old('orgao_emissor')}}"
                           class="@error('orgao_emissor') is-invalid @enderror form-control ajusteRight"
                           placeholder="Orgão Emissor"/>
                    @error('rg')
                    <div class="alert alert-danger" style="width: 40%;display: inline-block;">{{ $message }}</div>
                    @enderror
                    @error('orgao_emissor')
                    <div class="alert alert-danger" style="width: 40%;display: inline-block;">{{ $message }}</div>
                    @enderror

                    <input type="text" id="telefone" name="telefone" autocomplete="telefone" value="{{old('telefone')}}"
                           class="@error('telefone') is-invalid @enderror form-control"
                           placeholder="Informe seu Telefone"/>
                    @error('telefone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <select name="nacionalidade" id="nacionalidade">
                        <option value="">Informe sua Nacionalidade</option>
                        <option value="Brasil" >Brasil</option>
                        <option value="Afeganistão">Afeganistão</option>
                        <option value="África do Sul">África do Sul</option>
                        <option value="Albânia">Albânia</option>
                        <option value="Alemanha">Alemanha</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antilhas Holandesas">Antilhas Holandesas</option>
                        <option value="Antárctida">Antárctida</option>
                        <option value="Antígua e Barbuda">Antígua e Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Argélia">Argélia</option>
                        <option value="Armênia">Armênia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Arábia Saudita">Arábia Saudita</option>
                        <option value="Austrália">Austrália</option>
                        <option value="Áustria">Áustria</option>
                        <option value="Azerbaijão">Azerbaijão</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrein">Bahrein</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belize">Belize</option>
                        <option value="Benim">Benim</option>
                        <option value="Bermudas">Bermudas</option>
                        <option value="Bielorrússia">Bielorrússia</option>
                        <option value="Bolívia">Bolívia</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Brunei">Brunei</option>
                        <option value="Bulgária">Bulgária</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Butão">Butão</option>
                        <option value="Bélgica">Bélgica</option>
                        <option value="Bósnia e Herzegovina">Bósnia e Herzegovina</option>
                        <option value="Cabo Verde">Cabo Verde</option>
                        <option value="Camarões">Camarões</option>
                        <option value="Camboja">Camboja</option>
                        <option value="Canadá">Canadá</option>
                        <option value="Catar">Catar</option>
                        <option value="Cazaquistão">Cazaquistão</option>
                        <option value="Chade">Chade</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Chipre">Chipre</option>
                        <option value="Colômbia">Colômbia</option>
                        <option value="Comores">Comores</option>
                        <option value="Coreia do Norte">Coreia do Norte</option>
                        <option value="Coreia do Sul">Coreia do Sul</option>
                        <option value="Costa do Marfim">Costa do Marfim</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Croácia">Croácia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Dinamarca">Dinamarca</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Egito">Egito</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Emirados Árabes Unidos">Emirados Árabes Unidos</option>
                        <option value="Equador">Equador</option>
                        <option value="Eritreia">Eritreia</option>
                        <option value="Escócia">Escócia</option>
                        <option value="Eslováquia">Eslováquia</option>
                        <option value="Eslovênia">Eslovênia</option>
                        <option value="Espanha">Espanha</option>
                        <option value="Estados Federados da Micronésia">Estados Federados da Micronésia</option>
                        <option value="Estados Unidos">Estados Unidos</option>
                        <option value="Estônia">Estônia</option>
                        <option value="Etiópia">Etiópia</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Filipinas">Filipinas</option>
                        <option value="Finlândia">Finlândia</option>
                        <option value="França">França</option>
                        <option value="Gabão">Gabão</option>
                        <option value="Gana">Gana</option>
                        <option value="Geórgia">Geórgia</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Granada">Granada</option>
                        <option value="Gronelândia">Gronelândia</option>
                        <option value="Grécia">Grécia</option>
                        <option value="Guadalupe">Guadalupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernesei">Guernesei</option>
                        <option value="Guiana">Guiana</option>
                        <option value="Guiana Francesa">Guiana Francesa</option>
                        <option value="Guiné">Guiné</option>
                        <option value="Guiné Equatorial">Guiné Equatorial</option>
                        <option value="Guiné-Bissau">Guiné-Bissau</option>
                        <option value="Gâmbia">Gâmbia</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungria">Hungria</option>
                        <option value="Ilha Bouvet">Ilha Bouvet</option>
                        <option value="Ilha de Man">Ilha de Man</option>
                        <option value="Ilha do Natal">Ilha do Natal</option>
                        <option value="Ilha Heard e Ilhas McDonald">Ilha Heard e Ilhas McDonald</option>
                        <option value="Ilha Norfolk">Ilha Norfolk</option>
                        <option value="Ilhas Cayman">Ilhas Cayman</option>
                        <option value="Ilhas Cocos (Keeling)">Ilhas Cocos (Keeling)</option>
                        <option value="Ilhas Cook">Ilhas Cook</option>
                        <option value="Ilhas Feroé">Ilhas Feroé</option>
                        <option value="Ilhas Geórgia do Sul e Sandwich do Sul">Ilhas Geórgia do Sul e Sandwich do Sul</option>
                        <option value="Ilhas Malvinas">Ilhas Malvinas</option>
                        <option value="Ilhas Marshall">Ilhas Marshall</option>
                        <option value="Ilhas Menores Distantes dos Estados Unidos">Ilhas Menores Distantes dos Estados Unidos</option>
                        <option value="Ilhas Salomão">Ilhas Salomão</option>
                        <option value="Ilhas Virgens Americanas">Ilhas Virgens Americanas</option>
                        <option value="Ilhas Virgens Britânicas">Ilhas Virgens Britânicas</option>
                        <option value="Ilhas Åland">Ilhas Åland</option>
                        <option value="Indonésia">Indonésia</option>
                        <option value="Inglaterra">Inglaterra</option>
                        <option value="Índia">Índia</option>
                        <option value="Iraque">Iraque</option>
                        <option value="Irlanda do Norte">Irlanda do Norte</option>
                        <option value="Irlanda">Irlanda</option>
                        <option value="Irã">Irã</option>
                        <option value="Islândia">Islândia</option>
                        <option value="Israel">Israel</option>
                        <option value="Itália">Itália</option>
                        <option value="Iêmen">Iêmen</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japão">Japão</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordânia">Jordânia</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Laos">Laos</option>
                        <option value="Lesoto">Lesoto</option>
                        <option value="Letônia">Letônia</option>
                        <option value="Libéria">Libéria</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lituânia">Lituânia</option>
                        <option value="Luxemburgo">Luxemburgo</option>
                        <option value="Líbano">Líbano</option>
                        <option value="Líbia">Líbia</option>
                        <option value="Macau">Macau</option>
                        <option value="Macedônia">Macedônia</option>
                        <option value="Madagáscar">Madagáscar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Maldivas">Maldivas</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Malásia">Malásia</option>
                        <option value="Marianas Setentrionais">Marianas Setentrionais</option>
                        <option value="Marrocos">Marrocos</option>
                        <option value="Martinica">Martinica</option>
                        <option value="Mauritânia">Mauritânia</option>
                        <option value="Maurícia">Maurícia</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Moldávia">Moldávia</option>
                        <option value="Mongólia">Mongólia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Moçambique">Moçambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="México">México</option>
                        <option value="Mônaco">Mônaco</option>
                        <option value="Namíbia">Namíbia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Nicarágua">Nicarágua</option>
                        <option value="Nigéria">Nigéria</option>
                        <option value="Niue">Niue</option>
                        <option value="Noruega">Noruega</option>
                        <option value="Nova Caledônia">Nova Caledônia</option>
                        <option value="Nova Zelândia">Nova Zelândia</option>
                        <option value="Níger">Níger</option>
                        <option value="Omã">Omã</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestina">Palestina</option>
                        <option value="Panamá">Panamá</option>
                        <option value="Papua-Nova Guiné">Papua-Nova Guiné</option>
                        <option value="Paquistão">Paquistão</option>
                        <option value="Paraguai">Paraguai</option>
                        <option value="País de Gales">País de Gales</option>
                        <option value="Países Baixos">Países Baixos</option>
                        <option value="Peru">Peru</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Polinésia Francesa">Polinésia Francesa</option>
                        <option value="Polônia">Polônia</option>
                        <option value="Porto Rico">Porto Rico</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Quirguistão">Quirguistão</option>
                        <option value="Quênia">Quênia</option>
                        <option value="Reino Unido">Reino Unido</option>
                        <option value="República Centro-Africana">República Centro-Africana</option>
                        <option value="República Checa">República Checa</option>
                        <option value="República Democrática do Congo">República Democrática do Congo</option>
                        <option value="República do Congo">República do Congo</option>
                        <option value="República Dominicana">República Dominicana</option>
                        <option value="Reunião">Reunião</option>
                        <option value="Romênia">Romênia</option>
                        <option value="Ruanda">Ruanda</option>
                        <option value="Rússia">Rússia</option>
                        <option value="Saara Ocidental">Saara Ocidental</option>
                        <option value="Saint Martin">Saint Martin</option>
                        <option value="Saint-Barthélemy">Saint-Barthélemy</option>
                        <option value="Saint-Pierre e Miquelon">Saint-Pierre e Miquelon</option>
                        <option value="Samoa Americana">Samoa Americana</option>
                        <option value="Samoa">Samoa</option>
                        <option value="Santa Helena, Ascensão e Tristão da Cunha">Santa Helena, Ascensão e Tristão da Cunha</option>
                        <option value="Santa Lúcia">Santa Lúcia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serra Leoa">Serra Leoa</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Singapura">Singapura</option>
                        <option value="Somália">Somália</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Suazilândia">Suazilândia</option>
                        <option value="Sudão">Sudão</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Suécia">Suécia</option>
                        <option value="Suíça">Suíça</option>
                        <option value="Svalbard e Jan Mayen">Svalbard e Jan Mayen</option>
                        <option value="São Cristóvão e Nevis">São Cristóvão e Nevis</option>
                        <option value="São Marino">São Marino</option>
                        <option value="São Tomé e Príncipe">São Tomé e Príncipe</option>
                        <option value="São Vicente e Granadinas">São Vicente e Granadinas</option>
                        <option value="Sérvia">Sérvia</option>
                        <option value="Síria">Síria</option>
                        <option value="Tadjiquistão">Tadjiquistão</option>
                        <option value="Tailândia">Tailândia</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tanzânia">Tanzânia</option>
                        <option value="Terras Austrais e Antárticas Francesas">Terras Austrais e Antárticas Francesas</option>
                        <option value="Território Britânico do Oceano Índico">Território Britânico do Oceano Índico</option>
                        <option value="Timor-Leste">Timor-Leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Toquelau">Toquelau</option>
                        <option value="Trinidad e Tobago">Trinidad e Tobago</option>
                        <option value="Tunísia">Tunísia</option>
                        <option value="Turcas e Caicos">Turcas e Caicos</option>
                        <option value="Turquemenistão">Turquemenistão</option>
                        <option value="Turquia">Turquia</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Ucrânia">Ucrânia</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Uruguai">Uruguai</option>
                        <option value="Uzbequistão">Uzbequistão</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Vaticano">Vaticano</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietname">Vietname</option>
                        <option value="Wallis e Futuna">Wallis e Futuna</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                        <option value="Zâmbia">Zâmbia</option>
                    </select>
                    @error('nacionalidade')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <select name="naturalidade" id="naturalidade">
                        <option value="">Informe sua Naturalidade Caso Brasileiro</option>
                        <option value="Acre">Acre</option>
                        <option value="Alagoas">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                    @error('naturalidade')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="email" name="email" id="email" autocomplete="email" value="{{old('email')}}"
                           class="@error('email') is-invalid @enderror form-control" placeholder="Informe seu Email"/>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="email" name="email_confirmation" id="email_confirmation"
                           autocomplete="email_confirmation" value="{{old('email_confirmation')}}"
                           class="@error('email') is-invalid @enderror form-control" placeholder="Confirme seu Email"/>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <p>Data de Nascimento</p>
                    <input type="date" name="data_nascimento" max="2004-12-31" id="data_nascimento"
                           autocomplete="data_nascimento" value="{{old('data_nascimento')}}"
                           class="@error('data_nascimento') is-invalid @enderror form-control"/>
                    @error('data_nascimento')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <p>Sexo</p>
                    <select class="@error('sexo') is-invalid @enderror form-control" name="sexo" id="sexo">
                        <option value="">Selecione</option>
                        <option value="H">Masculino</option>
                        <option value="M">Feminino</option>
                    </select>
                    @error('sexo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <p>PNE - Portador de Necessidades Especiais</p>
                    <select name="deficiencia" class="@error('deficiencia') is-invalid @enderror form-control" id="pne">
                        <option value="Sim">Sim</option>
                        <option value="Nao" selected>Nao</option>
                    </select>
                    @error('deficiencia')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <input type="button" name="next" id="next" class="next acao" value="Próximo"/>
                </fieldset>

                <fieldset>

                    <h2>Endereço</h2>
                    <input type="text" name="cep" id="cep" autocomplete="cep" value="{{old('cep')}}"
                           class="@error('cep') is-invalid @enderror form-control" placeholder="Informe seu CEP"/>
                    @error('cep')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <span class="help-block"></span>
                    <input type="text" name="bairro" id="bairro" autocomplete="bairro" value="{{old('bairro')}}"
                           class="@error('bairro') is-invalid @enderror form-control" placeholder="Informe seu Bairro"/>
                    @error('bairro')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="endereco" id="endereco" autocomplete="endereco" value="{{old('endereco')}}"
                           class="@error('endereco') is-invalid @enderror form-control"
                           placeholder="Informe seu Endereço/UF"/>
                    @error('endereco')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="number" name="numero" min="0" id="numero" autocomplete="numero"
                           value="{{old('numero')}}" class="@error('numero') is-invalid @enderror form-control"
                           placeholder="Informe o número"/>
                    @error('numero')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="button" name="next" id="next" class="next acao" value="Próximo"/>
                    <input type="button" name="prev" id="prev" class="prev acao" value="Anterior"/>

                </fieldset>

                <fieldset>
                    <h2>Cargo</h2>
                    <h3>Selecione sua Escolaridade</h3>


                    <select name="escolaridade" id="escolaridade">
                        <option value="">Não selecionado</option>
                        @foreach($editalDinamico->escolaridadeEditalDinamico as $escolariadeEditalDinamico)
                            <option
                                value="{{$escolariadeEditalDinamico->escolaridade->id}}">{{$escolariadeEditalDinamico->escolaridade->nivel_escolaridade}}</option>
                        @endforeach
                    </select>
                    @error('escolaridade')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div hidden id="cargo-div">
                        <h3>Selecione seu Cargo</h3>
                        <select name="CARGO" class="cargos" id="cargo">
                            <option value="0">Não selecionado</option>
                            @foreach($cargos as $cargo)
                                <option data-escolaridade="{{$cargo->escolaridade->id}}"
                                        value="{{$cargo->id}}">{{$cargo->cargo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                                <input type="checkbox" name="termo_de_condicao" required>
                            </div>
                            <div class="col-8">
                                <label>Usuário está ciente de que
                                    fornece informação de forma consciente e voluntária por meio do formulário.
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <input type="checkbox" name="termo_de_privacidade" required>
                            </div>
                            <div class="col-8">
                                <label>Declaro que aceito todas as exigências especificadas no Edital de abertura deste
                                    Processo Seletivo, bem
                                    como serem verdadeiras todas as informações aqui prestadas e estou ciente que
                                    qualquer falsa alegação ou
                                    omissão de informações conforme disposto no edital, implicará em minha exclusão do
                                    processo seletivo,
                                    sujeitando-me, ainda, às penas da lei. Declaro que estar instruído esta ficha de
                                    inscrição com cópias legíveis,
                                    estando ciente em minha desclassificação, caso não esteja.</label>
                            </div>
                        </div>
                    </div>
                    @error('CARGO')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="button" name="next" id="confirma" class="acao" value="Enviar"/>
                    <input type="button" name="prev" id="prev" class="prev acao" value="Anterior"/>
                </fieldset>

                <!-- MODAL DE CONFIRMACAO -->
                <div class="modal" id="modal" tabindex="-1" role="dialog" style="display: none">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Confirmação de Dados</h2>
                            </div>
                            <div class="modal-body text-center">
                                <div class="row">
                                    <h5>Dados Pessoais</h5>
                                    <div class="col col-12">
                                        <p>Nome:
                                            <labe id="nome_conf"></labe>
                                        </p>
                                    </div>
                                    <div class="col col-12">
                                        <p>CPF <label id="cpf_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>RG: <label id="rg_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>Orgão Emissor: <label id="orgao_emissor_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Telefone: <label id="telefone_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>Nacionalidade: <label id="nacionalidade_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>Naturalide: <label id="naturalidade_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Email: <label id="email_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Data Nascimento: <label id="data_nascimento_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>Sexo: <label id="sexo_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>PNE: <label id="pne_conf"></label></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <h5>Endereço</h5>
                                    <div class="col col-12">
                                        <p>CEP: <label id="cep_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Bairro: <label id="bairro_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Endereco: <label id="endereco_conf"></label></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <h5>Escolaridade</h5>
                                    <div class="col col-12">
                                        <p>Nível de Escolaridade: <label id="escolaridade_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Cargo: <label id="cargo_conf"></label></p>
                                    </div>
                                </div>
                                <div class="card bg-danger" id="data_nascimento_error" hidden>
                                    <b style="color: white">Você não está apto a realizar a inscrição. Idade mínima para
                                        o ato da contratação 18 anos.</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">
                                        Fechar
                                    </button>
                                    <button type="submit" class="btn btn-secondary">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </main>
@endsection


@section('script')
    <script src="{{asset('js/registro/function.js')}}"></script>
    <script src="{{asset('js/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('js/registro/mask.js')}}"></script>
    <script src="{{asset('js/registro/confirmacao.js')}}"></script>
    <script src="{{asset('js/registro/cep.js')}}"></script>
    <script src="{{asset('assets/moment.js')}}"></script>
@endsection
