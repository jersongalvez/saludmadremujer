var dias = ["Domingo","Lunes","Martes","Mierc.","Jueves","Viernes","Sabado"];
$(document).ready(function() {
  $("#table-citas").DataTable();
});

$("#lupa_DNI").click(function(){
  VAL_Search_DNI();
});
function Cont_closest(bloque) {
  $(bloque).block({
      message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
      overlayCSS: {
          backgroundColor: '#fff',
          opacity: 0.8,
          cursor: 'wait'
      },
      css: {
          border: 0,
          padding: 0,
          backgroundColor: 'transparent'
      }
  });
}
function VAL_Search_DNI(){
  var url1 = baseurl + "buscarpaciente",
    dni = $("#dni").val();
  if(dni.length >=8 ){
  }else{
    warning("Minimo debe ingresar 8 digitos")
  }
  $.ajax({
  url: url1,
  method: "POST",
  data: { dni: dni },
  success: function(data) {
    if(data === "error"){
        $(".messageError").html('<div class="alert alert-danger" role="alert">El usuario no se encuentra registrado en la base de datos</div>');
    }
    else {
      console.log(data);
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
}

function Get_Horarios(insert_hora){
  var url2 = baseurl + "administracion/traerhorarios",
  fecha = $("#fecha").val(),
  medico = $("#medico").val();
  if(fecha != "" &&  medico != ""){
    $.ajax({
      url: url2,
      method: "POST",
      data: { medico: medico, fecha: fecha },
      success: function (data) {
          data = JSON.parse(data);
          $("#Cont_Horas").empty();
          $("#hora").empty();
          $("#hora").append('<option value="">Seleccionar</option>');
          var stta = true;
          if(data.acction==1){
            var arrr = data.horarios_mostrar;
            for (let i = 0; i < arrr.length; i++) {
              if(arrr[i]['hora']>insert_hora && stta == true && insert_hora !=""){
                stta = false;
                $("#Cont_Horas").append('<button type="button" onclick="btn_clock(this,'+"'"+insert_hora+"'"+')" class="btn_clock btn bg-gradient-warning" ><i class="fa fa-clock"></i>  '+insert_hora+'</button>');
                $("#hora").append('<option value="'+insert_hora+'">'+insert_hora+'</option>');
                console.log('<option value="'+insert_hora+'">'+insert_hora+'</option>');
              }
              $("#Cont_Horas").append('<button type="button" onclick="btn_clock(this,'+"'"+arrr[i]['hora']+"'"+')" class="btn_clock btn bg-gradient-info" ><i class="fa fa-clock"></i>  '+arrr[i]['hora']+'</button>');
              $("#hora").append('<option value="'+arrr[i]['hora']+'">'+arrr[i]['hora']+'</option>');
            }
          }else if(data.acction==2){
            $("#Cont_Horas").append('No se encontraron horarios libres para esta fecha, intente con otra fecha o doctor.');
          }
      },
      error: function () {
        $("body").overhang({
          type: "error",
          message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
        }); 
      }
    });
  }else{
    warning("Completar Medico y Fecha.")
  }
}
function btn_clock(aaa,insert_hora){
  $('#hora').val(insert_hora);
  $(".btn_clock").each(function(){
    if($(this).hasClass("bg-gradient-warning")){
      $(this).removeClass("bg-gradient-warning");
      $(this).addClass("bg-gradient-info");
    }
  });
  $(aaa).removeClass("bg-gradient-info");
  $(aaa).addClass("bg-gradient-warning");
};
$("#medico").change(function (){
  Get_Horarios("");
});
$("#fecha").change(function (){
  Get_Horarios("");
});
$("#lupa_Horario").click(function (){
  Get_Horarios("");
});

$('#AddCITA').keypress(function(e) {
  e.defaultPrevented;
  if (e.which == 13) {
      return false;
  }
});
$("#AddCITA").submit(function(event) {
  event.preventDefault();
  Suubtmit();
});

function Suubtmit() {
  var rruta="";
  if($("#statee").val()=="Registrar"){
    rruta = "crearcita";
  }else{
    rruta = "editarcita";
  }
    var url1 = baseurl + "administracion/"+rruta,
        dni = $("#dni").val(),
        idee = $("#idee").val(),
        nombre = $("#nombre").val(),
        medico = $("#medico").val(),
        fecha = $("#fecha").val(),
        hora = $("#hora").val(),
        estado = $("#estado").val(),
        observaciones = $("#observaciones").val();
    console.log(url1);
        $.ajax({
          url: url1,
          method: "POST",
          data: { 
              idee: idee,
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
              message: "Listo"
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
};

function editarCita(id) {
  var url3 = baseurl + "administracion/getcitasid";
  $.ajax({
    url: url3,
    method: "POST",
    data: {
      id:id
    },
    success: function(data) {
      $("#AgregarPaciente").modal("show");
      data = JSON.parse(data);
       $("#statee").val("Actualizar");
       $("#idee").val(data.codigo_cita);
       $("#dni").val(data.documento);
       $("#nombre").val(data.apellido + " "+ data.nombre);
       $("#medico").val(data.doctor).prop("selected", true);
       $("#fecha").val(data.fecha);
       //$("#Cont_Horas").append('<button type="button" onclick="$('+"'#hora'"+').val('+"'"+arrr[i]['hora']+"'"+')" class="btn bg-gradient-warning" ><i class="fa fa-clock"></i>  '+arrr[i]['hora']+'</button>');
       //<button type="button" style="padding: 5px 15px;margin: 5px;" onclick="$('#hora').val('18:15')" class="btn bg-gradient-warning" ><i class="fa fa-clock"></i>&nbsp;&nbsp;18:15</button>
       Get_Horarios(data.hora);
       setTimeout(function() {
        $("#hora").val(data.hora).prop("selected", true);
        $("#estado").val(data.estado).prop("selected", true);
       },500);
       $("#observaciones").val(data.comentarios);
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

var dias = ["Domingo","Lunes","Martes","Mierc.","Jueves","Viernes","Sabado"];
var __colores = ["#5bd5f5","#f77a92","#7de78a","#8187dc","#959595","#ffaaf5","#e1c62f","#ff674e"];

function Reset_Horarios(){
  fecha_hoy = new Date();
  var _ordenado = new Array();
  var __today = fecha_hoy.getDay();
  for (var i = __today; i < dias.length; i++){
    _ordenado.push(dias[i]);
  }
  for (var i = 0; i < __today; i++){
    _ordenado.push(dias[i]);
  }
  var a = 0;
  __fecha_hoy = new Date();
  $(".card > .bg-gradient-info").each(function(){
    var __today = __fecha_hoy.getDate();
    $(this).html(_ordenado[a]+" / "+__today);a++;
    //$(this).html(_ordenado[a]);a++;
    __fecha_hoy = (__fecha_hoy).setDate(__fecha_hoy.getDate() + 1);
    __fecha_hoy = new Date(__fecha_hoy);
    console.log(__fecha_hoy);
    console.log(__fecha_hoy);
  });
  var a = 0;
  //fecha_hoy = (fecha_hoy).setDate(fecha_hoy.getDate() - 1);
  $(".cont_day").each(function(){
    $(this).html("");
    for (var i = 0; i < arr_doctors.length; i++){
      if(arr_doctors[i][(_ordenado[a]).toLowerCase()]!=0){
        var namee__ = (arr_doctors[i]['nombre']).split(" ");
        fecha_hoy = new Date(fecha_hoy);
        var todayDate = (fecha_hoy).toISOString().slice(0, 10);
        $(this).append("<p onclick='call_reg_cita("+'"'+todayDate+'"'+","+arr_doctors[i]['codigo_doctor']+")' class='doc_p' title='"+arr_doctors[i]['nombre']+" "+arr_doctors[i]["Horas_"+(_ordenado[a]).toLowerCase()]+";' style='background-color: "+__colores[i]+";'><i class='fa fa-user-md'></i>  Dr."+((namee__[0]).substr(0,10)).toUpperCase()+"</p>");
      }
    }
    fecha_hoy = (fecha_hoy).setDate(fecha_hoy.getDate() + 1);
    a++;
  });
}

function call_reg_cita(fecha, medico){
  $("#AgregarPaciente").modal("show");
  $('#AddCITA').trigger('reset');
  $('#hora').empty();
  $("#fecha").val(fecha);
  $("#medico").val(medico);
  Get_Horarios("");
}