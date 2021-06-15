<h1 class="form_title">A<span>LGUNOS DE NUESTROS PRODUCTOS INTERESANTES</span></h1>

<?php while ($product = $productos->fetch_object()): ?>

        <div class="product">
          <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
            <?php if ($product->imagen != null): ?>

                <img src="<?=base_url?>uploads/images/<?=$product->imagen?>" />
            <?php else: ?>

                <img src="<?=base_url?>assets/img/isolate.jpg" />
            <?php endif;?>

                <h2><?=$product->nombre?></h2>       
            </a>     
                <?php if($product->stock != 0): ?>
            <p><?=$product->precio?>€</p>
                <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
                <?php else: ?>
                <p class="price nostock"><?=$product->precio?>€</p>
                <a href="#"  class="button button-red">No disponible</a>
            <?php endif; ?>

        </div>
<?php endwhile;?>
