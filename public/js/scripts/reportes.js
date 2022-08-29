
/*********************************** */
/*********************************** */

  $("#reporteglobal").keypress(function(e) {
    e.defaultPrevented;
    if (e.which == 13) {
        return false;
    }
  });
  $("#reporteglobal").submit(function(event) {
    event.preventDefault();
    Suubtmit(baseurl + "administracion/reporteglobal");
  });
  /*********************************** */
  /*********************************** */
  
  /*********************************** */
  /*********************************** */
  $('#'+baseurl + "administracion/reportegastos").keypress(function(e) {
    e.defaultPrevented;
    if (e.which == 13) {
        return false;
    }
  });
  $("#"+baseurl + "administracion/reportegastos").submit(function(event) {
    event.preventDefault();
    Suubtmit('#'+baseurl + "administracion/reportegastos");
  });
  /*********************************** */
  /*********************************** */
  
  $('#'+baseurl + "administracion/reportelaboratorio").keypress(function(e) {
    e.defaultPrevented;
    if (e.which == 13) {
        return false;
    }
  });
  $("#"+baseurl + "administracion/reportelaboratorio").submit(function(event) {
    event.preventDefault();
    Suubtmit('#'+baseurl + "administracion/reportelaboratorio");
  });
  /*********************************** */
  /*********************************** */
  
  $('#'+baseurl + "administracion/reportediario").keypress(function(e) {
    e.defaultPrevented;
    if (e.which == 13) {
        return false;
    }
  });
  $("#"+baseurl + "administracion/reportediario").submit(function(event) {
    event.preventDefault();
    Suubtmit('#'+baseurl + "administracion/reportediario");
  });
  
  /*********************************** */
  /*********************************** */
  
  function Suubtmit(_url__){
    var data_s = $('#reporteglobal').serializeArray(); // convert form to array
    console.log(_url__);
    $.ajax({
      url: _url__,
      method: "POST",
      data: data_s,
      success: function (data) { 
        data_all = JSON.parse(data);
        $("body").overhang({
            type: "success",
            message: "Descargando -> "+data_all.sms+".xlsx"
        });
        setTimeout(function() {
          var link = document.createElement("a");
          link.href = baseurl+"PHPExcel/Examples/REPORTES/"+data_all.sms+".xlsx";
          document.body.appendChild(link);
          link.click();
          link.remove();
            //window.open(_baseurl__, "_blank", " width=500, height=400");
            //location.reload();
        }, 700);
      },
      error: function () {
         $("body").overhang({
           type: "error",
          message: "Alerta ! Tenemos un problema al conectar con la base de datos verifica tu red.",
        }); 
      }
    })
  }