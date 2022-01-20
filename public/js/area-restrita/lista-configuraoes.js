$(document).ready(function () {
    var listaConfiguracoes = $('#lista-configuracoes').DataTable({
        "iDisplayStart ": 100,
        "iDisplayLength": 100,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        language: {
            "emptyTable": "Nenhum registro encontrado",
            "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 até 0 de 0 registros",
            "infoFiltered": "(Filtrados de _MAX_ registros)",
            "infoThousands": ".",
            "loadingRecords": "Carregando...",
            "processing": "Processando...",
            "zeroRecords": "Nenhum registro encontrado",
            "search": "Pesquisar",
            "paginate": {
                "next": "Próximo",
                "previous": "Anterior",
                "first": "Primeiro",
                "last": "Último"
            },
            "aria": {
                "sortAscending": ": Ordenar colunas de forma ascendente",
                "sortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                },
                "1": "%d linha selecionada",
                "_": "%d linhas selecionadas",
                "cells": {
                    "1": "1 célula selecionada",
                    "_": "%d células selecionadas"
                },
                "columns": {
                    "1": "1 coluna selecionada",
                    "_": "%d colunas selecionadas"
                }
            },
            "buttons": {
                "copySuccess": {
                    "1": "Uma linha copiada com sucesso",
                    "_": "%d linhas copiadas com sucesso"
                },
                "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                "colvis": "Visibilidade da Coluna",
                "colvisRestore": "Restaurar Visibilidade",
                "copy": "Copiar",
                "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
                "copyTitle": "Copiar para a Área de Transferência",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todos os registros",
                    "1": "Mostrar 1 registro",
                    "_": "Mostrar %d registros"
                },
                "pdf": "PDF",
                "print": "Imprimir"
            },
            "autoFill": {
                "cancel": "Cancelar",
                "fill": "Preencher todas as células com",
                "fillHorizontal": "Preencher células horizontalmente",
                "fillVertical": "Preencher células verticalmente"
            },
            "lengthMenu": "Exibir _MENU_ resultados por página",
            "searchBuilder": {
                "add": "Adicionar Condição",
                "button": {
                    "0": "Construtor de Pesquisa",
                    "_": "Construtor de Pesquisa (%d)"
                },
                "clearAll": "Limpar Tudo",
                "condition": "Condição",
                "conditions": {
                    "date": {
                        "after": "Depois",
                        "before": "Antes",
                        "between": "Entre",
                        "empty": "Vazio",
                        "equals": "Igual",
                        "not": "Não",
                        "notBetween": "Não Entre",
                        "notEmpty": "Não Vazio"
                    },
                    "number": {
                        "between": "Entre",
                        "empty": "Vazio",
                        "equals": "Igual",
                        "gt": "Maior Que",
                        "gte": "Maior ou Igual a",
                        "lt": "Menor Que",
                        "lte": "Menor ou Igual a",
                        "not": "Não",
                        "notBetween": "Não Entre",
                        "notEmpty": "Não Vazio"
                    },
                    "string": {
                        "contains": "Contém",
                        "empty": "Vazio",
                        "endsWith": "Termina Com",
                        "equals": "Igual",
                        "not": "Não",
                        "notEmpty": "Não Vazio",
                        "startsWith": "Começa Com"
                    }
                },
                "data": "Data",
                "deleteTitle": "Excluir regra de filtragem",
                "logicAnd": "E",
                "logicOr": "Ou",
                "title": {
                    "0": "Construtor de Pesquisa",
                    "_": "Construtor de Pesquisa (%d)"
                },
                "value": "Valor"
            },
            "searchPanes": {
                "clearMessage": "Limpar Tudo",
                "collapse": {
                    "0": "Painéis de Pesquisa",
                    "_": "Painéis de Pesquisa (%d)"
                },
                "count": "{total}",
                "countFiltered": "{shown} ({total})",
                "emptyPanes": "Nenhum Painel de Pesquisa",
                "loadMessage": "Carregando Painéis de Pesquisa...",
                "title": "Filtros Ativos"
            },
            "searchPlaceholder": "Digite um termo para pesquisar",
            "thousands": "."
        },
    });

    if (listaConfiguracoes) {
        $('#dataTables-lista').removeAttr('hidden')
        $('#loading').attr('hidden', true)
    }
    var cargo_id = $('#cargo_select').val()
    $('#cargo_id_tipo').val(cargo_id)
    $('#cargo_select').click(function () {
        var cargo_id = $('#cargo_select').val()
        $('#cargo_id_tipo').val(cargo_id)
    })
    $('#lista-configuracoes_paginate').click(function () {
        criar_editar();
    })
    $('#lista-configuracoes_filter').keypress(function () {
        criar_editar()
    })

    $('tr').click(function () {
        criar_editar()
    })

    function criar_editar() {
        $('#edita-anexo[data-id]').click(function () {
            $('#inputNomeAnexoEditaValor').val($(this).attr('data-nome'));

            //CARGO
            var cargo_id = $(this).attr('data-cargo');
            //REMOVE ATTR
            $('#modal_inputCargo option').each(function () {
                $(this).removeAttr('selected', 'selected')
            })
            //ADD ATR LOCATION
            $('#modal_inputCargo option').each(function () {
                var cargo_id_option = $(this).val();
                if (cargo_id_option == cargo_id) {
                    $(this).attr('selected', 'selected')
                }
            })

            //TIPO DOCUMENTO
            var tipo_documento = $(this).attr('data-tipo-documento')
            //REMOVE ATTR
            $('#modal_inputTipoAnexo option').each(function () {
                $(this).removeAttr('selected', 'selected')
            })
            //ADD ATR LOCATION
            $('#modal_inputTipoAnexo option').each(function () {
                var tipo_documento_option = $(this).val();
                if (tipo_documento_option == tipo_documento) {
                    $(this).attr('selected', 'selected')
                }
            })

            //OBRIGATORIO
            if ($(this).attr('data-obrigatorio') == 1) {
                $('#inputObrigatorio[value="0"]').attr('checked', false)
                $('#inputObrigatorio[value="1"]').attr('checked', true)
            } else {
                $('#inputObrigatorio[value="1"]').attr('checked', false)
                $('#inputObrigatorio[value="0"]').attr('checked', true)

            }

            //PRIVADA E PUBLICA
            if ($(this).attr('data-inserir-publica-privada') == 1) {
                $('#pontuar_publica_privada_edita_nao[value="0"]').attr('checked', false)
                $('#pontuar_publica_privada_edita_sim[value="1"]').attr('checked', true)
                $('#experienciapublicoprivadoEdita').removeAttr('hidden');
                $('#inputPontuacaoPorItemEdita').attr('hidden', true);
                $('#inputManualEdita').attr('hidden', true);
                $('#inputQuantiadeAnexosEdita').attr('hidden', true);
            } else {
                $('#pontuar_publica_privada_edita_sim[value="1"]').attr('checked', false)
                $('#pontuar_publica_privada_edita_nao[value="0"]').attr('checked', true)
                $('#experienciapublicoprivadoEdita').attr('hidden', true);
                $('#inputPontuacaoPorItemEdita').removeAttr('hidden');
                $('#inputManualEdita').removeAttr('hidden');
                $('#inputQuantiadeAnexosEdita').removeAttr('hidden');
            }

            //MANUAL
            if ($(this).attr('data-pontuar-manual') == 1) {
                $('#pontuar_manual_editar_nao').attr('checked', false);
                $('#pontuar_manual_editar_sim').attr('checked', true);
            } else {
                $('#pontuar_manual_editar_sim').attr('checked', false);
                $('#pontuar_manual_editar_nao').attr('checked', true);
            }

            //TIPO EXPERIENCIA
            $('#inputTipoExperiencia[value="0"]').attr('checked', false)
            $('#inputTipoExperiencia[value="1"]').attr('checked', false)
            if ($(this).attr('data-tipo-experiencia') == 1) {
                $('#inputTipoExperiencia[value="0"]').attr('checked', false)
                $('#inputTipoExperiencia[value="1"]').attr('checked', true)
            } else if ($(this).attr('data-tipo-experiencia') != '' && $(this).attr('data-tipo-experiencia') == 0) {
                $('#inputTipoExperiencia[value="1"]').attr('checked', false)
                $('#inputTipoExperiencia[value="0"]').attr('checked', true)
            }

            $('#pontuacao_maxima_documento').val($(this).attr('data-pontuacao-maxima'))
            $('#pontuacao_maxima_item').val($(this).attr('data-pontuacao_maxima_item'))
            $('#pontuacao_por_item').val($(this).attr('data-pontuacao-item'))
            $('#inputQuantiadeAnexosEditaValor').val($(this).attr('data-quantidade-anexo'))
            $('#pontuacao_por_ano').val($(this).attr('data-pontuacao-por-ano'))
            $('#pontuacao_por_mes').val($(this).attr('data-pontuacao-mes'))

            //SETEDITAL
            $("#editalDinamicoTipoAnexoID").val($(this).attr('data-id'))
            $('#updateEditalDinamicoAnexo').modal('show')
        });
    }

    criar_editar();

});
