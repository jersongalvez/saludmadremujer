var urlpacientes = baseurl + "administracion/pacientes/cargar_pacientes";
$("#table-pacientes").DataTable({
	bProcessing: true,
	serverSide: true,
	ajax: {
		url: urlpacientes,
		type: "post",
		error: function () {
			// alert("error");
		},
	},
	lengthMenu: [10, 50, 100, 200],
	language: {
		processing: "Procesando",
		search: "Buscar:",
		lengthMenu: "Ver _MENU_  Pacientes",
		info: "Mirando _START_ a _END_ de _TOTAL_ Pacientes",
		zeroRecords: "No encontraron resultados",
		paginate: {
			first: "Primera",
			last: "Ultima",
			next: "Siguiente",
			previous: "Anterior",
		},
	},
});

var responsable = $("input:radio[name=responsable]").change(function () {
	if ($(this).val() === "si") {
		$(".responsable").attr("hidden", false);
	}
});
$("#crearpaciente").on("click", function () {
	var url1 = baseurl + "crearpacientes",
		dni = $("#dni").val(),
		nombre = $("#nombre").val(),
		apellido = $("#apellido").val(),
		hc = $("#hc").val(),
		celular = $("#celular").val(),
		sexo = $("#sexo").val(),
		fecha_nacimiento = $("#fecha_nacimiento").val(),
		edad = $("#edad").val(),
		direccion = $("#direccion").val(),
		departamento = $("#departamento").val(),
		provincia = $("#provincia").val(),
		distrito = $("#distrito").val(),
		ocupacion = $("#ocupacion").val(),
		grado_academico = $("#grado_academico").val(),
		estado_civil = $("#estado_civil").val(),
		responsable = $("input:radio[name=responsable]").val(),
		documento = $("#documento").val(),
		fresponsable = $("#fresponsable").val();

	if (dni === "") {
		$("#dni").addClass("is-invalid");
	} else if (nombre === "") {
		$("#dni").removeClass("is-invalid");
		$("#dni").addClass("is-valid");
		$("#nombre").addClass("is-invalid");
	} else if (celular === "") {
		$("#nombre").removeClass("is-invalid");
		$("#nombre").addClass("is-valid");
		$("#celular").addClass("is-invalid");
	} else if (sexo === "") {
		$("#celular").removeClass("is-invalid");
		$("#celular").addClass("is-valid");
		$("#sexo").addClass("is-invalid");
	} else if (fecha_nacimiento === "") {
		$("#sexo").removeClass("is-invalid");
		$("#sexo").addClass("is-valid");
		$("#fecha_nacimiento").addClass("is-invalid");
	} else if (direccion === "") {
		$("#fecha_nacimiento").removeClass("is-invalid");
		$("#fecha_nacimiento").addClass("is-valid");
		$("#direccion").addClass("is-invalid");
	} else if (departamento === "") {
		$("#direccion").removeClass("is-invalid");
		$("#direccion").addClass("is-valid");
		$("#departamento").addClass("is-invalid");
	} else if (provincia === "") {
		$("#departamento").removeClass("is-invalid");
		$("#departamento").addClass("is-valid");
		$("#provincia").addClass("is-invalid");
	} else if (distrito === "") {
		$("#provincia").removeClass("is-invalid");
		$("#provincia").addClass("is-valid");
		$("#distrito").addClass("is-invalid");
	} else if (ocupacion === "") {
		$("#distrito").removeClass("is-invalid");
		$("#distrito").addClass("is-valid");
		$("#ocupacion").addClass("is-invalid");
	} else if (grado_academico === "") {
		$("#ocupacion").removeClass("is-invalid");
		$("#ocupacion").addClass("is-valid");
		$("#grado_academico").addClass("is-invalid");
	} else if (estado_civil === "") {
		$("#grado_academico").removeClass("is-invalid");
		$("#grado_academico").addClass("is-valid");
		$("#estado_civil").addClass("is-invalid");
	} else {
		$.ajax({
			url: url1,
			method: "POST",
			data: {
				dni: dni,
				nombre: nombre,
				apellido: apellido,
				hc: hc,
				celular: celular,
				sexo: sexo,
				fecha_nacimiento: fecha_nacimiento,
				edad: edad,
				direccion: direccion,
				departamento: departamento,
				provincia: provincia,
				distrito: distrito,
				ocupacion: ocupacion,
				grado_academico: grado_academico,
				estado_civil: estado_civil,
				responsable: responsable,
				documento: documento,
				fresponsable: fresponsable,
			},
			success: function (json) {
            json =  JSON.parse(json);
            if(json.success == 1){//Paciente Actualizado Correctamente,
               $("body").overhang({
               type: "success",
               message: json.message
               });
                  setTimeout(reloadPage, 3000);
            }else{//Ya existe un paciente con este NRO DOC - WARNING
               $("body").overhang({
               type: "warn",
               message: json.message
               });
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
	}
});
$("#fecha_nacimiento").on("blur", function () {
	let fechas = new Date().getTime();
	let cumpleanios = new Date($(this).val()).getTime();
	const anios = (fechas - cumpleanios) / 3.154e10;
	anos = Math.floor(anios);
	$("#edad").val(anos);
	$("#edad").attr("readonly", true);
});

$("#dni").on("blur", function () {
	var dni = $("#dni").val(),
		url2 =
			"https://apiperu.dev/api/dni/" +
			dni +
			"?api_token=" +
			"e02a95cc4b8e0d521d447c0786af76cdb424b6a2ba25aea9f7cd9e9bc4712e86";
	$.ajax({
		url: url2,
		method: "GET",
		success: function (data) {
			// console.log(data);
			$("#nombre").val(data.data.nombres);
			$("#apellido").val(
				data.data.apellido_paterno + " " + data.data.apellido_materno
			);
			$("#direccion").val(data.data.direccion);
			departamento = data.data.ubigeo[0];
			provincia = data.data.ubigeo[1];
			distrito = data.data.ubigeo[2];
			$("#departamento").val(departamento).prop("selected", true);
			$("#provincia").val(provincia).prop("selected", true);
			$("#distrito").val(distrito).prop("selected", true);
		},
		error: function () {
			$("body").overhang({
				type: "error",
				message:
					"Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
			});
		},
	});
});

$("#documento").on("blur", function () {
	var documento = $("#documento").val(),
		url3 =
			"https://apiperu.dev/api/dni/" +
			documento +
			"?api_token=" +
			"e02a95cc4b8e0d521d447c0786af76cdb424b6a2ba25aea9f7cd9e9bc4712e86";
	$.ajax({
		url: url3,
		method: "GET",
		success: function (data) {
			$("#responsable").val(
				data.data.nombres +
					" " +
					data.data.apellido_paterno +
					" " +
					data.data.apellido_materno
			);
		},
	});
});

url4 = baseurl + "contarconsecutivo";
$.ajax({
	url: url4,
	method: "GET",
	success: function (data) {
		data = JSON.parse(data);
		suma = parseInt(data.numero.numero) + 1;
		$("#hc").val(suma);
	},
	error: function () {
		$("body").overhang({
			type: "error",
			message:
				"Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
		});
	},
});

$("#btn-actualizar").on("click", function () {
	var url4 = baseurl + "administracion/actualizarpacientes",
		id = $("#id2").val(),
		celular = $("#celular2").val(),
		direccion = $("#direccion2").val(),
		departamento = $("#departamento2").val(),
		provincia = $("#provincia2").val(),
		distrito = $("#distrito2").val(),
		ocupacion = $("#ocupacion2").val(),
		grado_academico = $("#grado_academico2").val(),
		estado_civil = $("#estado_civil2").val(),
		documento = $("#documento2").val(),
		fresponsable = $("#fresponsable2").val();

	$.ajax({
		url: url4,
		method: "POST",
		data: {
			id: id,
			celular: celular,
			direccion: direccion,
			departamento: departamento,
			provincia: provincia,
			distrito: distrito,
			ocupacion: ocupacion,
			grado_academico: grado_academico,
			estado_civil: estado_civil,
			documento: documento,
			fresponsable: fresponsable,
		},
		success: function () {
			json =  JSON.parse(json);
         if(json.success == 1){//Paciente Actualizado Correctamente,
            $("body").overhang({
               type: "success",
               message: json.message
            });
			   setTimeout(reloadPage, 3000);
         }else{//Paciente Actualizado Correctamente,
            $("body").overhang({
               type: "warn",
               message: json.message
            });
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
});

const reloadPage = () => {
	location.reload();
};
