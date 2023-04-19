var offCanvasPage = new bootstrap.Offcanvas(document.getElementById('offcanvas-page'));

function openOffCanvasPage(url) {
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

        offCanvasPage.show();

        if (data.offcanvas.side) $('#offcanvas-page').addClass(data.offcanvas.side);

        if (data.body.title) {
            $('#offcanvas-page-title').html("").html(data.body.title);
        } else {
            $('.offcanvas-header').addClass('d-none');
        }
        $('#offcanvas-page-body').html(data.body.view);

        if (data.body.script) eval(data.body.script);
    })
        .fail(function (data) {
            toaster.error(data.responseJSON.body.message, data.responseJSON.body.name);
        });
}

$(document).ready(function () {
    $('body').on('click', 'a.in-offcanvas', function (e) {
        e.preventDefault();
        openOffCanvasPage($(this).attr('href'));
    });

    $('#offcanvas-page').on('hidden.bs.offcanvas', function () {
        $('#offcanvas-page').removeClass('offcanvas-start offcanvas-end offcanvas-top offcanvas-bottom');
        $('#offcanvas-page-title').html("Loading...");
        $('#offcanvas-page-body').html(`<div class="text-center"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="visually-hidden">Loading...</span></div></div>`);
    });
});