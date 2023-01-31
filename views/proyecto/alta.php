<?php if(isset($edit) && isset($pro) && is_object($pro))  : ?>
    <h1>Editar proyecto <?= $pro->nombre ?></h1>
    <?php $url_action=base_url."proyecto/save&id=".$pro->id;?>
<?php else: ?>
    <h1>Crear nuevo proyecto</h1>
    <?php $url_action=base_url."proyecto/save";?>
<?php endif;?>


<div class="form_container">

    <form action="<?=$url_action?>" method="POST" >
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : '' ?>">

        <input type="submit" value="Guardar" />
    </form>

</div>
