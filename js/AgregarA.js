function mostrarOcultarFormulario(selectElement) {
    var formularioAdicional = document.getElementById('formularioAdicional');
    if (selectElement.value === 'si') {
        formularioAdicional.style.display = 'block';
    } else {
        formularioAdicional.style.display = 'none';
    }
}


$(document).ready(function () {
	var current_fs, next_fs, previous_fs; //fieldsets
	var opacity;
	var current = 1;
	var steps = $("fieldset").length;
  
	setProgressBar(current);
  
	$(".next").click(function () {
	  current_fs = $(this).parent();
	  next_fs = $(this).parent().next();
  
	  //Add Class Active
	  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
  
	  //show the next fieldset
	  next_fs.show();
	  //hide the current fieldset with style
	  current_fs.animate(
		{ opacity: 0 },
		{
		  step: function (now) {
			// for making fielset appear animation
			opacity = 1 - now;
  
			current_fs.css({
			  display: "none",
			  position: "relative"
			});
			next_fs.css({ opacity: opacity });
		  },
		  duration: 500
		}
	  );
	  setProgressBar(++current);
	});
  
	$(".previous").click(function () {
	  current_fs = $(this).parent();
	  previous_fs = $(this).parent().prev();
  
	  //Remove class active
	  $("#progressbar li")
		.eq($("fieldset").index(current_fs))
		.removeClass("active");
  
	  //show the previous fieldset
	  previous_fs.show();
  
	  //hide the current fieldset with style
	  current_fs.animate(
		{ opacity: 0 },
		{
		  step: function (now) {
			// for making fielset appear animation
			opacity = 1 - now;
  
			current_fs.css({
			  display: "none",
			  position: "relative"
			});
			previous_fs.css({ opacity: opacity });
		  },
		  duration: 500
		}
	  );
	  setProgressBar(--current);
	});
  
	function setProgressBar(curStep) {
	  var percent = parseFloat(100 / steps) * curStep;
	  percent = percent.toFixed();
	  $(".progress-bar").css("width", percent + "%");
	}
  
	$(".submit").click(function () {
	  return false;
	});
  });
  
  //var ciudad = document.getElementById("ciudad").selectedIndex;

function validar() {
	var apellido = document.getElementById("ape");
	var nombre = document.getElementById("nomb");
	var dni = document.getElementById("dni");
	var sexo = document.getElementsByName("genero");
	var seleccionado = false;
	var domicilio = document.getElementById("domc");
	var fechanac = document.getElementById("fechanac");
	var nombre_tutor = document.getElementById("nombt");

	if(apellido.value.length == 0)
	{
      alert("Debe ingresar el apellido");
    	user.focus();
    	return false;
	}
	if(nombre.value.length == 0)
	{
      alert("Debe ingresar el nombre");
    	user.focus();
    	return false;
	}
	if(dni.value.length == 0)
	{
      alert("Debe ingresar el documento");
    	user.focus();
    	return false;
	}
	if(user.value.length == 0)
	{
      alert("Debe ingresar el Usuario");
    	user.focus();
    	return false;
	}
	if(email.value.length == 0)
	{
		alert("Por favor, ingrese su Email");
		email.focus();
		return false;
	}
	if(pass1.value.length < 6)
	{
		alert("Debe ingresar una contraseña de más de 6 caracteres");
		pass1.focus();
		return false;
	}
	else if(pass1.value != pass2.value)
	{
		alert("Las contraseñas no coinciden");
		pass2.focus();
		return false;
	}
	if(codipos.value.length == 0)
	{
		alert("Por favor ingrese su código postal");
		codipos.focus();
		return false;
	}
	else if(codipos.value.length != 0 && isNaN(codipos.value))
	{
		alert("Por favor, ingrese solo numeros en el código postal");
		codipos.focus();
		return false;
	}
	for(var i = 0; i<sexo.length; i++)
	{
		if(sexo[i].checked)
		{
			seleccionado = true;
		}
	}
	if(!seleccionado)
	{
		alert("Debes indicar el sexo");
		return false;
	}
  else
  {
    alert("Datos de formulario enviados exitosamente.");
    document.getElementById("myForm").reset();
	  return false;
	}
}