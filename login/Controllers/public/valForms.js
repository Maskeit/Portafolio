(function() {
    var formData = document.getElementById("login-form"),
        elementos = formData.elements,
        boton = document.getElementById('btn');
    var smallError = document.getElementById("error");
        var validarEmail = function(e){

          var email = formData.email.value;
          var regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/; // Expresión regular para validar un correo electrónico

          if(email === ''){
              smallError.classList.remove('d-none');
              smallError.classList.add('d-block');
              smallError.textContent = "Completa el campo correo";
              e.preventDefault(e);
          } else if (!regexEmail.test(email)) {
            smallError.classList.remove('d-none');
            smallError.classList.add('d-block');
            smallError.textContent = "El correo electrónico no es válido";
              e.preventDefault(e);
          }
      };
    var validarUser = function(e) {

      if(elementos.username.value == '') {
          smallError.classList.remove('d-none');
          smallError.classList.add('d-block');
          smallError.textContent = "completa el campo usuario";
        e.preventDefault();
      } else if (elementos.username.value.length < 6) {
          smallError.classList.remove('d-none');
          smallError.classList.add('d-block');
          smallError.textContent = "El usuario debe contener mas de 6 caracteres.";
        e.preventDefault();
      }
    };
  
    var validarPasswd = function(e) {
      if(elementos.passwd.value == '') {
        smallError.classList.remove('d-none');
          smallError.classList.add('d-block');
          smallError.textContent = "Completa el campo contraseña.";
        e.preventDefault();
      }else if(elementos.passwd.value.length < 8){
        smallError.classList.remove('d-none');
          smallError.classList.add('d-block');
          smallError.textContent = "La contraseña debe tener una longitud minima de 8 y un caracter especial por ejemplo \"@ # ~ € &_\" .";
        e.preventDefault();
      }
    };
  
    var validarPasswd2 = function(e) {
      if(elementos.passwd2.value == '') {
        smallError.classList.remove('d-none');
          smallError.classList.add('d-block');
          smallError.textContent = "Completa el campo repetir contraseña.";
        e.preventDefault();
      } else if((elementos.passwd.value) !== (elementos.passwd2.value)){
        smallError.classList.remove('d-none');
          smallError.classList.add('d-block');
          smallError.textContent = "Las contraseñas no coinciden!.";
        e.preventDefault();
      }
    };
    $('#login-form').submit(function(event) {
    var validar = function(e) {
      validarEmail(e);
      validarUser(e);
      validarPasswd(e);
      validarPasswd2(e);
    };
    formData.addEventListener("submit", validar);
          return false;
    });
  })();

  $.ajax({
    type: "POST",
    url: "../Controllers/RegistroController.php",
    data: {
      username: $('#username').val()
    },
    dataType: "json",
    success: function(response) {
      console.log(response);
      if (response.status == "ocupado") {
        var usuarioOcupado = document.getElementById("usuarioOcupado");
        usuarioOcupado.classList.remove('d-none');
        usuarioOcupado.classList.add('d-block');
        usuarioOcupado.textContent = "El nombre de usuario ya está ocupado.";
      }
    },
    // error: function() {
    //   alert("Hubo un error al procesar la solicitud");
    // }
  });
  