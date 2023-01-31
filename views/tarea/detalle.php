<h1>Detalle de la Tarea <strong><?=$tarea->nombre?></strong></h1>

<?php if(isset($tarea)) :?>
    <?php if(isset($_SESSION['admin'])):?>
        <h3>Cambiar estado de la tarea</h3>
        <form action="<?=base_url?>tarea/estado" method="POST">
            <input type="hidden" value="<?=$tarea->id?>" name="tarea_id"/>
            <select name="estado">
                <option value="1" <?=$tarea->estado=='confirm' ? 'selected' : '';?>>Pendiente</option>
                <option value="2" <?=$tarea->estado=='preparation' ? 'selected' : '';?>>En progreso</option>
                <option value="3" <?=$tarea->estado=='ready' ? 'selected' : '';?>>Finalizada</option>
            </select>
            <input type="submit" value="Cambiar estado" />
        </form>
        <br/>
    <?php endif;?>

    <table>
        <tr>
            <th>Id Tarea</th>
            <th>Nombre de la tarea</th>
            <th>Proyecto asignado</th>
            <th>Usuario asignado</th>
            <th>Estado</th>
        </tr>
            <tr>
                <td>
                    <!--idtarea-->
                    <?=$tarea->id?>
                </td>
                <td>
                    <!--nombre tarea-->
                    <?=$tarea->nombre?>
                </td>
                <td>
                    <!--nombre proyecto-->
                    <?=$tarea->proyecto?>
                </td>
                <td>
                    <!--nombre usuario-->
                    <?=$tarea->usuario?>
                </td>
                <!--estado-->
                <td>
                    <?=Utils::showStatus($tarea->estado)?><br>
                </td>
            </tr>
    </table>


<?php endif;?>
