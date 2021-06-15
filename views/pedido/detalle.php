<h1 class="form_title">D<span>ETALLES DEL PEDIDO</span></h1>


<?php if (isset($pedido)): ?>

        <?php if(isset($_SESSION['admin'])) : ?>
            <h3>Cambiar estado del pedido</h3>
            <form action="<?=base_url?>pedido/estado" method="POST">
                <input type="hidden" value="<?=$pedido->id?>" name="pedido_id" />
                <select name="estado">
                    <option value="confirm">Pendiente</option>
                    <option value="preparation">En Preparación</option>
                    <option value="ready">Preparado para enviar</option>
                    <option value="sended">Enviado</option>
                </select>
                <input type="submit" value="Cambiar estado"  />
            </form>
            <br/>
        <h3>Información del usuario</h3> 
    Nombre: <?=$user->nombre?><br/>
    Apellidos: <?=$user->apellidos?><br/>
    Email: <?=$user->email?><br/><br/>   
        <?php endif; ?>

    <h3>Dirección de envio</h3>
    Provincia: <?=$pedido->provincia?><br/>
    Localidad: <?=$pedido->localidad?><br/>
    Dirección: <?=$pedido->direccion?><br/><br/>

    <h3>Datos del pedido: </h3>
    Estado: <?=Utils::showStatus($pedido->estado)?><br/>
    Número de pedido: <?=$pedido->id?><br/>
    Coste total: <strong><?=$pedido->coste?> €</strong><br/><br/>

    <strong>Productos:</strong>

    <table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
        <?php while ($producto = $productos->fetch_object()): ?>

    <tr>
        <td>
                <?php if ($producto->imagen != null): ?>
                        <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class = "img_carrito" />
                    <?php else: ?>

                     <img src="<?=base_url?>assets/img/isolate.jpg"  class = "img_carrito" />
                <?php endif;?>
        </td>
        <td>
          <a href ="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
        </td>
        <td>
            <?=$producto->precio?>€
        </td>
        <td>
            <?=$producto->unidades?>

        </td>

    </tr>

        <?php endwhile; ?>
 </table>

<?php endif; ?> 
