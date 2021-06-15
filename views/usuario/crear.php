<!--Esta vista es un claro ejemplo de reutilización de código, porque vamos a utilizar esta vista  para registrar un usuario nuevo y también para editar los datos de un usuario existente, evitando tener que hacer dos vistas por separadas-->
<!--Comprobación si existe la variable $editUser y si existe $user, eso significa que vamos a editar los datos de un usuario -->
<?php if(isset($editUser) && isset($user) && is_object($user)) : ?>
    <h1 class="form_title">M<span>ODIFICAR DATOS</span></h1>

    <!--Construimos la url_action del formulario para que utilice la acción saveUser del controlador usuario y le pasamos el id del usuario-->
    <?php $url_action= base_url."usuario/saveUser&id=".$user->id; ?>

    <?php if(isset($_SESSION['error_register']['save'])): ?>
                <strong class="error_register"><?=$_SESSION['error_register']['save']?></strong>

            <?php elseif(isset($_SESSION['error_register'])): ?>
                <ul>
                        <?php foreach ($_SESSION['error_register'] as $error) : ?>
                        <li><strong class="error_register"><?=$error?></strong></li>
                        <?php endforeach;?>
                </ul>
            <?php elseif(isset($_SESSION['register_complete'])): ?>               
                <strong class="register_complete"><?=$_SESSION['register_complete']?></strong>

    <?php endif; ?> 

<?php else: ?>

    <!--Si no existe la variable $editUser ni existe $user, entonces vamos a registar un nuevo usuario y mostrariamos el h1 FORMULARIO DE REGISTRO-->
        <h1 class="form_title">F<span>ORMULARIO DE REGISTRO</span></h1>
        <?php $url_action= base_url."usuario/saveUser"; ?>

        <?php if(isset($_SESSION['error_register']['save'])): ?>
            <strong class="error_register"><?=$_SESSION['error_register']['save']?></strong>

        <?php elseif(isset($_SESSION['error_register'])): ?>
            <ul>
                    <?php foreach ($_SESSION['error_register'] as $error) : ?>
                    <li><strong class="error_register"><?=$error?></strong></li>
                    <?php endforeach;?>
            </ul>
        <?php elseif(isset($_SESSION['register_complete'])): ?>               
            <strong class="register_complete"><?=$_SESSION['register_complete']?></strong>

        <?php endif; ?> 

<?php endif; ?>
                                <!--Vamos a reutilizar el formulario para hacer un registro nuevo y para editar los datos de un usuario existente en la base de datos.-->
    <form id="form_register" name="form_register" action=<?=$url_action?> method="POST" onsubmit="return validate();">

        <label for="name">Nombre</label>                                            <!--Si existe el usuario en la base de datos, vamos a ir recargando los input con sus datos.-->
        <input type="text" onblur="this.className = 'campo';checkInputName()"  value="<?=isset($user) && is_object($user) ? $user->nombre: '' ?>" name="name" id="name"  pattern="[A-Za-z ]{2,20}" title="Introduce de 2 a 20 letras ;" required autofocus /><span></span>

        <label for="surname">Apellidos</label>
        <input type="text" onblur="this.className = 'campo';checkInputSurname()"  value="<?=isset($user) && is_object($user) ? $user->apellidos: '' ?>" name="surname" id="surname" pattern="[A-Za-z ]{2,20}"  title="Introduce de 2 a 20 letras " required /><span></span> 

        <label for="email">Email</label>
        <input type="email" onblur="this.className = 'campo';checkInputEmail()"  value="<?=isset($user) && is_object($user) ? $user->email: '' ?>" name="email" id="email" title="Introduce una dirección de correo correcta;" required /><span></span> 

        <label for="password">Contraseña</label>
        <input type="password" onblur="this.className = 'campo';checkInputPassword()"  minlength="4" maxlength="10" name="password" id="password"  title="Escriba la contraseña  entre 4 y 10 letras o números;" required /><span></span>
    
        <label for="password2">Repita la contraseña</label>
        <input type="password" onblur="this.className = 'campo';checkInputPassword2()" minlength="4" maxlength="10" name="password2" id="password2"  title="Escriba la contraseña  entre 4 y 10 letras o números;" required /><span></span>  

    <input type="submit" value="Enviar" />

   
</form>

<?php Utils::deleteSession('error_register'); ?>
<?php Utils::deleteSession('register_complete'); ?>

 





