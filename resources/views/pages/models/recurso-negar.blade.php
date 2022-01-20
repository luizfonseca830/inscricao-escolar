<div class="modal fade" id="modalRecursoNegar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{route('recurso.negar')}}">
            @csrf
            <input type="text" name="pessoa_id" value="{{$pessoa->id}}" hidden>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Negar Recurso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="card-title mb-3">Motivo para Nega o Recurso</h5>
                    <div class="form-group mt-3">
                        <label for="motivo_reav">Descreva o motivo</label>
                        <textarea class="form-control mt-4" name="motivo_reav" id="motivo_reav" maxlength = "16777214" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Fechar">
                    <input type="submit" class="btn btn-primary" value="Salvar">
                </div>
            </div>
        </form>
    </div>
</div>
