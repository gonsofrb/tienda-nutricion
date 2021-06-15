
function checkInputName (){
    let formu = document.forms["form_register"];
    let inputName = formu["name"];
    let spanInfo = inputName.nextElementSibling;
    let expresion = /[A-Za-z ]{2,20}/;
    if(inputName.value == "" && inputName.value.length == 0){
        spanInfo.innerHTML = "Debe escribir un nombre";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else if(!inputName.value.match(expresion)){
        spanInfo.innerHTML = "Introduce de 2 a 20 letras ";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else{
        spanInfo.innerHTML = "";
        return true;
    }
        
    

}

function checkInputSurname (){
    let formu = document.forms["form_register"];
    let inputSurname = formu["surname"];
    let spanInfo = inputSurname.nextElementSibling;
    let expresion = /[A-Za-z ]{2,20}/;
    if(inputSurname.value == "" && inputSurname.value.length == 0){
        spanInfo.innerHTML = "Debe escribir los apellidos";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else if(!inputSurname.value.match(expresion)){
            spanInfo.innerHTML = "Introduce de 2 a 20 letras ";
            spanInfo.style.color = "rgb(102, 28, 35)";
            return false;
    }else{
        spanInfo.innerHTML = "";
        return true;
    }
}

function checkInputEmail (){
    let formu = document.forms["form_register"];
    let inputEmail = formu["email"];
    let spanInfo = inputEmail.nextElementSibling;
    let expresion = /\w+@\w+\.+[a-z]/;
    if(inputEmail.value == ""){
        spanInfo.innerHTML = "Debe poner una dirección de correo";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else if(!inputEmail.value.match(expresion)){
        spanInfo.innerHTML = "Debe poner una dirección de correo correcta";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else{
        spanInfo.innerHTML = "";
        return true;
    }

}
 

function checkInputPassword() {
    let formu = document.forms["form_register"];
    let valorInputPassword = formu["password"];
    let spanInfo = valorInputPassword.nextElementSibling;
    let expresion = /^([A-z]|[0-9]){4,10}$/;
    if (!valorInputPassword.value.match(expresion)) {
        spanInfo.innerHTML = "Debe introducir entre 4 y 10 letras o números";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    } else {
        spanInfo.innerHTML = "";
        return true;
    }

}


function checkInputPassword2() {
    let formu = document.forms["form_register"];
    let valorInputPassword2 = formu["password2"];
    let valorInputPassword = formu["password"];
    let spanInfo = valorInputPassword2.nextElementSibling;
    let expresion = /^([A-z]|[0-9]){4,10}$/;
    if (!valorInputPassword2.value.match(expresion)) {
        spanInfo.innerHTML = "Debe introducir entre 4 y 10 letras o números";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    } else if (valorInputPassword.value != valorInputPassword2.value) {
        spanInfo.innerHTML = "Las contraseñas no coinciden";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }
    else {
        spanInfo.innerHTML = "";
        return true;
    }
}

function validate(){
    let formOk = true;

    if(checkInputName() == false){
        formOk = false;
    }
    if(checkInputSurname() == false){
        formOk = false;
    }
    if(checkInputEmail() == false){
        formOk = false;
    }
    if(checkInputPassword2() == false){
        formOk = false;
    }
    return formOk;
}