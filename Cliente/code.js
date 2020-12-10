$(document).ready(function() {
    $(".modal").hide();
    // $("#modalclienteModificar").hide();
    // $("#modalcliente").hide();

    var nombres = GETUsuarios();
    GETPedidos();
    $("#addCliente").click(function() {
        $("#dniinput").val("")
        $("#nombreinput").val("")
        $("#direcinput").val("")
        $("#emailinput").val("")
        $("#modalcliente").show();
    })

    $("#addpedido").click(function() {
        nombres.forEach(element => {
            $("#tablapedidomodal tbody tr td select").append("<option id='" + element.dniCliente + "'>" + element.nombre + "</option>")
        })
        $("#modalpedido").show();
    })



});

function CancelarModal() {
    $(".modal").hide();
}

function ventanas(evento, tabla) {
    var i, tabcontent, tablinks;

    // tabcontent = document.getElementsByClassName("tabcontent");
    contenido = $(".tabcontent")
    for (i = 0; i < contenido.length; i++) {
        contenido[i].style.display = "none";
    }

    //tablinks = document.getElementsByClassName("tablinks");
    links = $(".tablinks")
    for (i = 0; i < links.length; i++) {
        links[i].className = links[i].className.replace(" active", "");
    }

    document.getElementById(tabla).style.display = "block";
    evento.currentTarget.className += " active";
}

function AddUsuario() {

    comp = true;
    $("#tablaClientes tbody tr").find('td:eq(0)').each(function() {
        if ($(this).html() == $("#dniinput").val()) {
            comp = false;
        }
    });


    if (comp) {
        var datos = {
            "dni": $("#dniinput").val(),
            "nombre": $("#nombreinput").val(),
            "direccion": $("#direcinput").val(),
            "email": $("#emailinput").val(),
        };

        if ($("#dniinput").val() == '') {
            alert("Introduce DNI")
        } else {
            $("#tablaClientes tbody").append("<tr id='" + datos['dni'] + "'><td>" + datos['dni'] + "</td><td>" + datos['nombre'] + "</td><td><button  id='" + datos['dni'] + "' onclick='EditarCliente(id)' style='margin-right:10px;width: 70px;height: 30px;background-color: #60f346;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Editar</button><button id='" + datos['dni'] + "'  onclick='BorrarFilaCliente(id)' style='width: 70px;height: 30px;background-color: #f84545;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Borrar</button></td></tr>")

            $.ajax({
                url: '../Servidor/Servicios/AddCliente.php',
                data: datos,
                type: 'POST',
                dataType: 'json',

                success: function(respuesta) {

                },

                error: function(xhr, status) {},
            });

            $(".modal").hide();
        }
    } else {
        alert("EL DNI INTRODUCIDO YA EXISTE")
    }
}

function AddPedido() {

    var datos = {
        "fecha": $("#tablapedidomodal tbody tr td #fecha").val(),
        "dni": $("#nombresclientes :selected").attr('id')
    };

    $.ajax({
        url: '../Servidor/Servicios/addPedido.php',
        data: datos,
        type: 'GET',
        dataType: 'json',
        success: function(respuesta) {
            $("#tablaPedidos tbody").append("<tr id='" + respuesta + "'><td>" + respuesta + "</td><td>" + datos['dni'] + "</td><td>" + datos['fecha'] + "</td><td><button id='" + respuesta + "' value='false' onclick='InfoPedido(id,value)' style='margin-right:10px;width: 70px;height: 30px;background-color: #92cff7;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Info</button><button id='" + respuesta + "' onclick='EditarPedido(id)' style='margin-right:10px;width: 70px;height: 30px;background-color: #60f346;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Editar</button><button onclick='BorrarFilaPedido(id)' id='" + respuesta + "' style='width: 70px;height: 30px;background-color: #f84545;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Borrar</button></td></tr>")

        },

        error: function(xhr, status) {

        },
    });
    $(".modal").hide();
}

