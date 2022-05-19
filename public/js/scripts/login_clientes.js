$("#login_clientes").on("click", function() {
      var url = baseurl + "iniciarsesionclientes",
          correo = $("#correo").val(),
          password = $("#password").val();

      if(correo == "") {
        $(".correo").addClass("is-invalid");
      }
      else if (password == "") {
        $(".password").addClass("is-invalid");
      }
      else {
        $(".password").addClass("is-valid");
        $(".correo").addClass("is-valid");
          $.ajax({
            url: url,
            method: "POST",
            data: { correo: correo, password: password },
            success: function (data) {
              if(data === "error"){
                $(".messageError").html('<div class="alert text-white alert-success">El documento o contraseña son invalidos.</div>');
                $(".password").addClass("is-invalid");
                $(".correo").addClass("is-invalid");
               }
               else {
                 window.location = baseurl + "clientes/inicio";
               }
             }
           })  
      }
})