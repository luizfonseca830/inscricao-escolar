@if (session()->has('sucess'))
    <div class="modal" id="modal" tabindex="-1" role="dialog" style="display: block">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body text-center">
                    <strong>{{session('sucess')}}</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    {{session()->forget('sucess')}}
@endif

@if (session()->has('error'))
    <div class="modal" id="modal" tabindex="-1" role="dialog" style="display: block">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body text-center">
                    <strong>{{session('error')}}</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    {{session()->forget('error')}}
@endif


@error('error')
<div class="modal" id="modal" tabindex="-1" role="dialog" style="display: block">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

            </div>
            <div class="modal-body text-center">
                <strong>{{$mensage}}</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@enderror

@if (isset($sucess))
    <div class="modal" id="modal" tabindex="-1" role="dialog" style="display: block">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

            </div>
            <div class="modal-body text-center">
                <strong>{{$sucess ?? ''}}</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
    </div>
@endif

