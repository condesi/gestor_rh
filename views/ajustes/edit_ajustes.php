<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="container">
        <h1>Editar Ajuste</h1>

        <form action="<?= site_url('ajustes/save') ?>" method="post">
            <input type="hidden" name="id" value="<?= $ajuste['id'] ?>">
            <div class="form-group">
                <label for="empleado_id">Empleado</label>
                <input type="text" name="empleado_id" class="form-control" value="<?= $ajuste['empleado_id'] ?>" required>
            </div>
            <div class="form-group">
                <label for="ajuste_mes_inicio">Mes de Inicio</label>
                <input type="number" name="ajuste_mes_inicio" class="form-control" value="<?= $ajuste['ajuste_mes_inicio'] ?>" required>
            </div>
            <div class="form-group">
                <label for="ajuste_año_inicio">Año de Inicio</label>
                <input type="number" name="ajuste_año_inicio" class="form-control" value="<?= $ajuste['ajuste_año_inicio'] ?>" required>
            </div>
            <div class="form-group">
                <label for="quincena_inicio">Quincena de Inicio</label>
                <select name="quincena_inicio" class="form-control">
                    <option value="Primera" <?= $ajuste['quincena_inicio'] == 'Primera' ? 'selected' : '' ?>>Primera</option>
                    <option value="Segunda" <?= $ajuste['quincena_inicio'] == 'Segunda' ? 'selected' : '' ?>>Segunda</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ajuste_mes_fin">Mes de Fin</label>
                <input type="number" name="ajuste_mes_fin" class="form-control" value="<?= $ajuste['ajuste_mes_fin'] ?>" required>
            </div>
            <div class="form-group">
                <label for="ajuste_año_fin">Año de Fin</label>
                <input type="number" name="ajuste_año_fin" class="form-control" value="<?= $ajuste['ajuste_año_fin'] ?>" required>
            </div>
            <div class="form-group">
                <label for="quincena_fin">Quincena de Fin</label>
                <select name="quincena_fin" class="form-control">
                    <option value="Primera" <?= $ajuste['quincena_fin'] == 'Primera' ? 'selected' : '' ?>>Primera</option>
                    <option value="Segunda" <?= $ajuste['quincena_fin'] == 'Segunda' ? 'selected' : '' ?>>Segunda</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="<?= site_url('ajustes') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php init_tail(); ?>