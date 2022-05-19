

    $("#table-doctores").DataTable({
        "lengthMenu": [10, 50, 100, 200],
        "language":{
          "processing": "Procesando",
          "search": "Buscar:",
          "lengthMenu": "Ver _MENU_  Atenciones",
          "info": "Mirando _START_ a _END_ de _TOTAL_ Atenciones",
          "zeroRecords": "No encontraron resultados",
          "paginate": {
            "first":      "Primera",
            "last":       "Ultima",
            "next":       "Siguiente",
            "previous":   "Anterior"
          }
        }
       });

    $("#crear-doctor").on("click", function () {
        var url1 = baseurl + "administracion/creardoctor",
            cpe = $("#cpe").val(),
            nombre = $("#nombre").val(),
            perfil = $("#perfil").val(),
            telefono  = $("#telefono").val(),
            direccion = $("#direccion").val(),
            correo = $("#correo").val(),
            password = $("#password").val();
    
            $.ajax({
                url: url1,
                method: "POST",
                data: { 
                    cpe: cpe,
                    nombre: nombre,
                    perfil: perfil,
                    telefono: telefono,
                    direccion: direccion,
                    correo: correo,
                    password: password
                 },
                success: function () {
                  $("body").overhang({
                    type: "success",
                    message: "Doctor registrado correctamente"
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

    function getModalDataDoctor(id) {
        url = baseurl + "administracion/buscardoctorid";
        $.ajax({
          url: url,
          method: "POST",
          data: { id: id },
          success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            $("#Doctorparametrizar").modal("show");
             $("#cpe1").val(data.cpe);
             $("#nombre1").val(data.nombre);
             $("#perfil1").val(data.perfil);
             $("#telefono1").val(data.telefono);
             $("#direccion1").val(data.direccion);
             $("#correo1").val(data.email);
             $("#password1").val(data.password);
             if(data.lunes == 1){
               $("#lunes").prop("checked", true);
             }
             else {
               $("#lunes").prop("checked", false);
             }
             if(data.martes == 1){
               $("#martes").prop("checked", true);
             }
             else {
               $("#martes").prop("checked", false);
             }
             if(data.miercoles == 1){
               $("#miercoles").prop("checked", true);
             }
             else {
               $("#miercoles").prop("checked", false);
             }
             if(data.jueves == 1){
               $("#jueves").prop("checked", true);
             }
             else {
               $("#jueves").prop("checked", false);
             }
             if(data.viernes == 1){
               $("#viernes").prop("checked", true);
             }
             else {
               $("#viernes").prop("checked", false);
             }
             if(data.sabado == 1){
               $("#sabado").prop("checked", true);
             }
             else {
               $("#sabado").prop("checked", false);
             }
             if(data.domingo == 1){
               $("#domingo").prop("checked", true);
             }
             else {
               $("#domingo").prop("checked", false);
             }
        },
        error: function () {
          $("body").overhang({
            type: "error",
            message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
          }); 
        }
      }); 
    }
$("#todas").on("change", function (){
    if($(this).is(":checked")){
        $("input:checkbox[name=dias]").prop("checked", true);
    }
    else {
        $("input:checkbox[name=dias]").prop("checked", false);
    }
});

$("#actualizardoctor").on("click", function () {
    var url3 = baseurl + "administracion/actualizardoctor",
        documento = $("#cpe1").val(),
        nombre = $("#nombre1").val(),
        perfil = $("#perfil1").val(),
        telefono = $("#telefono1").val(),
        direccion = $("#direccion1").val(),
        correo = $("#correo1").val(),
        desde = $("#desde1").val(),
        hasta = $("#hasta1").val();
    if($("#lunes").is(":checked")){
      lunes = 1;
    }
    else {
      lunes = 0
    }
    if($("#martes").is(":checked")){
      martes = 1;
    }
    else {
      martes = 0
    }
    if($("#miercoles").is(":checked")){
      miercoles = 1;
    }
    else {
      miercoles = 0
    }
    if($("#jueves").is(":checked")){
      jueves = 1;
    }
    else {
      jueves = 0
    }
    if($("#viernes").is(":checked")){
      viernes = 1;
    }
    else {
      viernes = 0
    }
    if($("#sabado").is(":checked")){
      sabado = 1;
    }
    else {
      sabado = 0
    }
    if($("#domingo").is(":checked")){
      domingo = 1;
    }
    else {
      domingo = 0
    }
   
    $.ajax({
      url: url3,
      method: "POST",
      data: {
        lunes: lunes,
        martes: martes,
        miercoles: miercoles,
        jueves: jueves,
        viernes: viernes,
        sabado: sabado,
        domingo: domingo,
        desde: desde,
        hasta: hasta,
        documento: documento,
        nombre: nombre,
        perfil: perfil,
        telefono: telefono,
        direccion: direccion,
        correo: correo
       
      },
     
      success: function (){
        $("body").overhang({
          type: "success",
          message: "Doctor configurado correctamente'"
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


