$(document).ready(function (){

  $("#table-gastos").DataTable({
    "lengthMenu": [10, 50, 100, 200],
    "language":{
      "processing": "Procesando",
      "search": "Buscar:",
      "lengthMenu": "Ver _MENU_  Pagos",
      "info": "Mirando _START_ a _END_ de _TOTAL_ Pagos",
      "zeroRecords": "No encontraron resultados",
      "paginate": {
        "first":      "Primera",
        "last":       "Ultima",
        "next":       "Siguiente",
        "previous":   "Anterior"
      }
    }
  });
});

$("#btn_AddGasto").click(function () {
	$("#AddGasto").trigger("reset");
	$("#statee").val("Registrar");
});
$("#prov_nro_doc").keyup(function (e) {
  e.defaultPrevented;
  if (e.which == 13) {
    VAL_Search_RUC();
  }
});
$("#prov_btn_buscar").click(function () {
	VAL_Search_RUC();
});
function VAL_Search_RUC() {
	var url1 = baseurl + "buscarproveedor",
		ruc = $("#prov_nro_doc").val();
	if (ruc.length == 11) {
    $.ajax({
      url: url1,
      method: "POST",
      data: { ruc: ruc },
      success: function (data) {
        if (data === "error") {
          url2 =
            "https://apiperu.dev/api/ruc/" +
            ruc +
            "?api_token=" +
            "e02a95cc4b8e0d521d447c0786af76cdb424b6a2ba25aea9f7cd9e9bc4712e86";
          $.ajax({
            url: url2,
            method: "GET",
            success: function (data) {
              data = data.data;
			        $("#prov_razon_social").val(data.nombre_o_razon_social);
            },
            error: function () {
              $("body").overhang({
                type: "error",
                message:
                  "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
              });
            },
          });
        } else {
          data = JSON.parse(data);
          $("#prov_razon_social").val(data.razon_social);
        }
      },
      error: function () {
        $("body").overhang({
          type: "error",
          message:
            "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
        });
      },
    });
	} else {
		warning("Minimo debe ingresar 11 digitos");
	}
}
$("#AddGasto").keypress(function (e) {
	e.defaultPrevented;
	if (e.which == 13) {
		return false;
	}
});
$("#AddGasto").submit(function (event) {
	event.preventDefault();
	Suubtmit();
});
function Suubtmit() {
  var data_s = $('#AddGasto').serializeArray(); // convert form to array
	var url1 = baseurl + "administracion/formgastocpe";
	$.ajax({
		url: url1,
		method: "POST",
		data: data_s,
		success: function (data) {
      data = JSON.parse(data);
      //console.log(data);
      if (data.acction === 1) {
        $("body").overhang({
          type: "success",
          message: data.sms,
        });
      } else if (data.acction === 2) {
        $("body").overhang({
          type: "warning",
          message: data.sms,
        });
      }
      $("#AgregarCPE").modal("hide");
      setTimeout(reloadPage, 1500);
		},
		error: function () {
			$("body").overhang({
				type: "warning",
				message:
					"No se realizo la operacion.",
			});
		},
	});
}
$("#cpe_total").keyup(function() {
  if ($("#cpe_tipo").val() == 1) {
      $("#cpe_gravada").val(($("#cpe_total").val() / 1.18).toFixed(2));
      $("#cpe_igv").val((($("#cpe_total").val() / 1.18) * 0.18).toFixed(2));
  }else {
      $("#cpe_gravada").val(0);
      $("#cpe_igv").val(0);
  }
})

$("#cpe_tipo").change(function() {
  if ($("#cpe_tipo").val() == 1) {
      $("#cpe_gravada").val(($("#cpe_total").val() / 1.18).toFixed(2));
      $("#cpe_igv").val((($("#cpe_total").val() / 1.18) * 0.18).toFixed(2));
  }else {
      $("#cpe_gravada").val(0);
      $("#cpe_igv").val(0);
  }
})

$("#cpe_serie").keyup(function(e) {
  val_nro_caracteres(($("#cpe_serie").val()).length, 4);
});
$("#cpe_numero").keyup(function(e) {
  val_nro_caracteres(($("#cpe_numero").val()).length, 8);
});
function val_nro_caracteres(text, num) {
  if (text < num) {
      return true;
  } else {
      return false;
  }
}

function editarCPE(ideee) {  
  var data_s = new Array();
  data_s.push({
    name: "ideee",
    value: ideee
  });
	var url1 = baseurl + "administracion/loadcpegasto";
	$.ajax({
		url: url1,
		method: "POST",
		data: data_s,
		success: function (data) {
	    $("#AddGasto").trigger("reset");
      if (data === "error") {
        $("body").overhang({
          type: "warning",
          message: "No se encontraron datos",
        });
      } else {
        data_all = JSON.parse(data);
        data = data_all.gastos;
        $("#statee").val("Actualizar");
        $("#cpe_tipo").val(data.cpe_tipo);
        $("#idgastos").val(data.iddoc_cpe);
        $("#cpe_tipo").val(data.tipo_cpe);
        $("#cpe_serie").val(data.serie);
        $("#cpe_numero").val(data.numero);
        $("#cpe_gravada").val(data.op_grav);
        $("#cpe_igv").val(data.igv);
        $("#cpe_total").val(data.monto);
        $("#f_emision").val(data.f_emision);
        $("#f_recepcion").val(data.f_recepcion);
        $("#descripcion").val(data.descripcion);
        $("#prov_tipo_doc").val(data.tipo_doc);
        $("#prov_nro_doc").val(data.nro_doc);
        $("#prov_razon_social").val(data.razon_social);
        $("#codigo_usuario").val(data.codigo_usuario);
        $("#AgregarCPE").modal("show");
        $("body").overhang({
          type: "success",
          message: data_all.sms,
        });
      } 
		},
		error: function () {
			$("body").overhang({
				type: "warning",
				message:
					"No se realizo la operacion.",
			});
		},
	});
}
$(".s_n").keypress(function(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla == 8 || tecla == 13) {
      return true;
  }
  numeros = /[0-9]/;
  tecla_final = String.fromCharCode(tecla);
  return numeros.test(tecla_final);
});


const reloadPage = () => {
  location.reload();
}