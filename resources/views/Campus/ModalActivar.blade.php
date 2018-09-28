<div class="modal fade" id="activar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ "Activar" }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('¿Realmente desea activar el plantel?') }}</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-danger" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <form action="{{ route('CampusActivate') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-outline-success">{{ __('Aceptar') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>