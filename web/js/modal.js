function _modal() {
    $('.btn-modal').click(function (e) {
        e.preventDefault();
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent').load($(this).attr('href'));
            document.getElementById('modalHeader').innerHTML = "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>" +
                '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('href'));
            document.getElementById('modalHeader').innerHTML = "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>" +
                '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
}
_modal();
$(document).on('pjax:success', function () {
    _modal();
});