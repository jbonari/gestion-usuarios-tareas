<?php if(isset($edit) && isset($user) && is_object($user))  : ?>
    <h1>Editar usuario <?= $user->nombre ?></h1>
    <?php $url_action=base_url."usuario/save&id=".$user->id;?>
<?php else: ?>
    <h1>Crear nuevo usuario</h1>
    <?php $url_action=base_url."usuario/save";?>
<?php endif;?>

<?php Utils::deleteSession('register');?>

<form action="<?= $url_action?>" method="POST" >

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?=isset($user) && is_object($user) ? $user->nombre : '' ?>" required/>

    <label for="password">Password</label>
    <input type="password" name="password" required />

    <?php if(isset($edit) && isset($user) && is_object($user)) : ?>
        <input type="submit" value="Modificar" />
    <?php else:?>
        <input type="submit" value="Dar de alta" />
    <?php endif;?>

</form>
