
function checkInputName2 (){
    let formu = document.forms["form_contact"];
    let inputName = formu["name"];
    let spanInfo = inputName.nextElementSibling;
    let expresion = /[A-Za-z ]{2,15}/;
    if(inputName.value == ""|| inputName.value == null){
        spanInfo.innerHTML = "Debe escribir un nombre.";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else if(!inputName.value.match(expresion)){
        spanInfo.innerHTML = "Introduce de 2 a 15 letras.";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else{
        spanInfo.innerHTML = "";
        return true;
    }
        
    

}

function checkInputSurname2 (){
    let formu = document.forms["form_contact"];
    let inputSurname = formu["surname"];
    let spanInfo = inputSurname.nextElementSibling;
    let expresion = /[A-Za-z ]{2,20}/;
    if(inputSurname.value == "" || inputSurname.value == null){
        spanInfo.innerHTML = "Debe escribir los apellidos.";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else if(!inputSurname.value.match(expresion)){
            spanInfo.innerHTML = "Introduce de 2 a 20 letras.";
            spanInfo.style.color = "rgb(102, 28, 35)";
            return false;
    }else{
        spanInfo.innerHTML = "";
        return true;
    }
}

function checkInputEmail2 (){
    let formu = document.forms["form_contact"];
    let inputEmail = formu["email"];
    let spanInfo = inputEmail.nextElementSibling;
    let expresion = /\w+@\w+\.+[a-z]/;
    if(inputEmail.value == ""){
        spanInfo.innerHTML = "Debe poner una dirección de correo.";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else if(!inputEmail.value.match(expresion)){
        spanInfo.innerHTML = "Debe poner una dirección de correo correcta.";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else{
        spanInfo.innerHTML = "";
        return true;
    }

}
 
function checkInputTelephone2(){
    let formu = document.forms["form_contact"];
    let inputTelephone = formu["telephone"];
    let spanInfo = inputTelephone.nextElementSibling;
    let expresion = /[0-9]{9}/;
    if(inputTelephone.value == ""){
        spanInfo.innerHTML = "Debe escribir un telefono de contacto.";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else if(isNaN(inputTelephone.value)){
        spanInfo.innerHTML = "No se permiten letras o caracteres.";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else if(!inputTelephone.value.match(expresion)){
        spanInfo.innerHTML = "Debe escribir 9 números.";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else{
        spanInfo.innerHTML = "";
        return true;
    }
}

function checkInputMessage2(){
    let formu = document.forms["form_contact"];
    let inputMessage = formu["message"];
    let spanInfo = inputMessage.nextElementSibling;
    if(inputMessage.value == ""){
        spanInfo.innerHTML = "Debe escribir la consulta.";
        spanInfo.style.color = "rgb(102, 28, 35)";
        return false;
    }else{
       spanInfo.innerHTML = "";
        return true;
    }
}


function validate(){
    let formOK = true;
if(checkInputName2() == false){
    formOK = false;
}
if(checkInputSurname2() == false){
    formOK = false;
}
if(checkInputEmail2() == false){
    formOK = false;
}
if(checkInputTelephone2() == false){
    formOK = false;
}
if(checkInputMessage2() == false){
    formOK = false;
}
  return formOK;
}











