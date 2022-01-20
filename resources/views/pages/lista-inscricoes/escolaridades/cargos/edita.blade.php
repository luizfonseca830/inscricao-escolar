<!-- Modal -->
<div class="modal fade" id="updateCargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('cargo.update')}}">
                @csrf
                <input type="text" name="escolaridadeEditalDinamicoID" id="modal_escolaridadeEditalDinamico" hidden />
                <input type="text" name="cargo_id" id="modal_cargo_id" hidden />
                <div class="modal-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputCargo">Nome do Cargo:</span>
                        </div>
                        <input type="text" class="form-control" name="inputCargo" id="modal_inputCargo" value="teste">
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
