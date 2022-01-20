<!-- Modal -->
<div class="modal fade" id="storeTitulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo Título</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('tipoanexo.store')}}">
                @csrf
                <input type="text" name="editalDinamicoID" value="{{$editalDinamico->id}}" hidden>
                <div class="modal-body">
                    <div class="input-group">
                        <div class="col col-sm-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputTitulo">Título:</span>
                            </div>
                        </div>
                        <div class="col col-sm-9">
                            <input type="text" name="inputTitulo" class="form-control"
                                   placeholder="Nome do Título" value="{{old('inputTitulo')}}">
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
