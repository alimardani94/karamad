//init mdb
new WOW().init();

$(document).ready(function () {
    $(document).on('ajaxStart', function () {
        $('button').attr("disabled", true);
    }).on('ajaxStop', function () {
        $('button').attr("disabled", false);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    toastr.options = {
        "positionClass": "toast-top-left",
    }

    let successSession = $("meta[name=success]").attr("content");
    if (successSession !== undefined && successSession !== '') {
        toastr.success(successSession)
    }

    let errorSession = $("meta[name=error]").attr("content");
    if (errorSession !== undefined && errorSession !== '') {
        toastr.error(errorSession)
    }

    let validationErrors = JSON.parse($("meta[name=errors]").attr("content"));
    validationErrors.forEach(function (error) {
        toastr.error(error)
    })

    let messageSession = $("meta[name=message]").attr("content");
    if (messageSession !== undefined && messageSession !== '') {
        toastr.info(messageSession)
    }
});

