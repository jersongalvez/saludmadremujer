$("#table-precios").DataTable({
    "lengthMenu": [10, 50, 100, 200],
    "language":{
      "processing": "Procesando",
      "search": "Buscar:",
      "lengthMenu": "Ver _MENU_  precios",
      "info": "Mirando _START_ a _END_ de _TOTAL_ precios",
      "zeroRecords": "No encontraron resultados",
      "paginate": {
        "first":      "Primera",
        "last":       "Ultima",
        "next":       "Siguiente",
        "previous":   "Anterior"
      }
    }
   });

$("#crearPrecio").on("click", function () {
    var url1 = baseurl + "administracion/crearprecio";
        especialidad = $("#especialidad").val(),
        precio = $("#precio").val(),
        comision = $("#comision").val();
        //VALIDACION
        if (especialidad === "") {
            $("#especialidad").addClass("is-invalid");
          }
        else if (precio === "") {
            $("#precio").addClass("is-invalid");
          }
        else if (comision === "") {
            $("#comision").addClass("is-invalid");

        } else {
    $.ajax({
        url: url1,
        method: "POST",
        data: { especialidad: especialidad, precio: precio, comision: comision },
        success: function () {
            $("body").overhang({
                type: "success",
                message: "Especialidad creada correctamente"
            });
            setTimeout(reloadPage, 3000);
        },
        error: function () {
            $("body").overhang({
              type: "error",
              message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
            }); 
          }
    });
    }
});


function getPreciosId(id) {
    var url2 = baseurl + "administracion/verprecioid",
        id2 = $("#id1"),
        especialidad = $("#especialidad1"),
        precio = $("#precio1"),
        comision = $("#comision1"),
        estado = $("#estado1");
        $.ajax({
            url: url2,
            method: "POST",
            data: { id: id },
            success: function (data) {
                data = JSON.parse(data);
                $("#actualizarPrecio").modal("show");
                id2.val(data.codigo_especialidad);
                especialidad.val(data.descripcion);
                precio.val(data.costo);
                comision.val(data.comision_aproximada);
                estado.val(data.estado).prop("selected", true);
            },
            error: function () {
                $("body").overhang({
                  type: "error",
                  message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
                }); 
              }
        });
}

$("#actualizarPrecio2").on("click", function (){
    var url3 = baseurl + "administracion/actualizarprecios",
        id2 = $("#id1").val(),
        especialidad = $("#especialidad1").val(),
        precio = $("#precio1").val(),
        comision = $("#comision1").val(),
        estado = $("#estado1").val();

        $.ajax({
            url: url3,
            method: "POST",
            data: {
                id: id2,
                especialidad: especialidad,
                precio: precio,
                comision: comision,
                estado: estado
            },
            success: function() {
                $("body").overhang({
                    type: "success",
                    message: "Especialidad cambiada correctamente"
                });
                setTimeout(reloadPage, 3000);
            },
            error: function () {
                $("body").overhang({
                  type: "error",
                  message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
                }); 
              }
        });
})

$("#agregarPrecioLaboratorio").on("click", function () {
    let url = baseurl + "administracion/crearlaboratorio",
        servicio = $("#servicio").val(),
        precio = $("#precios").val();

        $.ajax({
            url: url,
            method: "POST",
            data: {
                servicio: servicio,
                precio: precio,
            },
            success: function () {
                $("body").overhang({
                    type: "success",
                    message: "Precio laboratorio creado correctamente"
                });
                setTimeout(reloadPage, 3000); 
            },
            error: function () {
                $("body").overhang({
                  type: "error",
                  message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
                }); 
              }
        });
})

const getdataModalLaboratorio = (id)  => {
    let url = baseurl + "administracion/getdatapreciolaboratorio/" + id;
    $.ajax({
        url: url,
        method: "GET",
        success: function (data){
            data = JSON.parse(data);
            console.log(data);
            $("#id2").val(data.codigo);
            $("#especialidad2").val(data.nombre);
            $("#precio2").val(data.precio);
            $("#estado2").val(data.estado).attr("selected", true);
            $("#precioLaboratorioagregar").modal("show");
           
        }
    });
}

$("#actualizarPrecioLaboratorio").on("click", function () {
    var url1 = baseurl + "administracion/actualizarprecio",
    id1 = $("#id2").val(),
    especialidad2 =  $("#especialidad2").val(),
    precio2 =  $("#precio2").val(),
    estado2 =  $("#estado2").val();

    $.ajax({
        url: url1,
        method: "POST",
        data: {
            id: id1,
            especialidad: especialidad2,
            precio: precio2,
            estado: estado2
        },
        success: function () {
            $("body").overhang({
                type: "success",
                message: "Precio laboratorio actualzado correctamente"
            });
            setTimeout(reloadPage, 3000);
        }
    });
})
    
const reloadPage = () => {
    location.reload();
  }
