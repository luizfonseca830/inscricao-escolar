<!-- Modal -->
<div class="modal fade" id="storeEscolaridade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro Nível Escolaridade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('escolaridade.store')}}">
                <input type="text" name="editalDinamicoID" value="{{$editalDinamico->id}}" hidden>
                @csrf
                <div class="modal-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputEscolaridade">Escolaridade:</span>
                        </div>
                        <input type="text" class="form-control" name="inputEscolaridade">
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
