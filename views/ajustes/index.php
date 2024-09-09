<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="container">
        <h1>Ajustes</h1>
        <a href="<?= site_url('ajustes/add') ?>" class="btn btn-primary">Agregar Ajuste</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empleado</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ajustes)) : ?>
                    <?php foreach ($ajustes as $ajuste) : ?>
                        <tr>
                            <td><?= $ajuste['id'] ?></td>
                            <td><?= $ajuste['empleado_id'] ?></td>
                            <td><?= $ajuste['fecha_ini'] ?></td>
                            <td><?= $ajuste['fecha_fin'] ?></td>
                            <td>
                                <a href="<?= site_url('ajustes/edit/' . $ajuste['id']) ?>" class="btn btn-warning">Editar</a>
                                <a href="<?= site_url('ajustes/delete/' . $ajuste['id']) ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este ajuste?');">Eliminar</a>
                                <a href="<?= site_url('ajustes/view/' . $ajuste['id']) ?>" class="btn btn-info">Ver</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">No hay ajustes disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php init_tail(); ?>