
<h1>Mis tareas</h1>

<table>
    <tr>
        <th>Id Tarea</th>
        <th>Nombre de la tarea</th>
        <th>Proyecto asignado</th>
        <th>Estado</th>
    </tr>
    <?php while($tar=$tareas->fetch_object()):?>
        <tr>
            <td>
                <!--idtarea-->
                <a href="<?=base_url?>tarea/detalle&id=<?=$tar->id?>"><?=$tar->id?></a>
            </td>
            <td>
                <!--nombre tarea-->
                <?=$tar->nombreTar?>
            </td>
            <td>
                <!--nombre proyecto-->
                <?=$tar->nombrePro?>
            </td>
            <!--estado-->
            <td>
                <?=Utils::showStatus($tar->estado)?><br>
            </td>
        </tr>

    <?php endwhile;?>
</table>
