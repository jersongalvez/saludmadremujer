var elementos_lab = new Array();
$('#table-laboratorio').on('dblclick', 'tr', function(e) {
    elem_lab = new Array();
    elem_lab = table_lab.row(this).data();
    elementos_lab.push(elem_lab);
    table_lab.row(this).remove()
    table_lab_mini.row.add(elem_lab).draw(false);

    total_ = 0;
    for (let i = 0; i < elementos_lab.length; i++) {
        total_ += elementos_lab[i][2] * 1;
    }
    $("#total").val((total_).toFixed(2));
    table_lab.draw(false);
});

$('#table-laboratorio-items').on('dblclick', 'tr', function(e) {
    elem_lab = new Array();
    elem_lab = table_lab_mini.row(this).data();
    table_lab_mini.row(this).remove()
    table_lab.row.add(elem_lab).draw(false);

    for (let i = 0; i < elementos_lab.length; i++) {
        if (elementos_lab[i][0] == elem_lab[0]) {
            elementos_lab.splice(i, 1);
            i = elementos_lab.length;
        }
    }
    total_ = 0;
    for (let i = 0; i < elementos_lab.length; i++) {
        total_ += elementos_lab[i][2] * 1;
    }
    $("#total").val((total_).toFixed(2));
    table_lab_mini.draw(false);
});

$('#Form_Lab').keypress(function(e) {
    e.defaultPrevented;
    if (e.which == 13) {
        return false;
    }
});
$("#Form_Lab").submit(function(event) {
    event.preventDefault();
    Suubtmit();
});
function Suubtmit(){
    var url = baseurl + "administracion/serviciolaboratorio",
    dni = $("#dni").val(),
    doctor = $("#doctor").val(),
    observacion = $("#observacion").val(),
    fecha = $("#fecha").val(),
    total = $("#total").val();
    let laboratorio = [];

    for (let i = 0; i < elementos_lab.length; i++) {
        laboratorio [i] = elementos_lab[i][0];
    }
    if(laboratorio.length>0){
        $.ajax({
            url: url,
            method: "POST",
            data: {
               laboratorio: laboratorio,
               dni: dni,
               doctor: doctor,
               observacion: observacion,
               fecha: fecha,
               total: total
            },
            success: function (data) {
                id_ultimo_laboratorio = JSON.parse(data);
                //$("#id").val(id_ultimo_laboratorio)
                $("body").overhang({
                    type: "success",
                    message: "Registrado Correctamente"
                });
                setTimeout(function() {
                    url = baseurl  + "administracion/recibolaboratorio/" + id_ultimo_laboratorio;
                    window.open(url, "_blank", " width=500, height=400");
                    location.reload();
                }, 700);
                //$("#ticket-laboratorio").attr("hidden", false);
            },
            error: function () {
               $("body").overhang({
                 type: "error",
                message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
              }); 
            }
        })
    }else{
        $("body").overhang({
            type: "warning",
            message: "Agregar almenos un analisis."
        });
    }
}

$("#crear-laboratorio").on("click", function () {

})
