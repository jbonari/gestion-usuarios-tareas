<h1>Gestion de usuarios</h1>

<a href="<?=base_url?>/usuario/alta" class="button button-small">Crear Ususario</a>

<?php if(isset($_SESSION['register']) && $_SESSION['register']=='completed'): ?>
    <strong class="alert_green">El usuario se ha creado correctamente</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register']!='completed'): ?>
    <strong class="alert_red">El usuario no se ha creado correctamente</strong>
<?php endif;?>
<?php Utils::deleteSession('usuario') ?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete']=='completed'): ?>
    <strong class="alert_green">El usuario se ha borrado correctamente</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete']!='completed'): ?>
    <strong class="alert_red">El usuario no se ha borrado</strong>
<?php endif;?>

<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('delete'); ?>

<table>
    <tr>
        <th>Nombre</th>
    </tr>
    <?php while ($user=$usuarios->fetch_object()): ?>
        <tr>
            <td><?= $user->nombre?></td>
            <td>
                <a href="<?=base_url?>usuario/editar&id=<?=$user->id?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>usuario/eliminar&id=<?=$user->id?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
