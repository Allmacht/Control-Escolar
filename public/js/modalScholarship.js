$(document).on('click', '.open-modal', function () {
    var id = $(this).data('id');
    $(".modal-footer #id").val(id);
});