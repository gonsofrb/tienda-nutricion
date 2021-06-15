<h1 class="form_title">G<span>ESTIONAR PRODUCTOS</span></h1>


<a href="<?=base_url?>producto/crear" class="button button-small">Crear producto</a>

<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <strong class="alert_green">El producto se ha creado correctamente</strong>
 <?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
    <strong class="alert_red">El producto  NO se ha creado correctamente</strong>
<?php endif;?>
<?php Utils::deleteSession('producto');?>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green">El producto se ha borrado correctamente</strong>
 <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
    <strong class="alert_red">El producto  NO se ha borrado correctamente</strong>
<?php endif;?>
<?php Utils::deleteSession('delete');?>


<table> 
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
            <th>PRECIO</th>
            <th>STOCK</th>
            <th>ACCIONES</th>
        </tr>
    <?php while ($product = $productos->fetch_object()): ?>
        <tr>
            <td><?=$product->id;?></td>
            <td><?=$product->nombre;?></td>
            <td><?=$product->descripcion;?></td>
            <td><?=$product->precio;?>€</td>
            <td><?=$product->stock;?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$product->id?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$product->id?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile;?>
</table>





