function GETUsuarios() {
    var users = [];
    $.ajax({
        url: '../Servidor/Servicios/GETClientes.php',
        type: 'POST',
        dataType: 'json',

        success: function(respuesta) {
            respuesta.forEach(element => {
                $("#tablaClientes tbody").append("<tr id='" + element.dniCliente + "'><td>" + element.dniCliente + "</td><td id='" + element.dniCliente + "'>" + element.nombre + "</td><td><button onclick='EditarCliente(id)' id='" + element.dniCliente + "' style='margin-right:10px;width: 70px;height: 30px;background-color: #60f346;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Editar</button><button onclick='BorrarFilaCliente(id)' id='" + element.dniCliente + "' style='width: 70px;height: 30px;background-color: #f84545;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Borrar</button></td></tr>")
                users.push(element);
            });
        },

        error: function(xhr, status) {},
    });
    return users
}

function GETPedidos() {
    $.ajax({
        url: '../Servidor/Servicios/GETPedidos.php',
        type: 'POST',
        dataType: 'json',
        //poner value al boton info para poder mostrarlo y esconderlo
        success: function(respuesta) {
            respuesta.forEach(element => {
                $("#tablaPedidos tbody").append("<tr style='text-size:20px' id='" + element.idPedido + "'><td>" + element.idPedido + "</td><td>" + element.dniCliente + "</td><td>" + element.fecha + "</td><td><button id='" + element.idPedido + "' value='false' onclick='InfoPedido(id,value)' style='margin-right:10px;width: 70px;height: 30px;background-color: #92cff7;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Info</button><button id='" + element.idPedido + "' onclick='EditarPedido(id)' style='margin-right:10px;width: 70px;height: 30px;background-color: #60f346;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Editar</button><button onclick='BorrarFilaPedido(id)' id='" + element.idPedido + "' style='width: 70px;height: 30px;background-color: #f84545;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Borrar</button></td></tr>")
            });
        },

        error: function(xhr, status) {},
    });


}

function BorrarFilaCliente(id) {


    if (confirm("Estas seguro que desean borra este cliente")) {

        $.ajax({
            url: '../Servidor/Servicios/BorrarClientes.php',
            data: { 'dni': id },
            type: 'POST',
            dataType: 'text',

            success: function(respuesta) {},

            error: function(xhr, status) {},
        });
        $("#tablaClientes tbody #" + id).remove();
    }
}

function BorrarFilaPedido(id) {

    if (confirm("Estas seguro que desean borra este pedido")) {
        $.ajax({
            url: '../Servidor/Servicios/BorrarPedidos.php',
            data: { 'id': id },
            type: 'POST',
            dataType: 'text',

            success: function(respuesta) {},

            error: function(xhr, status) {},
        });
        $("#tablaPedidos tbody #" + id).remove();
    }
}

function EditarCliente(dni) {

    var id = "";
    var nombre = "";
    $.ajax({
        url: '../Servidor/Servicios/GETCliente.php',
        data: { 'dni': dni },
        type: 'POST',
        dataType: 'json',

        success: function(respuesta) {
            id = respuesta.dniCliente
            nombre = respuesta.nombre
            pwd = respuesta.pwd

            dni = $("#dniinputModificar").val(respuesta.dniCliente)
            $("#dniinputModificar").prop('disabled', true);
            nombre = $("#nombreinputModificar").val(respuesta.nombre)
            direccion = $("#direcinputModificar").val(respuesta.direccion)
            email = $("#emailinputModificar").val(respuesta.email)
            $("#modalclienteModificar").show()

            $("#GuardarCambiosCliente").click(function(respuesta) {

                params = {
                    'dni': $("#dniinputModificar").val(),
                    'nombre': $("#nombreinputModificar").val(),
                    'direccion': $("#direcinputModificar").val(),
                    'email': $("#emailinputModificar").val(),
                    'pwd': pwd,
                }

                $.ajax({
                    url: '../Servidor/Servicios/EditarCliente.php',
                    data: params,
                    type: 'POST',
                    dataType: 'json',

                    success: function(respuesta) {},

                    error: function(xhr, status) {},
                });

                $("#tablaClientes tbody #" + id).html("<td>" + id + "</td><td id='" + id + "'>" + params['nombre'] + "</td><td><button style='margin-right:10px;width: 70px;height: 30px;background-color: #60f346;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;' onclick='EditarCliente(id)' id='" + id + "'>Editar</button><button style='width: 70px;height: 30px;background-color: #f84545;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;' onclick='BorrarFilaCliente(id)' id='" + id + "'>Borrar</button></td>")
                $("#modalclienteModificar").hide();
            });



        },

        error: function(xhr, status) {},
    });

}

