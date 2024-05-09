document.addEventListener("readystatechange",cargarEventos,false)//cargar todo (siempre es así)
function cargarEventos(evento){//comprobamos que el esxtado está interecativo (funciona)
    if(document.readyState=="interactive"){
        document.getElementById("registrar").addEventListener("click", comprueba, true);//cogemos el elemento por el id, le añadimos uno que escucha los clicks y manda a comprobarlos
        document.getElementById("nombre").addEventListener("click",function (){ocultarError("mnombre")}, true);
        document.getElementById("email").addEventListener("click",function (){ocultarError("mcorreo")}, true);
        document.getElementById("contrasena").addEventListener("click",function (){ocultarError("mcontrasena")}, true);
        document.getElementById("fecha_nacimiento").addEventListener("click",function (){ocultarError("mfecha")}, true);
        document.getElementById("direccion").addEventListener("click",function (){ocultarError("mdireccion")}, true);
        document.getElementById("telfono").addEventListener("click",function (){ocultarError("mtelefono")}, true);
        document.getElementById("mostrar").addEventListener("click", mostrarContrasena, true);
    }
}


function enviar(){
    document.forms["formulario"].submit();
}

function comprueba(){
    //hasta que no se comprueba todo no se hace la llamada por eso no se recarga la página
    var nombre= 0;
    var email= 0;
    var contra = 0;
    var fecha = 0;
    var direccion= 0;
    var telefono= 0;

        if(document.getElementById("nombre").value==""){
            document.getElementById("mnombre").className="visible";
        }else{
            nombre=1;
        }
        
        if(document.getElementById("email").value==""){
            document.getElementById("memail").innerText="Campo obligatorio";
            document.getElementById("memail").className="visible";
        }else{
            validarCorreo(document.getElementById("email").value)?correo=1:document.getElementById("memail").className="visible"
             document.getElementById("memail").innerText="No cumple con los requisitos";
           
        }

        if(document.getElementById("fecha_nacimiento").value==""){
            document.getElementById("mfecha").innerText="Campo obligatorio";
            document.getElementById("mfecha").className="visible";
        }else{
             mayorDe16(document.getElementById("fecha_nacimiento").value)?fecha=1:document.getElementById("mfecha").className="visible"
            document.getElementById("mfecha").innerText="Para registrarte debes ser mayor de 16 años.";
            
        }

        if(document.getElementById("direccion").value==""){
            document.getElementById("mdireccion").className="visible";
        }else{
            direccion=1;
        }

        if(document.getElementById("telefono").value==""){
            document.getElementById("mtelefono").innerText="Campo obligatorio";
            document.getElementById("mtelefono").className="visible";
        }else{
            validarTelefono(document.getElementById("telefono").value)?telefono=1:document.getElementById("mtelefono").className="visible"
            document.getElementById("mtelefono").innerText="EL número debe tener 9 dígitos.";
        }

    if(document.getElementById("contrasena").value==""){
        document.getElementById("mcontrasena").innerText="Campo obligatorio";
        document.getElementById("mcontrasena").className="visible";
    }else{
       
            document.getElementById("mcontrasena").innerText="";
            switch (validarContrasena(document.getElementById("contrasena").value)) {
                case "ok":
                    contra=1;
                    break;
                case "longitud":
                    document.getElementById("mcontrasena").innerText="La longitud debe de ser de al menos 8 caracteres";
                    document.getElementById("mcontrasena").className="visible";
                    break;
                case "mayuscula":
                    document.getElementById("mcontrasena").innerText="La contraseña debe contener al menos una mayúscula";
                    document.getElementById("mcontrasena").className="visible";
                    break;
                case "minuscula":
                    document.getElementById("mcontrasena").innerText="La contraseña debe contener al menos una minúscula";
                    document.getElementById("mcontrasena").className="visible";
                    break;
                case "numero":
                    document.getElementById("mcontrasena").innerText="La contraseña debe contener al menos un número";
                    document.getElementById("mcontrasena").className="visible";
                    break;
                
            }

            if(nombre + apellido + contra + correo + fecha + telefono + direccion == 7){
                enviar();
            }
        
    }

}

function ocultarError(parametro){
    document.getElementById(parametro).className = "noVisible";
}

function validarContrasena(contraseña) {
    // Establecer los criterios de seguridad
    let criterios = {
        longitud: 8,
        mayusculas: true,
        minusculas: true,
        numeros: true,
       
    };
    
    // Comprobar la longitud de la contraseña
    if (contraseña.length < criterios.longitud) {
        return "longitud";
    }
    
    // Comprobar si hay mayúsculas
    if (criterios.mayusculas && !/[A-Z]/.test(contraseña)) {
        return "mayuscula";
    }
    
    // Comprobar si hay minúsculas
    if (criterios.minusculas && !/[a-z]/.test(contraseña)) {
        return "minuscula";
    }
    
    // Comprobar si hay números
    if (criterios.numeros && !/[0-9]/.test(contraseña)) {
        return "numero";
    }

    // Si se han superado todas las comprobaciones, la contraseña es válida
    return "ok";

    }

function validarCorreo(correo) {
        // compruebo la expresión regular y devulevo si es válido o no
        if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(correo)) {
            return true;
        } else {
            return false;
        }
    }

function validarTelefono(telefono){
    // compruebo la expresión regular y devulevo si es válido o no
    if (/^\d{9}$/.test(telefono)) {
        return true;
    } else {
        return false;
    }

}


function mayorDe16(fecha) {
    //creamos la fecha de hoy
    const fechaActual = new Date();

    //le restamos 16 años a la fecha actual
    const fechaHace16Anios = new Date(fechaActual.getFullYear() - 16, fechaActual.getMonth(), fechaActual.getDate());

    //convertimos la fecha de entrada en date
    const fechaNacimiento = new Date(fecha);

    //comprobamos que sea mayor de 16 años
    return fechaNacimiento <= fechaHace16Anios || (fechaNacimiento.getMonth() === fechaHace16Anios.getMonth() && fechaNacimiento.getDate() === fechaHace16Anios.getDate());
}

function mostrarContrasena(){
    var icono = document.getElementById("mostrar");
    var tipo = document.getElementById("contra");

    if(tipo.type == "password"){
        icono.className="fa-regular fa-eye";
        tipo.type = "text";
    }else{
        tipo.type = "password";
        icono.className="fa-regular fa-eye-slash";
    }
}
