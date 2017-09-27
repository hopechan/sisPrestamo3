function comprobarPasswords() {
    var password = document.getElementById("password")
    var passwordAgain = document.getElementById("passwordAgain");
    var btnSaveUser = document.getElementById("saveUser");

    //comprueba si las contraseñas coinciden
    if (password.value == passwordAgain.value) {
        btnSaveUser.disabled = false;
        document.getElementById("password").style.borderColor=document.getElementById("userType").style.borderColor;
        document.getElementById("passwordAgain").style.borderColor=document.getElementById("userType").style.borderColor;
    } else {
        btnSaveUser.disabled = true;
        document.getElementById("password").style.borderColor="#ff0000";
        document.getElementById("passwordAgain").style.borderColor="#ff0000";
        
    }

    comprobarUsername();
}

function comprobarEspacios() {
    //Selecciona el elemento a comprobar, el que esté activo (que tenga el focus)
    var elementoActivo = document.activeElement.value;

    //Verifica que el último char ingresado no sea un espacio y si así es
    //muestra un alert "alertandole" al usuario de su error
    var n = elementoActivo.search(" ");
    if (n >= 0) {
        alert("Este elemento no puede contener espacios.");
    }

    //Asigna al elemento el mismo valor quitandole el último espacio ingresado
    document.activeElement.value = elementoActivo.trim();
}

function comprobarUsername() {
    var btnSaveUser = document.getElementById("saveUser");
    var username = $("input#username").val();

    $.post("validarUsername.php", { username: username }, function (existe) {
        if (existe == "true") {
            alert("Este nombre de usuario no está disponible");
            document.getElementById("username").style.borderColor="#ff0000";
            btnSaveUser.disabled = true;
        } else {
            btnSaveUser.disabled = false;
            document.getElementById("username").style.borderColor=document.getElementById("userType").style.borderColor;
            
            //Comprueba las passwords de nuevo para evitar errores
            comprobarPasswords();
        };
    });
};