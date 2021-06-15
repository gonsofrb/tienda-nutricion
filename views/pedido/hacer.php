<?php if (isset($_SESSION['identity'])): ?>
    <h1 class="form_title">H<span>ACER PEDIDO</span></h1>
    <p>
        <a href="<?=base_url?>carrito/index">Ver los productos y el precio del pedido</a>
    </p>
    <br/>
        <h3>Dirección para el envio:</h3>
        <form action="<?=base_url?>pedido/add" method="POST">
            <label for="provincia">Provincia</label>
            <input type="text" onblur="this.className = 'campo';" name="provincia" required>

            <label for="localidad">Localidad</label>
            <input type="text" onblur="this.className = 'campo';" name="localidad" required>

            <label for="direccion">Direccion</label>
            <input type="text" onblur="this.className = 'campo';" name="direccion" required>

            

            <input type="submit" value="Confirmar Pedido">
        </form>

<?php else: ?>
    <h1 class="form_title">N<span>ECESITAS ESTAR IDENTIFICADO PARA REALIZAR LA COMPRA</span></h1>
    <h3>Registrate o identificate para poder realizar la compra.</h3>
<?php endif;?>
