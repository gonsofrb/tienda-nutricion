


                   

<h1 class="form_title">F<span>ORMULARIO DE CONTACTO</span></h1>


  <form name="form_contact" id="form_contacto" action="" method="POST" onsubmit="return validate()" > 
    <label for="name" >Nombre:  <i class="fas fa-user-alt"></i></label>
    <input type="text"  onblur="this.className = 'campo';checkInputName2();" name="name" id="name"  pattern="[A-Za-z ]{2,15}"    title="Introduce de 2 a 15 letras sin espacios;" required  autofocus /><span></span>
   
    
    <label for="surname">Apellidos:  <i class="fas fa-user-alt"></i></label></label>
    <input type="text" onblur="this.className = 'campo';checkInputSurname2();" name="surname"  id="surname"  pattern="[A-Za-z ]{2,20}"    title="Introduce de 2 a 20 letras sin espacios;" required    /><span></span>
    

    <label for="email">Email:  <i class="fas fa-envelope"></i></label>
    <input type="email" onblur="this.className = 'campo';checkInputEmail2();"  name="email" id="email"  title="Introduce una dirección de correo correcta;" required  /><span></span>

    <label for="telephone">Teléfono:  <i class="fas fa-phone-square-alt"></i></label>
    <input type="tel"  onblur="this.className = 'campo';checkInputTelephone2();"  name="telephone"   id="telephone" pattern="[0-9]{9}";   title="Número de 9 cifras;" required  /><span></span>

    <label for="message">Mensaje:  <i class="fas fa-comment-dots"></i></label>
    <textarea  onblur="this.className = 'campo';checkInputMessage2();"  name="message" id="message" title="Escriba la consulta;" required  ></textarea><span></span>

   
   
    <input type="submit" name="send" value="Enviar" id="send"><br />
    <h5 class="notifCorreo"><?=$result; ?></h5>


</form>  


  