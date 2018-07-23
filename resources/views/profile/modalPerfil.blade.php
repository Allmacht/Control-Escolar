<div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>{{ __('Foto de perfil') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('ProfileUpdate',['id'=>$User->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="profile_picture">{{ __('Selecciona una imagen') }}</label>
                            <input type="file" class="form-control-file" name="profile_picture" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{ __('Cancelar') }}</button>
                        <button type="submit" class="btn btn-outline-success">{{ __('Actualizar Imagen') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>