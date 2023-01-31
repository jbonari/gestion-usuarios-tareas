<h1>Gestion de proyectos</h1>

<a href="<?=base_url?>/proyecto/alta" class="button button-small">Crear Proyecto</a>

<?php if(isset($_SESSION['proyecto']) && $_SESSION['proyecto']=='completed'): ?>
    <strong class="alert_green">El proyecto se ha creado correctamente</strong>
<?php elseif (isset($_SESSION['proyecto']) && $_SESSION['proyecto']!='completed'): ?>
    <strong class="alert_red">El proyecto no se ha creado correctamente</strong>
<?php endif;?>
<?php Utils::deleteSession('proyecto') ?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete']=='completed'): ?>
    <strong class="alert_green">El proyecto se ha borrado correctamente</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete']!='completed'): ?>
    <strong class="alert_red">El proyecto no se ha borrado</strong>
<?php endif;?>
<?php Utils::deleteSession('delete'); ?>

<table>
    <tr>
        <th>Nombre</th>
    </tr>
    <?php while ($proy=$proyectos->fetch_object()): ?>
        <tr>
            <td><?= $proy->nombre?></td>
            <td>
                <a href="<?=base_url?>proyecto/editar&id=<?=$proy->id?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>proyecto/eliminar&id=<?=$proy->id?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

