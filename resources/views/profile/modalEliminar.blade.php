<div class="modal fade" id="ModalEliminar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>{{ __('Eliminar foto de perfil') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('ProfileDeleteImage',['id'=>$User->id]) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>{{ __('¿Realmente deseas eliminarla?') }}</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{ __('Cancelar') }}</button>
                        <button type="submit" class="btn btn-outline-success">{{ __('Eliminar Imagen') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>