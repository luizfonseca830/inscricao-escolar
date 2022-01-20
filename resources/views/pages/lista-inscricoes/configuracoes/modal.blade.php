<!-- Modal -->
<div class="modal fade" id="storeEditalDinamicoAnexo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anexo ao Formulário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('edital.formulario.store')}}">
                @csrf
                <input type="text" name="editalDinamicoID" value="{{$editalDinamico->id}}" hidden>
                <div class="modal-body">
                    <div class="input-group">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputCargo">Cargos:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <select name="inputCargo" class="form-control">
                                @foreach($escolaridade_edital_dinamicos as $escolariadeEditalDinamico)
                                    @foreach($escolariadeEditalDinamico->cargos as $cargo)
                                        <option value="{{$cargo->id}}">{{$cargo->cargo}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputTipoAnexo">Tipo de Documento:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <select name="inputTipoAnexo" class="form-control">
                                @foreach($tiposAnexos as $tipoAnexo)
                                    <option value="{{$tipoAnexo->id}}">{{$tipoAnexo->tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="input-group" id="inputNomeAnexo">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputNomeAnexo">Nome do Documento:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <input type="text" name="inputNomeAnexo" class="form-control"
                                   placeholder="Nome do Documento" required>
                        </div>
                    </div>

                    <div class="input-group mt-2">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputNomeAnexo">Obrigátorio:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <label class="mr-1">Sim</label><input type="radio" name="inputObrigatorio"
                                                                  id="inputObrigatorio" value="1" class="">
                            <label class="mr-1">Não</label><input type="radio" name="inputObrigatorio"
                                                                  id="inputObrigatorio" value="0" class="" checked>
                        </div>
                    </div>
                    <div class="input-group mt-2">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputNomeAnexo">Pontuação Publica/Privada:</span>
                            </div>
                        </div>

                        <div class="col col-sm-6">
                            <label class="mr-1">Sim</label>
                            <input type="radio" name="pontuar_publica_privada"
                                   id="pontuar_publica_privada_sim" value="1" class="">
                            <label class="mr-1">Não</label>
                            <input type="radio" name="pontuar_publica_privada"
                                   id="pontuar_publica_privada_nao" value="0" class=""
                                   checked>
                        </div>
                    </div>
                    <div class="input-group mt-2" id="inputManual">
                        <div class="input-group mt-2">
                            <div class="col col-sm-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputManual">Pontuação Manual:</span>
                                </div>
                            </div>

                            <div class="col col-sm-6">
                                <label class="mr-1">Sim</label>
                                <input type="radio" name="pontuar_manual"
                                       id="ponutar_manual_sim" value="1" class="">
                                <label class="mr-1">Não</label>
                                <input type="radio" name="pontuar_manual"
                                       id="ponutar_manual_sim" value="0" class=""
                                       checked>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="col col-sm-12">
                            <hr>
                            <h6 class="input-group-text mb-3">Somente se necessário</h6>
                        </div>
                    </div>

                    <div class="input-group" hidden>
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputPontuacaoMaxima">Pontuação máxima:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <input type="text" name="inputPontuacaoMaxima" class="form-control"
                                   placeholder="Pontuação máxima do documento"
                                   value="{{$editalDinamico->telasEdital->pontuacao_total}}">
                        </div>
                    </div>

                    <div class="input-group" id="inputPontuacaoMaximaDoItem">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"
                                      id="inputPontuacaoMaximaDoItem">Pontuação máxima do anexo:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <input type="text" name="inputPontuacaoMaximaDoItem" class="form-control"
                                   placeholder="Pontuação máxima do anexo">
                        </div>
                    </div>

                    <div class="input-group" id="inputPontuacaoPorItem">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputPontuacaoPorItem">Pontuação por anexo:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <input type="text" name="inputPontuacaoPorItem" class="form-control"
                                   placeholder="Pontuação por anexo do documento">
                        </div>
                    </div>

                    <div class="input-group" id="inputQuantiadeAnexos">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputQuantiadeAnexos">Quantiade de anexos:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <input type="text" name="inputQuantiadeAnexos" id="inputQuantiadeAnexos" class="form-control"
                                   placeholder="Quantidade de anexos para esse documento">
                        </div>
                    </div>
                    <div id="experienciapublicoprivado" hidden>
                        <div class="input-group">
                            <div class="col col-sm-12">
                                <hr>
                                <h6 class="input-group-text mb-3">Por experiência em cargos publicos ou privados</h6>
                            </div>
                        </div>
                        <div class="input-group mt-2">
                            <div class="col col-sm-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputTipoExperiencia">Tipo da experiência:</span>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <label class="mr-1">Público</label><input type="radio" name="inputTipoExperiencia"
                                                                          id="inputTipoExperiencia" value="0"
                                                                          class="">
                                <label class="mr-1">Privado</label><input type="radio" name="inputTipoExperiencia"
                                                                          id="inputTipoExperiencia" value="1"
                                                                          class="">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="col col-sm-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputPorAnoPublico">Pontuação por ano</span>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <input type="text" name="inputPorAno" class="form-control"
                                       placeholder="Exemplo: 8, 0.6, 1.5 ">
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="col col-sm-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputPorMes">Pontuação por mês:</span>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <input type="text" name="inputPorMes" class="form-control"
                                       placeholder="Exemplo: 8, 0.6, 1.5">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Fecha">
                    <input type="submit" class="btn btn-info" value="Salva">
                </div>
            </form>
        </div>
    </div>
</div>
