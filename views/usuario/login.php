<?php if(isset($_SESSION['identity'])): ?>
<h1>Bienvenido <?=$_SESSION['identity']->nombre?></h1>
<?php endif;?>

<div id="login" class="block_aside">

    <?php if(!isset($_SESSION['identity'])): ?>
        <h3>Entrar a la web</h3>
        <form action="<?=base_url?>usuario/login" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <input type="submit" value="Enviar">
        </form>
    <?php else:?>
        <h3>Usuario identificado correctamente </h3>
    <?php endif;?>

</div>
