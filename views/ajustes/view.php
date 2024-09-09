<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="container">
        <h1>Detalles del Ajuste</h1>

        <p><strong>ID:</strong> <?= $ajuste['id'] ?></p>
        <p><strong>Empleado:</strong> <?= $ajuste['empleado_id'] ?></p>
        <p><strong>Fecha de Inicio:</strong> <?= $ajuste['fecha_ini'] ?></p>
        <p><strong>Fecha de Fin:</strong> <?= $ajuste['fecha_fin'] ?></p>

        <a href="<?= site_url('ajustes/edit/' . $ajuste['id']) ?>" class="btn btn-warning">Editar</a>
        <a href="<?= site_url('ajustes') ?>" class="btn btn-secondary">Regresar</a>
    </div>
</div>

<?php init_tail(); ?>