$("#tabla-productos").DataTable({
    "lengthMenu": [10, 50, 100, 200],
    "language":{
      "processing": "Procesando",
      "search": "Buscar:",
      "lengthMenu": "Ver _MENU_  productos",
      "info": "Mirando _START_ a _END_ de _TOTAL_ productos",
      "zeroRecords": "No encontraron resultados",
      "paginate": {
        "first":      "Primera",
        "last":       "Ultima",
        "next":       "Siguiente",
        "previous":   "Anterior"
      }
    }
   });


$("#guardar_productos").on("click", function () {
    let url = baseurl + "administracion/crearproducto",
        categoria = $("#categoria").val(),
        nombre = $("#nombre").val(),
        codigo = $("#codigo").val(),
        codigo_barras = $("#codigo_barras").val(),
        medida = $("#medida").val(),
        cantidad = $("#cantidad").val(),
        precio = $("#precio").val(),
        moneda = $("#moneda").val(),
        descripcion = $("#descripcion").val();
    //VALIDACION
        if (categoria ===""){
            $("#categoria").addClass("is-invalid");
        }
        else if (nombre ===""){
            $("#nombre").addClass("is-invalid");
        }
        else if(codigo ===""){
            $("#codigo").addClass("is-invalid");
        }
        else if (medida ===""){
            $("#medida").addClass("is-invalid");
        }
        else if(cantidad ===""){
            $("#cantidad").addClass("is-invalid");
        }
        else if(precio ===""){
            $("#precio").addClass("is-invalid");
        }
        else if(moneda ===""){
            $("#moneda").addClass("is-invalid");

        } else {
            
        $.ajax({
            url: url,
            method: "POST",
            data: {
                categoria: categoria,
                nombre: nombre,
                codigo: codigo,
                codigo_barras: codigo_barras,
                medida: medida,
                cantidad: cantidad,
                precio: precio,
                moneda: moneda,
                descripcion: descripcion,
            },
            success: function () {
                $("body").overhang({
                    type: "success",
                    message: "Producto se ha registrado correctamente"
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

$("#producto_e").on("change", function() {
    var id = $("#producto_e").val(), 
    url = baseurl + "administracion/traerstock/" + id;

    $.ajax({
        url: url,
        method: "GET",
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            $("#stock_e").val(data.stock);
        }
    })
})



$("#guardar_e").on("click", function () {
    var url = baseurl + "administracion/crearentrada",
        cantidad = $("#cantidad_e").val(),
        stock = $("#stock_e").val(),
        total = parseInt(cantidad) + parseInt(stock),
        producto = $("#producto_e").val(),
        seccion = $("#seccion_e").val(),
        motivo = $("#motivo_e").val(),
        comentarios = $("#comentarios_e").val();

        $.ajax({
            url: url,
            method: "POST",
            data: {
                cantidad: cantidad,
                total: total,
                producto: producto,
                seccion: seccion,
                motivo: motivo,
                comentarios: comentarios
            },
            success: function () {
                $("body").overhang({
                    type: "success",
                    message: "se ha agregado entrada correctamente"
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

})

$("#producto_s").on("change", function() {
    var id = $("#producto_s").val(), 
    url = baseurl + "administracion/traerstock/" + id;

    $.ajax({
        url: url,
        method: "GET",
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            $("#stock_s").val(data.stock);
        }
    })
})

$("#guardar_s").on("click", function () {
    var url = baseurl + "administracion/crearsalida",
        cantidad = $("#cantidad_s").val(),
        stock = $("#stock_s").val(),
        total = parseInt(stock) - parseInt(cantidad),
        producto = $("#producto_s").val(),
        seccion = $("#seccion_s").val(),
        motivo = $("#motivo_s").val(),
        comentarios = $("#comentarios_s").val();
        if(total < 0){
            $("body").overhang({
                type: "confirm",
                primary: "#40D47E",
                accent: "#27AE60",
                yesColor: "#3498DB",
                message: "Esta apunto de dejar un inventario negativo desea continuar?",
                overlay: true,
                callback: function (value) {
                    if(value == false){
                        
                    }
                    else {
                        $.ajax({
                            url: url,
                            method: "POST",
                            data: {
                                cantidad: cantidad,
                                total: total,
                                producto: producto,
                                seccion: seccion,
                                motivo: motivo,
                                comentarios: comentarios
                            },
                            success: function () {
                                $("body").overhang({
                                    type: "success",
                                    message: "se ha agregado salida correctamente"
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
                    } 
                }
              });
        }
        else {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    cantidad: cantidad,
                    total: total,
                    producto: producto,
                    seccion: seccion,
                    motivo: motivo,
                    comentarios: comentarios
                },
                success: function () {
                    $("body").overhang({
                        type: "success",
                        message: "se ha agregado salida correctamente"
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
        }     
})

$("#stock_reporte").on("change", function() {

    var id = $("#stock_reporte").val(), 
    url = baseurl + "administracion/consultainventario/" + id ;
    //alert($("#stock_reporte").val());
    $.ajax({
        url: url,
        method: "GET",
        success: function (data) {
            data = JSON.parse(data);
            inventario = data.map(function (inven) {
              return '<tr><td class="text-uppercase text-dark text-xs font-weight-bolder opacity-12">'+inven.codigo+'</td><td class="text-uppercase text-dark text-xs font-weight-bolder opacity-12">'+inven.nombre+'</td><td class="text-uppercase text-dark text-xs font-weight-bolder opacity-12">'+inven.categorias+'</td><td class="text-uppercase text-dark text-xs font-weight-bolder opacity-12">'+inven.precio+'</td><td class="text-uppercase text-dark text-xs font-weight-bolder opacity-12">'+inven.fecha+'</td><td class="text-uppercase text-dark text-xs font-weight-bolder opacity-12">'+inven.stock+'</td></tr>';
            });
            $("#table-consulta").html(inventario);
            $(".btn-pdf").attr("hidden", false);
        }
    });
})

$("#buscar_kardex").on("click", function () {
    let url = baseurl + "administracion/consultarkardex",
    producto_kardex = $("#producto_kardex").val(),
    fecha_inicial = $("#fecha_inicial").val(),
    fecha_final =  $("#fecha_final").val();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            producto_kardex: producto_kardex,
            fecha_inicial: fecha_inicial,
            fecha_final: fecha_final
        },
        success: function (data) {
            data = JSON.parse(data);
            kardex = data.map(function (karde) {
                return '<tr><td>'+karde.codigo_kardex+'</td><td>'+karde.fecha+'</td><td>'+karde.tp_documento+karde.codigo_kardex +'</td><td>'+karde.motivo+'</td><td>'+karde.entrada+'</td><td>'+karde.salida+'</td><td>'+karde.saldo+'</td></tr>'
            });
            $("#table-kardex").html(kardex);
            $("#pdf-kardex").attr("hidden", false);
        }
    })
})

$("#generarpdfinventario").on("click", function () {
    url = baseurl + "administracion/pdfinventarios",
    stock = $("#stock_reporte").val();

    $.ajax({
        url: url,
        method: "POST",
        data: {
            stock: stock
        },
        success: function () {
            window.open(baseurl + "administracion/pdfinventarios", "consulta de inventarios", "width=900, height=1800");
        }
    })
});


const reloadPage = () => {
    location.reload();
  }