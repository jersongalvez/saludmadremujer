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

    $("#especialidad").change( function () {
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
              Cal_Total();
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
    
    $("#costo").keyup(function() {Cal_Total();});
    $("#descuento").keyup(function() {Cal_Total();});
    $("#comision").keyup(function() {Cal_Total();});
    $("#cantidadv").keyup(function() {Cal_Total();});
    $("#cantidadr").keyup(function() {Cal_Total();});

    function Cal_Total(){
      if(!($("#descuento").val()*1>($("#costo").val()-$("#comision").val()))){
        $("#cantidadv").val($("#cantidadr").val()-$("#costo").val());
        $("#total").val($("#costo").val()-$("#descuento").val());
      }else{
        $("body").overhang({
          type: "error",
          message: "El descuento excede lo permitido.",
        }); 
      }
    }

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
            cola_atencion = $("input[name=atencion_espera]:checked").val(),
            total = $("#total").val();
            //VALIDACION 
            if (dni === "") {
              $("#dni").addClass("is-invalid");
            }
            else if (nombre === "") {
              $("#nombre").addClass("is-invalid");
            }
            else if (especialidad === "") {
              $("#especialidad").addClass("is-invalid");
            }
            else if (doctor === "") {
              $("#doctor").addClass("is-invalid");
            }
            else if (costo === "") {
              $("#costo").addClass("is-invalid");
            }
            else if (comision === "") {
              $("#comision").addClass("is-invalid");
            }
            else if (turno === "") {
              $("#turno").addClass("is-invalid");
            }
            else if (forma_pago === "") {
              $("#forma_pago").addClass("is-invalid");
            }
            else if (cola_atencion === "") {
              $("#forma_pago").addClass("is-invalid");
            }
            else if (total === "") {
              $("#total").addClass("is-invalid");
            } else {
              
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
                    cola_atencion: cola_atencion,
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
            }      
    });

     const reloadPage = () => {
        location.reload();
    }

     
});

