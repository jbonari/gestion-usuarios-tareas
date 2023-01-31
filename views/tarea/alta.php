<?php if(isset($edit) && isset($tar) && is_object($tar))  : ?>
    <h1>Editar tarea <?= $tar->nombre ?></h1>
    <?php $url_action=base_url."tarea/save&id=".$tar->id;?>
<?php else: ?>
    <h1>Crear nueva tarea</h1>
    <?php $url_action=base_url."tarea/save";?>
<?php endif;?>

<?php Utils::deleteSession('tarea_alta');?>

<form action="<?=$url_action?>" method="POST" >

    <label for="nombre">Nombre de la tarea</label>
    <input type="text" name="nombre"  required/>

    <label for="id_proyecto">Seleccione un proyecto existente</label>
    <select name="id_proyecto" id="id_proyecto" required>
        <?php $proyectos ?>
        <?php while($pro=$proyectos->fetch_object()): ?>
            <option value="<?=$pro->id?>"><?=$pro->nombre?></option>
        <?php endwhile;?>
    </select>

    <label for="id_usuario">Seleccione un usuario existente</label>
    <select name="id_usuario" id="id_usuario" required>
        <?php $usuarios ?>
        <?php while($user=$usuarios->fetch_object()): ?>
            <option value="<?=$user->id?>"><?=$user->nombre?></option>
        <?php endwhile;?>
    </select>

    <input type="submit" value="Añadir tarea" />

</form>

