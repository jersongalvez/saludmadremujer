$(document).ready(function() {

      $("#table-atencion").DataTable({
        "lengthMenu": [10, 50, 100, 200],
        "language":{
          "processing": "Procesando",
          "search": "Buscar:",
          "lengthMenu": "Ver _MENU_ Recepcion",
          "info": "Mirando _START_ a _END_ de _TOTAL_ Recepcion",
          "zeroRecords": "No encontraron resultados",
          "paginate": {
            "first":      "Primera",
            "last":       "Ultima",
            "next":       "Siguiente",
            "previous":   "Anterior"
          }
        }
       });
    
       $("#factura").on("click", function (e) {
           e.preventDefault();
            $("#crear-configuracion").modal("show");
       });

    $("#dni").on("blur", function(){
        var url1 = baseurl + "buscarpaciente",
            dni = $("#dni").val();

       $.ajax({
        url: url1,
        method: "POST",
        data: { dni: dni },
        success: function(data) {
            if(data === "error"){
                $(".messageError").html('<div class="alert alert-danger" role="alert">El paciente no se encuentra registrado en la base de datos</div>');
            }
            else {
               data = JSON.parse(data);
               console.log(data);
               $("#nombre").val(data.apellido +" "+ data.nombre);
               $("#hc").val(data.hc);
               $(".messageError").prop("hidden", true);
            }
        },
        error: function () {
            $("body").overhang({
              type: "error",
              message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
            }); 
          }
       })
    });

    $("#especialidad").on("blur", function () {
        var url2 = baseurl + "buscarespecialidad",
            especialidad = $("#especialidad").val();

        $.ajax({
          url: url2,
          method: "POST",
          data: { especialidad: especialidad },
          success: function (data) {
              data = JSON.parse(data);
             console.log(data);
              $("#costo").val(data.costo);
              $("#comision").val(data.comision_aproximada);
              $("#factura").prop("hidden", false);
          },
          error: function () {
            $("body").overhang({
              type: "error",
              message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
            }); 
          }
        });
    });

    $("#crear-atencion").on("click", function() {
        var url3 = baseurl + "registraratencion",
            dni = $("#dni").val(),
            nombre = $("#nombre").val(),
            especialidad = $("#especialidad").val(),
            doctor = $("#doctor").val(),
            costo = $("#costo").val(),
            comision = $("#comision").val(),
            turno = $("#turno").val(),
            descuento = $("#descuento").val(),
            cantidad_recibida = $("#cantidadr").val(),
            cantidad_devolver = $("#cantidadv").val(),
            forma_pago = $("input[name=tipopago]:checked").val(),
            total = $("#total").val();            
            $.ajax({
                url : url3,
                method: "POST",
                data: { 
                    dni: dni,
                    nombre: nombre,
                    especialidad: especialidad,
                    doctor:doctor,
                    costo:costo,
                    comision:comision,
                    turno: turno,
                    descuento: descuento,
                    cantidad_recibida: cantidad_recibida,
                    cantidad_devolver: cantidad_devolver,
                    forma_pago: forma_pago,
                    total: total
                },
                success: function () {
                    $("#modalatencion").modal("hide");
                    $("body").overhang({
                        type: "success",
                        message: "Atencion creada correctamente"
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
    });

    url4 = baseurl + "contarconsecutivoturnos";
      $.ajax({
         url:url4,
         method: "GET",
         success: function (data) {
            data = JSON.parse(data);
            suma = parseInt(data.numero.numero) + 1;
            $("#turno").val(suma);
         },
         error: function () {
            $("body").overhang({
              type: "error",
              message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
            }); 
          }
      });

     
    
    $("#comision").on("blur", function () {
        var costo = $("#costo").val(),
        descuento = $("#descuento").val(),
        total = (costo - descuento) ;
        $("#total").val(total);
        var costo = $("#costo").val(),
            cantidadr = $("#cantidadr").val(),
           //  descuento = $("#descuento").val();
            devolver = cantidadr - costo;
           $("#cantidadv").val(devolver);
     });

     const reloadPage = () => {
        location.reload();
    }

     
});


/*********************************** */
/*********************************** */

$('#'+baseurl + "administracion/reportegastos").keypress(function(e) {
  e.defaultPrevented;
  if (e.which == 13) {
      return false;
  }
});
$("#"+baseurl + "administracion/reportegastos").submit(function(event) {
  event.preventDefault();
  Suubtmit('#'+baseurl + "administracion/reportegastos");
});
/*********************************** */
/*********************************** */

$('#'+baseurl + "administracion/reportelaboratorio").keypress(function(e) {
  e.defaultPrevented;
  if (e.which == 13) {
      return false;
  }
});
$("#"+baseurl + "administracion/reportelaboratorio").submit(function(event) {
  event.preventDefault();
  Suubtmit('#'+baseurl + "administracion/reportelaboratorio");
});
/*********************************** */
/*********************************** */

$('#'+baseurl + "administracion/reportediario").keypress(function(e) {
  e.defaultPrevented;
  if (e.which == 13) {
      return false;
  }
});
$("#"+baseurl + "administracion/reportediario").submit(function(event) {
  event.preventDefault();
  Suubtmit('#'+baseurl + "administracion/reportediario");
});
/*********************************** */
/*********************************** */

function Suubtmit(_url__){
  $.ajax({
    url: _url__,
    method: "POST",
    data: [],
    success: function () { 
        $("body").overhang({
            type: "success",
            message: "Imprimiendo Reporte"
        });
        setTimeout(function() {
            window.open(_baseurl__, "_blank", " width=500, height=400");
            location.reload();
        }, 700);
    },
    error: function () {
       $("body").overhang({
         type: "error",
        message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
      }); 
    }
  })
}