<!-- Modal -->
<div class="modal fade" id="storeCargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('cargo.store')}}">
                @csrf
                <input type="text" name="escolaridadeEditalDinamicoID" value="{{$escolaridadeEditalDinamico->id}}" hidden />
                <div class="modal-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputCargo">Nome do Cargo:</span>
                        </div>
                        <input type="text" class="form-control" name="inputCargo">
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
