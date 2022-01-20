<!-- Modal -->
<div class="modal fade" id="updateEditalDinamicoAnexo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Anexo ao Formulário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('edital.formulario.update')}}">
                @csrf
                <input type="text" name="editalDinamicoTipoAnexoID" id="editalDinamicoTipoAnexoID" value="" hidden>
                <div class="modal-body">
                    <div class="input-group">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputCargo">Cargos:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <select name="inputCargo" class="form-control" id="modal_inputCargo">
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
                            <select name="inputTipoAnexo" class="form-control" id="modal_inputTipoAnexo">
                                @foreach($tiposAnexos as $tipoAnexo)
                                    <option value="{{$tipoAnexo->id}}">{{$tipoAnexo->tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="input-group" id="inputNomeAnexoEdita">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputNomeAnexoEdita">Nome do Documento:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <input type="text" name="inputNomeAnexo" class="form-control"
                                   placeholder="Nome do Documento" id="inputNomeAnexoEditaValor" required>
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
                                   id="pontuar_publica_privada_edita_sim" value="1" class="">
                            <label class="mr-1">Não</label>
                            <input type="radio" name="pontuar_publica_privada"
                                   id="pontuar_publica_privada_edita_nao" value="0" class=""
                                   checked>
                        </div>
                    </div>

                    <div class="input-group mt-2" id="inputManualEdita">
                        <div class="input-group mt-2">
                            <div class="col col-sm-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputManual">Pontuação Manual:</span>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <label class="mr-1">Sim</label>
                                <input type="radio" name="pontuar_manual"
                                       id="pontuar_manual_editar_sim" value="1" class="">
                                <label class="mr-1">Não</label>
                                <input type="radio" name="pontuar_manual"
                                       id="pontuar_manual_editar_nao" value="0" class=""
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
                                <span class="input-group-text">Pontuação máxima:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <input type="text" name="inputPontuacaoMaxima" id="pontuacao_maxima_documento"
                                   class="form-control"
                                   placeholder="Pontuação máxima do documento"
                                   value="{{$editalDinamico->telasEdital->pontuacao_total}}">
                        </div>
                    </div>

                    <div class="input-group" id="inputPontuacaoMaximaDoItemEdita">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"
                                      id="inputPontuacaoMaximaDoItem">Pontuação máxima do anexo:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <input type="text" name="inputPontuacaoMaximaDoItem" id="pontuacao_maxima_item"
                                   class="form-control"
                                   placeholder="Pontuação máxima do anexo">
                        </div>
                    </div>

                    <div class="input-group" id="inputPontuacaoPorItemEdita">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Pontuação por anexo:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <input type="text" name="inputPontuacaoPorItem" id="pontuacao_por_item"
                                   class="form-control"
                                   placeholder="Pontuação por item do documento">
                        </div>
                    </div>

                    <div class="input-group" id="inputQuantiadeAnexosEdita">
                        <div class="col col-sm-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Quantiade de anexos:</span>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <input type="text" name="inputQuantiadeAnexos" id="inputQuantiadeAnexosEditaValor"
                                   class="form-control"
                                   placeholder="Quantidade de anexos para esse documento">
                        </div>
                    </div>
                    <div id="experienciapublicoprivadoEdita" hidden>
                        <div class="input-group">
                            <div class="col col-sm-12">
                                <hr>
                                <h6 class="input-group-text mb-3">Por experiência em cargos publicos ou
                                    privados</h6>
                            </div>
                        </div>
                        <div class="input-group mt-2">
                            <div class="col col-sm-6">
                                <div class="input-group-prepend">
                                        <span class="input-group-text"
                                              id="inputTipoExperiencia">Tipo da experiência:</span>
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
                                <input type="text" name="inputPorAno" id="pontuacao_por_ano" class="form-control"
                                       placeholder="Exemplo: 8, 0.6, 1.5">
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="col col-sm-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Pontuação por mês:</span>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <input type="text" name="inputPorMes" id="pontuacao_por_mes" class="form-control"
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
