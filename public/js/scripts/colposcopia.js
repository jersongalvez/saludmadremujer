$("#table-colposcopia").DataTable({
    "lengthMenu": [10, 50, 100, 200],
    "language":{
      "processing": "Procesando",
      "search": "Buscar:",
      "lengthMenu": "Ver _MENU_ colposcopias",
      "info": "Mirando _START_ a _END_ de _TOTAL_colposcopias",
      "zeroRecords": "No encontraron resultados",
      "paginate": {
        "first":      "Primera",
        "last":       "Ultima",
        "next":       "Siguiente",
        "previous":   "Anterior"
      }
    }
   });

$("#dni").on("blur", function () {
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
               $("#nombre").val(data.apellido +" "+data.nombre);
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
