var modalPage = new bootstrap.Modal(document.getElementById('modal-page'));

function openModalPage(url, btn) {
    if ($(btn).data('loader') == 'enable') {
        $(btn).prepend('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ');
    }

    $.get(url).done(function (data) {
        if (!data.success) {
            if (!data.toaster) {
                return false;
            }

            if (data.toaster.options) {
                toaster.options = data.toaster.options;
            } else {
                toaster.options = {
                    closeButton: true, newestOnTop: true, progressBar: true, onclick: null
                };
            }

            if (data.toaster.script) {
                eval(data.toaster.script);
            } else {
                toaster.error(data.body.message, data.body.title)
            }

            return false;
        }

        modalPage.show();

        if (data.modal.size) {
            $('#modal-dialog').removeAttr('class').attr('class', 'modal-dialog').addClass(data.modal.size);
        }


        if (data.modal.centered) {
            $('#modal-dialog').addClass('modal-dialog-centered');
        }

        if (data.body.title) {
            $('.modal-header').removeClass('d-none');
            $('#modal-page-title').html("").html(data.body.title);
        } else {
            $('.modal-header').addClass('d-none');
        }
        $('#modal-page-body').html(data.body.view);

        if (data.body.script) {
            eval(data.body.script);
        }

        if ($(btn).data('loader') == 'enable') {
            $(btn).find('span.spinner-border').remove();
        }
    }).fail(function (data) {
        toaster.error(data.responseJSON.body.message, data.responseJSON.body.name);

        if ($(btn).data('loader') == 'enable') {
            $(btn).find('span.spinner-border').remove();
        }
    });
}

$(document).ready(function () {
    $('body').on('click', 'a.in-modal', function (e) {
        e.preventDefault();

        openModalPage($(this).attr('href'), $(this));
    });

    $('#modal-page').on('hidden.bs.modal', function () {
        $('#modal-dialog').removeAttr('class').attr('class', 'modal-dialog');
        $('#modal-page-title').html("Loading...");
        $('#modal-page-body').html(`<div class="text-center"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="visually-hidden">Loading...</span></div></div>`);
    });
});