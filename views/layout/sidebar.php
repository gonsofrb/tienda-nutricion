 <!--BARRA LATERAL-->
 <aside id="lateral"> 
     
    <div id="login" class="block_aside">
        
     <!--Comprobamos si no existe una identificación válida, entonces volveremos a mostrar el formulario para loguearse-->   
     <?php if(!isset($_SESSION['identity'])): ?>   
            
         <h3>Entrar a la web</h3>
         <form action="<?=base_url?>usuario/login" method="post">
             <label for="email">Email</label>
             <input type="email" name="email" required="required" />
             <label for="password">Contraseña</label>
             <input type="password" name="password" required="required" />
             <input type="submit" value="Enviar" name="enviar" />
         </form>
         
            <ul>
                <li><a href="<?=base_url?>usuario/registro">Registrate aqui</a></li>
               <!-- <li><a href="#">¿Has olvidado la contraseña?</a></li>-->
            </ul>
           
     <?php else: ?> 
                <!--Si existe una identificación correcta, accedemos a sus datos nombre y apellidos y los mostrarmos en un h3-->
     <h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>

                <!--Si al identificarnos, somos un administrador..entonces se nos muestran las siguientes opciones.-->
             <?php if(isset($_SESSION['admin'])): ?>
            <ul> 

                <li><a href="<?=base_url?>categoria/index">Gestionar categorias</a></li><br/>
                <li><a href="<?= base_url?>producto/gestion">Gestionar productos</a></li><br/>
                <li><a href="<?=base_url?>pedido/gestion">Gestionar pedidos</a></li><br/>
            </ul>   
             <?php else: ?>

                <!--Si al identificarnos, somos un usuario normal, entonces nos apareceran las siguientes opciones.-->
                <div id="login" class="block_aside">
            <h3>Mi carrito--<i class="fas fa-shopping-cart"></i></h3>
                
            <ul>
                    <?php $stats = Utils::statsCarrito();?>
                <li><a href="<?=base_url?>carrito/index">Productos (<?=$stats['count']?>)</a></li><br/>
                <li><a href="<?=base_url?>carrito/index">Total:<?=$stats['total']?>€</a></li><br/>
                <li><a href="<?=base_url?>carrito/index">Ver el carrito</a></li><br/>
                <li><a href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a></li></br>
            </ul>

                </div>
            <?php endif; ?>
            <ul>
            <!--Estas opciones las he dejado que se muestren al administrador y a un usuario-->
                <li><a href="<?=base_url?>usuario/logout">Cerrar sesion</a></li><br/>
                <li><a href="<?=base_url?>usuario/editUser&id=<?=$_SESSION['identity']->id?>">Modificar datos personales</a></li>
            </ul> 
                   
    <?php endif; ?>

    <?php Utils::deleteSession('error_login');?>  
     </div>

 </aside>



 <!--CONTENIDO CENTRARL-->
 <div id="central">