function EditarPedido(id) {
    var nombres = [];
    var ids = [];
    $("#tablaClientes tbody tr").find('td:eq(1)').each(function() {
        nombres.push($(this).html())
    });
    $("#tablaClientes tbody tr").find('td:eq(0)').each(function() {
        ids.push($(this).html())
    });
    nombres.splice(0, 1)
    ids.splice(0, 1)

    $.ajax({
        url: '../Servidor/Servicios/GETPedido.php',
        data: { 'id': id },
        type: 'POST',
        dataType: 'json',

        success: function(respuesta) {
            $("#fechaModificar").val(respuesta.fecha)
            var str;
            for (let i = 0; i < nombres.length; i++) {
                str += "<option id='" + ids[i] + "'>" + nombres[i] + "</option>";
                //$("#nombresclientesModificar").append("<option id='" + ids[i] + "'>" + nombres[i] + "</option>")
            }
            $("#nombresclientesModificar").html(str)
            $("#modalpedidoModificar").show()
            $("#GuardarCambiosPedido").click(function() {
                params = {
                    'id': id,
                    'fecha': $("#fechaModificar").val(),
                    'dniCliente': $("#nombresclientesModificar :selected").attr('id')
                }

                $.ajax({
                    url: '../Servidor/Servicios/EditarPedido.php',
                    data: params,
                    type: 'POST',
                    dataType: 'json',

                    success: function(respuesta) {

                    },

                    error: function(xhr, status) {

                    },
                });
                $("#tablaPedidos tbody #" + params['id']).html("<td>" + params['id'] + "</td><td>" + params['dniCliente'] + "</td><td>" + params['fecha'] + "</td><td><button id='" + params['id'] + "' value='false' onclick='InfoPedido(id,value)' style='margin-right:10px;width: 70px;height: 30px;background-color: #92cff7;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Info</button><button id='" + params['id'] + "' onclick='EditarPedido(id)' style='margin-right:10px;width: 70px;height: 30px;background-color: #60f346;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Editar</button><button onclick='BorrarFilaPedido(id)' id='" + params['id'] + "' style='width: 70px;height: 30px;background-color: #f84545;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Borrar</button></td>")
                $(".modal").hide();
            });

        },

        error: function(xhr, status) {},
    });

}

function InfoPedido(id, value) {
    var nombres = new Array()
    var prods = GETProductos()

    $.ajax({
        url: '../Servidor/Servicios/GETLineaPedido.php',
        data: { 'id': id },
        type: 'POST',
        dataType: 'json',

        success: function(respuesta) {
            if (value == 'true') {
                ultlinea = 0;
                respuesta.forEach(element => {
                    ultlinea = element.nlinea
                    $("#" + id + "-" + element.nlinea).remove()
                });
                $("#trinfo").remove();
                $("#tdinfo").remove();
                $("#tablaPedidos tbody #" + id + "-0").remove();
                $("#tablaPedidos tbody #" + id + "-1").remove();
                $("#tablaPedidos tbody #" + id + " button").attr('value', 'false')

            } else {

                ultlinea = 0;
                respuesta.forEach(element => { ultlinea = element.nlinea; });
                $("#tablaPedidos tbody #" + id + " button").attr('value', 'true')



                prods.forEach(e => {
                        nombres.push(e.nombre)
                    })
                    //console.log(prods[0]['nombre'])
                $("#tablaPedidos tbody tr#" + id).after("<tr id='trinfo'><td id='tdinfo' colspan=4 style='background-color:#92cff7;border-radius:5px;border-width:2px;border-color:#16a0fa;border-style:solid'><table id='tabla" + id + "'>")
                $("#tablaPedidos tbody tr#" + id).after("</table></td></tr>")
                $("#tabla" + id).append("<tr  id='" + id + "-1' style='border-bottom-width:2px;border-bottom-color:#16a0fa;border-bottom-style:solid'><td><i>Linea</i></td><td><i>Cantidad</i></td><td><i>Producto</i></td><td><i>Acciones</i></td></tr>");
                respuesta.forEach(element => {
                    $("#tabla" + id).append("<tr id='" + id + "-" + element.nlinea + "'><td>" + element.nlinea + "</td><td>" + element.cantidad + "</td><td>" + nombres[element.idProducto - 1] + "</td><td><button id='" + id + "' value='" + element.nlinea + "' style='width: 70px;height: 30px;background-color: #f84545;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;' onclick='BorrarLineaPedido(id,value)'>Eliminar</button></td></tr>");
                });
                $("#tabla" + id).append("<tr id='" + id + "-0'><td></td><td></td><td></td><td><button id='" + id + "' value='" + ultlinea + "' onclick='AddLineaPedido(id,value)' style='margin-right:10px;width: 70px;height: 30px;background-color: #60f346;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Anadir</button></td></tr>");

            }
        },

        error: function(xhr, status) {

            if (value == 'true') {
                $("#trinfo").remove();
                $("#tablaPedidos tbody tr#" + id + " button").attr('value', 'false')

            } else {
                $("#tablaPedidos tbody tr#" + id + " button").attr('value', 'true')
                $("#tablaPedidos tbody tr#" + id).after("<tr id='trinfo'><td id='tdinfo' colspan=4 style='background-color:#92cff7;border-radius:5px;border-width:2px;border-color:#16a0fa;border-style:solid'><table id='tabla" + id + "'>")
                $("#tablaPedidos tbody tr#" + id).after("</table></td></tr>")
                $("#tabla" + id).append("<tr id='" + id + "-0'><td></td><td></td><td></td><td><button id='" + id + "' value='" + 0 + "' onclick='AddLineaPedido(id,value)' style='margin-right:10px;width: 70px;height: 30px;background-color: #60f346;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Anadir</button></td></tr>");
            }
        },
    });

}

