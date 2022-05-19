$(document).ready(function () {
    var url = baseurl + "countlaboratorio";

    $.ajax({
        url: url,
        method: "GET",
        success: function (data) {
            data = JSON.parse(data);
            numer = parseInt(data.numero.numero) + 1;
            $("#id").val(numer);
        },
        error: function () {
            $("body").overhang({
              type: "error",
              message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
            }); 
          }
    })
});

var table_lab = $("#table-laboratorio").DataTable({
    "lengthMenu": [10, 50, 100, 200],
    "language": {
        "processing": "Procesando",
        "search": "Buscar:",
        "lengthMenu": "Ver _MENU_ Laboratorio",
        "info": "Mirando _START_ a _END_ de _TOTAL_ Laboratorio",
        "zeroRecords": "No encontraron resultados",
        "paginate": {
            "first": "Primera",
            "last": "Ultima",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }
});

$("#dni").on("blur", function() {
    var url1 = baseurl + "buscarpaciente",
        dni = $("#dni").val();

    $.ajax({
        url: url1,
        method: "POST",
        data: { dni: dni },
        success: function(data) {
            if (data === "error") {
                $(".messageError").html('<div class="alert alert-danger" role="alert">El paciente no se encuentra registrado en la base de datos</div>');
            } else {
                data = JSON.parse(data);
                console.log(data);
                $("#nombre").val(data.apellido + " " + data.nombre);
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

var table_lab_mini = $("#table-laboratorio-items").DataTable({
    "lengthMenu": [5, 50, 100, 200],
    "language": {
        "processing": "Procesando",
        "search": "Buscar:",
        "lengthMenu": "Ver _MENU_ Laboratorio",
        "info": "Mirando _START_ a _END_ de _TOTAL_ Laboratorio",
        "zeroRecords": "No encontraron resultados",
        "paginate": {
            "first": "Primera",
            "last": "Ultima",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }
});

function sumar() {
    var obj = $("input[name='laboratorio[]']");
    totalchecks = obj.length;
    totalsumado = 0;

    for (i = 0; i < totalchecks; i++) {
        if (obj[i].checked == true) {
            valor = obj[i].value.split('-');
            totalsumado = totalsumado + parseInt(valor[0], 10);
        }
    }
    $("#total").val(totalsumado);

}

$("#ticket-laboratorio").on("click", function (){
     var id = $("#id").val(),
     url = baseurl  + "administracion/recibolaboratorio/" + id;
     window.open(url, "_blank", " width=500, height=400");
     location.reload();
})

