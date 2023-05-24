const deleteModalSubmit = $('#deleteModalSubmit');
const deleteModal = document.getElementById('deleteModal');
deleteModal.addEventListener('show.bs.modal', (e) => {
    $('#deleteModalLabel').text($(e.relatedTarget).attr('data-title'));
    $('#deleteModalText').html($(e.relatedTarget).attr('data-text'));
    deleteModalSubmit.attr('data-action', $(e.relatedTarget).attr('data-action'));
    deleteModalSubmit.attr('data-id', $(e.relatedTarget).attr('data-id'));
    if($(e.relatedTarget).attr('data-model')){
        deleteModalSubmit.attr('data-model', $(e.relatedTarget).attr('data-model'));
    }
});

$(document).on('click', '#deleteModalSubmit', function(){
    let id = deleteModalSubmit.attr("data-id");
    let action = deleteModalSubmit.attr("data-action");
    let token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: action,
        method: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success:function(response) {
            if(response.success) {
                $('#deleteModal .btn-close').click();
                window.location.href = response.path;
            } else {
                $('#deleteModal .result-alert').html('<div class="alert alert-danger mb-0">' + response.msg + '</div>');
            }
        },
        error: function(error) {
            $('#deleteModal .result-alert').html('<div class="alert alert-danger mb-0">An error has occurred! Please try later.</div>');
        }
    });
});

