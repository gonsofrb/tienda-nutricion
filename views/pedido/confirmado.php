<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
    <h1 class="form_title">T<span>U PEDIDO SE HA CONFIRMADO</span></h1>
        <strong style="color:green">Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria 
         o ingreso en cuenta con el coste del pedido, será procesado y enviado.</strong><br/><br/>

        <table>
            <tr>
                <th>BANCO</th>
                <th>IBAN</th>
                <th>ENTIDAD</th>
                <th>OFICINA</th>
                <th>DIGITO CONTROL</th>
                <th>CUENTA</th>
            </tr>
            <tr>
                <td>Caixabank</td>
                <td>ES5466210034554323456765</td>
                <td>1410</td>
                <td>0432</td>
                <td>20</td>
                <td>2345678976</td>
            </tr>
            <tr>
               <td>Banco Santander</td>
               <td>ES5433212345603443256765</td>
               <td>1510</td>
               <td>0032</td>
                <td>30</td>
               <td>3456321763</td>
            </tr>
            <tr>
                <td>Ibercaja Banco</td>
                <td>ES4865112301210033234565</td>
                <td>1210</td>
                <td>0532</td>
                <td>40</td>
                <td>3452210763</td>
            </tr>
            <tr>
                <td>Banco Sabadell</td>
                <td>ES4827620651121200332345</td>
                <td>1610</td>
                <td>0411</td>
                <td>50</td>
                <td>3452700763</td>
            </tr>
            <tr>
                <td>BBVA</td>
                <td>ES4825429900766112103323</td>
                <td>1710</td>
                <td>0482</td>
                <td>60</td>
                <td>3450702163</td>
            </tr>

        </table>    
    <br />
    <?php if (isset($pedido)): ?>
    <h3>Datos del pedido:</h3><br/>


    Número de pedido:<?=$pedido->id?><br/>
    Coste total:<?=$pedido->coste?>€<br/>
    Productos:

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

        <?php endwhile;?>

        </table>
    <?php endif;?>

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>

    <h1>Tu pedido no ha podido procesarse</h1>

<?php endif;?>