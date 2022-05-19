$("#table-citas").DataTable({
    "lengthMenu": [10, 50, 100, 200],
    "language":{
      "processing": "Procesando",
      "search": "Buscar:",
      "lengthMenu": "Ver _MENU_ Citas",
      "info": "Mirando _START_ a _END_ de _TOTAL_ Citas",
      "zeroRecords": "No encontraron resultados",
      "paginate": {
        "first":      "Primera",
        "last":       "Ultima",
        "next":       "Siguiente",
        "previous":   "Anterior"
      }
    }
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
            $(".messageError").html('<div class="alert alert-danger" role="alert">El usuario no se encuentra registrado en la base de datos</div>');
        }
        else {
           data = JSON.parse(data);
           $("#nombre").val(data.apellido + " " + data.nombre);
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

$("#medico").on("change", function (){
    var url2 = baseurl + "administracion/traerhorarios",
        medico = $("#medico").val();
        
        $.ajax({
            url: url2,
            method: "POST",
            data: { medico: medico },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
            },
            error: function () {
              $("body").overhang({
                type: "error",
                message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
              }); 
            }
        });
});

$("#crearcita").on("click", function () {
    var url1 = baseurl + "administracion/crearcita",
        dni = $("#dni").val(),
        nombre = $("#nombre").val(),
        medico = $("#medico").val(),
        fecha = $("#fecha").val(),
        hora = $("#hora").val(),
        estado = $("#estado").val(),
        observaciones = $("#observaciones").val();

        $.ajax({
          url: url1,
          method: "POST",
          data: { 
              dni: dni,
              nombre: nombre,
              medico: medico,
              fecha: fecha,
              hora: hora,
              estado: estado,
              observaciones: observaciones
            },
          success: function () {
            $("body").overhang({
              type: "success",
              message: "Cita registrada correctamente"
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

function editarCita(id) {
  var url3 = baseurl + "administracion/getcitasid";
  $.ajax({
    url: url3,
    method: "POST",
    data: {
      id:id
    },
    success: function(data) {
      $("#modaleditarcita").modal("show");
      data = JSON.parse(data);
       $("#id2").val(data.codigo_cita);
       $("#dni2").val(data.documento);
       $("#nombre2").val(data.apellido + " "+ data.nombre);
       $("#medico2").val(data.doctor).prop("selected", true);
       $("#fecha2").val(data.fecha);
       $("#hora2").val(data.hora).prop("selected", true);
       $("#estado2").val(data.estado).prop("selected", true);
       $("#observaciones2").val(data.comentarios);
    },
    error: function () {
      $("body").overhang({
        type: "error",
        message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
      }); 
    }
  })
}
 $("#editarcitas").on("click", function () {
    var url4 = baseurl + "administracion/editarcita",
        id = $("#id2").val(),
        medico = $("#medico2").val(),
        fecha = $("#fecha2").val(),
        hora = $("#hora2").val(),
        estado = $("#estado2").val(),
        observaciones = $("#observaciones2").val();

        $.ajax({
          url: url4,
          method: "POST",
          data: {
            id: id,
            medico: medico,
            fecha: fecha,
            hora: hora,
            estado: estado,
            observaciones: observaciones
          },
          success: function () {
            $("body").overhang({
              type: "success",
              message: "Cita actualizada correctamente"
          });
          setTimeout(reloadPage, 3000);
          },
          error: function () {
            $("body").overhang({
              type: "error",
              message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
            }); 
          }
        })
 });

 const reloadPage = () => {
   location.reload();
 }
