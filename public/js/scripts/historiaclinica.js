
    var table_lab =  $("#table-diagnosticos").DataTable({
        "lengthMenu": [5,10, 50, 100, 200],
        "language":{
          "processing": "Procesando",
          "search": "Buscar:",
          "lengthMenu": "Ver _MENU_  Diagnosticos",
          "info": "Mirando _START_ a _END_ de _TOTAL_ Diagnosticos",
          "zeroRecords": "No encontraron resultados",
          "paginate": {
            "first":      "Primera",
            "last":       "Ultima",
            "next":       "Siguiente",
            "previous":   "Anterior"
          }
        }
       });

       
      
     var table_general =   $("#table-diagnosticos2").DataTable({
        "lengthMenu": [5,10, 50, 100, 200],
        "language":{
          "processing": "Procesando",
          "search": "Buscar:",
          "lengthMenu": "Ver _MENU_  Diagnosticos",
          "info": "Mirando _START_ a _END_ de _TOTAL_ Diagnosticos",
          "zeroRecords": "No encontraron resultados",
          "paginate": {
            "first":      "Primera",
            "last":       "Ultima",
            "next":       "Siguiente",
            "previous":   "Anterior"
          }
        }
       });

var table_lab_mini = $("#items-ginecologia-table").DataTable({
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

var table_lab_mini2 = $("#items-general-table").DataTable({
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

$("#crear_receta").on("click", function () {
    var url3 = baseurl + "administracion/crearreceta",
        paciente = $("#paciente").val(),
        fecha = $("#fecha").val(),
        medicina = $("#medicina").val(),
        receta = $("#receta").val();

        $.ajax({
            url: url3,
            method: "POST",
            data: { paciente: paciente, fecha: fecha, medicina: medicina, receta: receta },
            success: function () {
              $("body").overhang({
                type: "success",
                message: "Historia se ha registrado correctamente"
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
var elemntos_ginecologia = new Array();
$('#table-diagnosticos').on('dblclick', 'tr', function(e) {
    elem_lab = new Array();
    elem_lab = table_lab.row(this).data();
    elemntos_ginecologia.push(elem_lab);
    table_lab.row(this).remove()
    table_lab_mini.row.add(elem_lab).draw(false);

    total_ = 0;
    for (let i = 0; i < elemntos_ginecologia.length; i++) {
        total_ += elemntos_ginecologia[i][2] * 1;
    }
    $("#total").val((total_).toFixed(2));
    table_lab.draw(false);
});

$('#items-ginecologia-table').on('dblclick', 'tr', function(e) {
    elem_lab = new Array();
    elem_lab = table_lab_mini.row(this).data();
    table_lab_mini.row(this).remove()
    table_lab.row.add(elem_lab).draw(false);

    for (let i = 0; i < elemntos_ginecologia.length; i++) {
        if (elemntos_ginecologia[i][0] == elem_lab[0]) {
            elemntos_ginecologia.splice(i, 1);
            i = elemntos_ginecologia.length;
        }
    }
    total_ = 0;
    for (let i = 0; i < elemntos_ginecologia.length; i++) {
        total_ += elemntos_ginecologia[i][2] * 1;
    }
    $("#total").val((total_).toFixed(2));
    table_lab_mini.draw(false);
});
$("#guardarhistoriaginecologia").on("click", function(){

    var url1 = baseurl + "administracion/crearhistoriaginecologia",
        dni = $("#dni1").val(),
        doctorid = $("#doctorid1").val(),
        triaje = $("#triajeid1").val(),
        familiares = $("#familiares1").val(),
        patologicos = $("#patologicos1").val(),
        gine_obste = $("#gine_obste1").val(),
        fum = $("#fum1").val(),
        rm = $("#rm1").val(),
        flujo_genital = $("#flujo_genital1").val(),
        parejas = $("#parejas1").val(),
        gestas = $("#gestas1").val(),
        partos = $("#partos1").val(),
        abortos = $("#abortos1").val(),
        anticonceptivos = $("#anticonceptivos1").val(),
        tipo = $("#tipo1").val(),
        tiempo = $("#tiempo1").val(),
        cirugia_ginecologica = $("#cirugia_ginecologica1").val(),
        otros = $("#otros1").val(),
        pap = $("#pap1").val(),
        hijos = $("#hijos1").val(),
        motivo_consulta = $("#motivo_consulta1").val(),
        signos_sintomas = $("#signos_sintomas1").val(),
        piel_tscs = $("#piel_tscs1").val(),
        tiroides = $("#tiroides1").val(),
        mamas = $("#mamas1").val(),
        a_respiratorio = $("#a_respiratorio1").val(),
        a_cardiovascular = $("#a_cardiovascular1").val(),
        abdomen = $("#abdomen1").val(),
        genito = $("#genito1").val(),
        tacto = $("#tacto1").val(),
        locomotor = $("#locomotor1").val(),
        sistema_nervioso = $("#sistema_nervioso1").val(),
        exa_auxiliares = $("#exa_auxiliares1").val(),
        plan_trabajo = $("#plan_trabajo1").val(),
        proxima_cita = $("#proxima_cita1").val(),
        firma_medico = $("#firma_medico1").val();
        let diagnosticosginecologia = [];

        for (let i = 0; i < elemntos_ginecologia.length; i++) {
            diagnosticosginecologia [i] = elemntos_ginecologia[i][0];
        }
        
        $.ajax({
            url : url1,
            method: "POST",
            data: {
                dni: dni,
                doctorid: doctorid,
                triaje: triaje,
                familiares: familiares,
                patologicos: patologicos,
                gine_obste: gine_obste,
                fum: fum,
                rm: rm,
                flujo_genital: flujo_genital,
                parejas: parejas,
                gestas: gestas,
                partos: partos,
                abortos: abortos,
                anticonceptivos: anticonceptivos,
                tipo: tipo,
                tiempo: tiempo,
                cirugia_ginecologica: cirugia_ginecologica,
                otros: otros,
                pap: pap,
                hijos: hijos,
                motivo_consulta: motivo_consulta,
                signos_sintomas: signos_sintomas,
                piel_tscs: piel_tscs,
                tiroides: tiroides,
                mamas: mamas,
                a_respiratorio: a_respiratorio,
                a_cardiovascular: a_cardiovascular,
                abdomen: abdomen,
                genito: genito,
                tacto: tacto,
                locomotor: locomotor,
                sistema_nervioso: sistema_nervioso,
                exa_auxiliares: exa_auxiliares,
                diagnosticosginecologia: diagnosticosginecologia,
                plan_trabajo: plan_trabajo,
                proxima_cita: proxima_cita,
                firma_medico: firma_medico
             },
             success: function () {
                $("body").overhang({
                    type: "success",
                    message: "Historia se ha registrado correctamente"
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

var elementos_general = new Array();
$('#table-diagnosticos2').on('dblclick', 'tr', function(e) {
    elem_lab = new Array();
    elem_lab = table_general.row(this).data();
    elementos_general.push(elem_lab);
    table_general.row(this).remove()
    table_lab_mini2.row.add(elem_lab).draw(false);

    total_ = 0;
    for (let i = 0; i < elementos_general.length; i++) {
        total_ += elementos_general[i][2] * 1;
    }
    $("#total").val((total_).toFixed(2));
    table_general.draw(false);
});

$('#items-general-table').on('dblclick', 'tr', function(e) {
    elem_lab = new Array();
    elem_lab = table_lab_mini2.row(this).data();
    table_lab_mini2.row(this).remove()
    table_general.row.add(elem_lab).draw(false);

    for (let i = 0; i < elementos_general.length; i++) {
        if (elementos_general[i][0] == elem_lab[0]) {
            elementos_general.splice(i, 1);
            i = elementos_general.length;
        }
    }
    total_ = 0;
    for (let i = 0; i < elementos_general.length; i++) {
        total_ += elementos_general[i][2] * 1;
    }
    $("#total").val((total_).toFixed(2));
    table_lab_mini2.draw(false);
});

$("#guardarhistoriageneral").on("click", function (){
    var url2 = baseurl + "administracion/crearhistoriageneral",
    dni = $("#dni1").val(),
    doctorid = $("#doctorid1").val(),
    triaje = $("#triajeid1").val(),
    anamnesis = $("#anamnesis2").val(),
    empresa = $("#empresa2").val(),
    compania = $("#compania2").val(),
    iafa = $("#iafa2").val(),
    acompanante = $("#acompanante2").val(),
    dni3 = $("#dni3").val(),
    celular = $("#celular2").val(),
    motivo_consulta = $("#motivo_consulta2").val(),
    tratamiento_anterior = $("#tratamiento_anterior2").val(),
    enfermedad_actual = $("#enfermedad_actual2").val(),
    tp_enfermedad = $("#tp_enfermedad2").val(),
    inicio = $("#inicio2").val(),
    curso = $("#curso2").val(),
    sintomas = $("#sintomas2").val(),
    cabeza = $("#cabeza2").val(),
    cuello = $("#cuello2").val(),
    ap_respiratorio = $("#ap_respiratorio2").val(),
    ap_cardio = $("#ap_cardio2").val(),
    abdomen = $("#abdomen2").val(),
    ap_genito = $("#ap_genito2").val(),
    locomotor = $("#locomotor2").val(),
    sistema_nervioso = $("#sistema_nervioso2").val(),
    apetito = $("#apetito2").val(),
    sed = $("#sed2").val(),
    orina = $("#orina2").val(),
    examendx = $("#examendx2").val(),
    procedimientos = $("#procedimientos2").val(),
    interconsultas = $("#interconsultas2").val(),
    tratamiento = $("#tratamiento2").val(),
    referencia = $("#referencia2").val(),
    cita = $("#cita2").val(),
    firma = $("#firma2").val();
    let diagnosticosgeneral = [];
    for (let i = 0; i < elementos_general.length; i++) {
        diagnosticosgeneral [i] = elementos_general[i][0];
    }
    $.ajax({
        url: url2,
        method: "POST",
        data: {
            dni: dni,
            doctorid: doctorid,
            triaje: triaje,
            anamnesis: anamnesis,
            empresa: empresa,
            compania: compania,
            iafa: iafa,
            acompanante: acompanante,
            dni3: dni3,
            celular: celular,
            motivo_consulta: motivo_consulta,
            tratamiento_anterior: tratamiento_anterior,
            enfermedad_actual: enfermedad_actual,
            tp_enfermedad: tp_enfermedad,
            inicio: inicio,
            curso: curso,
            sintomas: sintomas,
            cabeza: cabeza,
            cuello: cuello,
            ap_respiratorio: ap_respiratorio,
            ap_cardio: ap_cardio,
            abdomen: abdomen,
            ap_genito: ap_genito,
            locomotor: locomotor,
            sistema_nervioso: sistema_nervioso,
            apetito: apetito,
            sed: sed,
            orina: orina,
            diagnosticosgeneral: diagnosticosgeneral,
            examendx: examendx,
            procedimientos: procedimientos,
            interconsultas: interconsultas,
            tratamiento: tratamiento,
            referencia: referencia,
            cita: cita,
            firma: firma
        },
        success: function () {
            $("body").overhang({
                type: "success",
                message: "Historia se ha registrado correctamente"
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

$("#ecografias").on("change", function() {
    if($("#ecografias").val() == "mama") {
        $("#ecografiamama").modal("show");
    }
    else if ($("#ecografias").val() == "transvaginal") {
        $("#ecografiatransvaginal").modal("show");
    }
    else if ($("#ecografias").val() == "pelvica") {
        $("#ecografiapelvica").modal("show");
    }
    else if ($("#ecografias").val() == "morfologica") {
        $("#ecografiamorfologica").modal("show");
    }
    else if ($("#ecografias").val() == "genetica") {
        $("#ecografiagenetica").modal("show");
    }
    else if ($("#ecografias").val() == "obstetrica") {
        $("#ecografiaobstetrica").modal("show");
    }
    
})

const reloadPage = () => {
    location.reload();
  }
