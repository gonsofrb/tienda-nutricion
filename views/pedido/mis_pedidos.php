<?php if(isset($gestion)) : ?>
<h1 class="form_title">G<span>ESTIONAR PEDIDOS</span></h1>
<?php else: ?>
<h1 class="form_title">M<span>IS PEDIDOS</span></h1>
<?php endif; ?>
<table>
    <tr>
        <th>Nº Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Estado Pedido</th>
    </tr>
    <?php
    while($ped = $pedidos->fetch_object()) :

    ?>

	    <tr>
	        <td>
	          <a href="<?=base_url?>pedido/detalles&id=<?=$ped->id?>"><?=$ped->id?></a>
            </td>
            <td>
                <?=$ped->coste?> €
            </td>
            <td>
                <?=$ped->fecha?>
            </td>
            <td>
                <?=Utils::showStatus($ped->estado)?>
            </td>    
        </tr>
        <?php endwhile;?>
</table>