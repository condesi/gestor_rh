<div class="ui segment vertical">
    <div class="ui container">
        <div class="ui header block">
            <div class="ui breadcrumb">
                <a href="/GestorRRHH/" class="section"><i class="icon home "></i></a>
                <i class="right angle icon divider"></i>
                <div class="section active">Personal</div>
            </div>
        </div>
        <h1 class="ui header">Listado de Personal</h1>
        <div class="ui divider"></div>
        <?php $msg = $this->Session->flash(); ?>
        <?php if($msg != "") { ?>
        <div class="ui positive message">
            <?php echo $msg; ?>
        </div>
        <?php }?>
        <!-- Accion buscar -->

        <form  class="ui form " action="/GestorRRHH/empleados" id="indexForm" method="post" accept-charset="utf-8">
            <input type="hidden" name="_method" value="POST">

            <div class="field">

                <div class="four fields">
                    <div class="field">
                        <label>Campo</label>
                        <select name="data[Fopcion]" class="ui search dropdown" id="Fopcion">
                            <option value="0">Seleccione una opcion</option>
                            <option value="1">Identificación</option>
                            <option value="2">Nombre</option>
                            <option value="3">Apellido</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Busqueda</label>
                        <input type="text" name="shipping[last-name]" placeholder="Buscar...">
                    </div>
                    <div class="field">
                        <label>-</label>
                        <input type="submit" class="ui button" value="Buscar">
                    </div>
                    <div class="field">
                        <label>-</label>
                        <a class="ui button teal" href="/GestorRRHH/empleados/add">Nuevo Empleado</a>
                    </div>
                </div>
            </div>

        </form>


        <table class="ui ustackable celled table">
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombres</th>
                    <th>Grupo</th>
                    <th>Cargo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($empleados) > 0 ){
                    $i = 0;
                    foreach ($empleados as $empleado):
                    $class = ' class="even"';
                    if ($i++ % 2 == 0) {
                        $class = ' class="odd"';
                    }
                    if (!empty($empleado['Contrato']['0'])) {
                        if ($empleado['Contrato']['0']['MODALIDAD'] == 'Contratado') {
                            $carg = "CONTRATADO";
                        } else {
                            $carg = $empleado['Contrato']['0']['Cargo']['NOMBRE'];
                        }
                        $hoy = date("d-m-Y");
                        $fecha = $empleado['Contrato']['0']['FECHA_FIN'];                        
                        if ($fecha != null) {
                            if (compara_fechas($hoy, $fecha) > 0) {
                                $carg = "Despedido / Renuncia";
                            } else {
                                $carg = $empleado['Contrato']['0']['Cargo']['NOMBRE'];
                            }
                        } 
                    } else {
                        $carg = "Sin Contrato";
                    }
                ?>
                <tr<?php echo $class; ?>>                     
                    <td style="text-align: right"><?php echo $empleado['Empleado']['CEDULA']; ?></td>
                    <td><?php echo normalizarPalabra($empleado['Empleado']['APELLIDO'] . " " . $empleado['Empleado']['NOMBRE']); ?></td>                        
                    <td style="text-align: left"><?php echo $empleado['Grupo']['NOMBRE']; ?></td>
                    <td style="text-align: left"><?php echo normalizarPalabra($carg); ?></td>                                                                        
                    <td class="actions">
                        <?php
                    /*echo $this->Html->image("Contact.png", array("alt" => "Contratos", 'width' => '18', 'heigth' => '18', 'title' => 'Contratos del Empleado', 'url' => array('controller' => 'contratos', 'action' => 'edit', $empleado['Empleado']['id'])));                            
                    echo $this->Html->image("file_search.png", array("alt" => "Consultar", 'width' => '18', 'heigth' => '18', 'title' => 'Consultar Empleado', 'url' => array('action' => 'view', $empleado['Empleado']['id'])));*/
                    echo $this->Html->image("file_edit.png", array("alt" => "Modificar", 'title' => 'Modificar Empleado', 'width' => '18', 'heigth' => '18', 'url' => array('action' => 'edit', $empleado['Empleado']['id'])));
                    echo $this->Html->link($this->Html->image("file_delete.png", array('alt' => 'delete', 'title'=>'Eliminar Empleado','height' => '18', 'width' => '18')), array('controller' => 'Empleados', 'action' => 'delete', $empleado['Empleado']['id']), array('escape' => false), sprintf('Esta seguro que desea eliminar a este Empleado?'));
                        ?>
                    </td>
                </tr>
                <?php 
                    endforeach; 
                }else{
                    echo "<tr><td cols='5''>No se encontraron registros...</td></tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">
                        <?php echo $this->Paginator->prev(null, array(), null, array('class' => 'disabled')); ?>
                        <?php echo $this->Paginator->numbers(array('class' => 'disabled', 'separator' => '')); ?>
                        <?php echo $this->Paginator->next(null, array(), null, array('class' => 'disabled')); ?>
                        <div class="ui pagination menu">
                            <a class='item' href=''>1</a>
                        </div>
                    </th>
                    <th>
                        <?php
                        echo $this->Paginator->counter(array('format' => 'Mostrando %current% Empleado(s), de un total de  %count% Empleados'));
                        ?>

                    </th>
                </tr>
            </tfoot>
        </table>
    </div>


</div>
