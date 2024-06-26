function showConfirmMessage(
    titulo,
    texto,
    tipo,
    texto_btn,
    titulo2,
    texto2,
    url_eliminar = "",
    token,
    url_lista
) {
    console.log(url_lista);
    swal(
        {
            title: titulo,
            text: texto,
            type: tipo,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: texto_btn,
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
        },
        function () {
            $.ajax({
                url: url_eliminar,
                headers: { "X-CSRF-TOKEN": token },
                type: "DELETE",
                dataType: "JSON",
            })
                .done(function (data) {
                    if (data.msg != "NO") {
                        if (data.msg == "error") {
                            swal(
                                "Error interno",
                                "Ocurrió un error en el sistema. Por favor intente mas tarde",
                                "error"
                            ); //Success es el tipo de icono que aparece en el modal
                        } else {
                            swal(titulo2, texto2, "success"); //Success es el tipo de icono que aparece en el modal
                            console.log(data.msg);
                            listar(url_lista); //actualizar registros
                        }
                    } else if (data.msg == "NO") {
                        swal(
                            "No se puede eliminar el registro.",
                            "El registro esta siendo utilizado y no se puede eliminar.",
                            "info"
                        ); //Success es el tipo de icono que aparece en el modal
                    }
                    // console.log("success");
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
        }
    );
}

function listar(url) {
    var contenedor = $("#datos_lista");
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        data: { param1: "value1" },
    })
        .done(function (data) {
            contenedor.html(data);
            console.log("success");
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });
}
