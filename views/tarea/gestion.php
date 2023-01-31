<a href="<?= base_url ?>tarea/alta" class="button button-small">Crear Tarea</a>

<?php if (isset($_SESSION['tarea_alta']) && $_SESSION['tarea_alta'] == 'completed'): ?>
    <strong class="alert_green">Tarea añadida correctamente</strong>
<?php elseif (isset($_SESSION['tarea_alta']) && $_SESSION['tarea_alta'] == 'failed'): ?>
    <strong class="alert_red">La tarea no se ha podido añadir, introduce bien los datos</strong>
<?php endif; ?>

<?php Utils::deleteSession('tarea_alta'); ?>


<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'completed'): ?>
    <strong class="alert_green">La tarea se ha borrado correctamente</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'completed'): ?>
    <strong class="alert_red">El tarea no se ha borrado</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>

<?php if (isset($gestion)): ?>
    <h1>Gestionar tareas</h1>
<?php else: ?>
    <h1>Mis tareas</h1>
<?php endif; ?>
<table>
    <tr>
        <th>Id Tarea</th>
        <th>Nombre de la tarea</th>
        <th>Usuario asignado</th>
        <th>Proyecto asignado</th>
        <th>Estado</th>
        <th>Opciones</th>
    </tr>
    <?php while ($tar = $tareas->fetch_object()): ?>
        <tr>
            <td>
                <!--idtarea-->
                <a href="<?= base_url ?>tarea/detalle&id=<?= $tar->id ?>"><?= $tar->id ?></a>
            </td>
            <td>
                <!--nombre tarea-->
                <?= $tar->nombre ?>
            </td>
            <td>
                <!--nombre usuario-->
                <?= $tar->usuario ?>
            </td>
            <td>
                <!--nombre proyecto-->
                <?= $tar->proyecto ?>
            </td>
            <!--estado-->
            <td>
                <?= Utils::showStatus($tar->estado) ?><br>
            </td>
            <!--botones-->
            <td>
                <a href="<?= base_url ?>tarea/editar&id=<?= $tar->id ?>" class="button button-gestion">Editar</a>
                <a href="<?= base_url ?>tarea/eliminar&id=<?= $tar->id ?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>

    <?php endwhile; ?>
</table>
