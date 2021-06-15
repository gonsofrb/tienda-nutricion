<!--Utilizamos esta vista para guardar un producto nuevo y para guardar un producto ya existente, evitando tener que crear dos vistas por separado. -->

<!--Comprobamos si existe la variable edit,entonces estaríamos utilizando la accion editar, por lo tanto si existe $pro, significa que estamos editando un producto existente, y muestra por pantalla un h1 Editar producto.
En el formulario, al existir $pro, podemos ir cargando los input con los valores del producto.-->
<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>

    <h1 class="form_title">E<span>DITAR PRODUCTO: </span><?=$pro->nombre?></h1>
     <!--en $url_action, vamos montando la url donde queremos que se envíe los datos del formulario dependiendo si queremos guardar un producto existente, en tal caso le pasamos el id del producto que queremos guardar o si queremos guardar un producto nuevo. -->
    <?php $url_action =base_url."producto/save&id=".$pro->id;?>

<?php else: ?>

<!--Si no exite $edit, ni $pro, signifca que vamos a crear un producto nuevo, mostrando un mensaje diferente al anterior.-->
    <h1 class="form_title">C<span>REAR NUEVO PRODUCTO</span></h1>
    <?php $url_action = base_url."producto/save";?>
       
<?php endif; ?>

<div class="form_container">
    
    
    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
                                            <!--Si existe $pro y es un objeto, accedemos a la propiedad nombre y ponemos su valor en el input -->
        <input type="text" name="nombre" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : '' ?>" />

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"><?=isset($pro) && is_object($pro) ? $pro->descripcion : '' ?></textarea >

        <label for="precio">Precio</label>
        <input type="number" step="0.01" name="precio" value="<?=isset($pro) && is_object($pro) ? $pro->precio : '' ?>"/>

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?=isset($pro) && is_object($pro) ? $pro->stock : '' ?>"/>

        <label for="categoria">Categoria</label>
        <?php $categorias = Utils::showCategorias(); ?>
        <select name="categoria">
            <?php while($cat = $categorias->fetch_object()) :?>
            <option value="<?=$cat->id?>"<?=isset($pro) && is_object($pro) &&  $cat->id == $pro->categoria_id ? 'selected' : ''; ?>>
                <?=$cat->nombre?>
            </option>
            <?php endwhile; ?>
        </select>

        <label for="imagen">Imagen</label>

        <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)) : ?>
        <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>">
        <?php endif; ?>    
        <input type="file" name="imagen" />

        <input type="submit" value="Guardar" />

    </form>
</div>