function AddLineaPedido(id, value) {
    $.ajax({
        url: '../Servidor/Servicios/GetProductos.php',
        type: 'POST',
        dataType: 'json',

        success: function(respuesta) {

            respuesta.forEach(element => {
                $("#ProductoLinea").append("<option id='" + id + "' value='" + value + "'>" + element.nombre + "</option>")
            });

        },

        error: function(xhr, status) {},
    });

    $("#modalLineapedido").show();

}

function CrearLineaPedido() {

    cantidad = $("#CantidadLinea").val()
    producto = $("#ProductoLinea :selected").text()
    idproducto = $("#ProductoLinea :selected").attr('id')
    idpedido = $("#ProductoLinea :selected").attr('id')
    ultimalinea = (parseInt($("#ProductoLinea :selected").attr('value')) + 1)
    $("#" + idpedido + "-0").before("<tr id='" + idpedido + "-" + ultimalinea + "'><td>" + ultimalinea + "</td><td>" + cantidad + "</td><td>" + producto + "</td><td><button id='" + idpedido + "' value='" + ultimalinea + "' onclick='BorrarLineaPedido(id,value)' style='width: 70px;height: 30px;background-color: #f84545;border: none;border-radius: 5px;text-align: center;font-weight: bold;color: white;'>Eliminar</button></td></tr>");



    params = {
        'id': idpedido,
        'idProducto': idproducto,
        'linea': ultimalinea,
        'cantidad': cantidad,
    }

    $.ajax({
        url: '../Servidor/Servicios/AddLineaPedido.php',
        data: params,
        type: 'POST',
        dataType: 'json',

        success: function(respuesta) {},

        error: function(xhr, status) {},
    });
    $(".modal").hide();

}

function BorrarLineaPedido(id, value) {

    if (confirm("Estas seguro que desean borra esta linea de pedido")) {

        $.ajax({
            url: '../Servidor/Servicios/BorrarLineaPedido.php',
            data: { 'id': id, 'linea': value },
            type: 'POST',
            dataType: 'json',

            success: function(respuesta) {},

            error: function(xhr, status) {},
        });
        $("#" + id + "-" + value).remove();

    }
}

function GETProductos() {
    var nom = []

    $.ajax({
        url: '../Servidor/Servicios/GetProductos.php',
        type: 'POST',
        dataType: 'json',

        success: function(respuesta) {

            respuesta.forEach(e => {
                nom.push(e)
            })
        },

        error: function(xhr, status) {},
    });
    console.log(nom)
    return nom
}