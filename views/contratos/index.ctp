<div class="ui segment vertical very padded">
<div class="ui container">  
<div class="box">
    <div class="title"><h2>Contratos</h2></div>
    <div class="content pages">        
        <div class="row">
            <?php
            echo $this->Form->create(false, array('url' => '/contratos/index'));
            echo "<div>";
            echo "<div style='float:left;width:30%;'>";
            $options = array('0' => 'Seleccione una opcion', '1' => 'Identificación', '2' => 'Nombre','3'=>'Apellido');
            echo $this->Form->label('Opción');                        
            echo $this->Form->input('Fopcion', array('div' => false, 'label' => false, 'class' => 'small', 'type' => 'select', 'options' => $options));
            echo "</div>";
            echo "<div style='float:left;width:20%'>";
            echo $this->Form->label('Busqueda');            
            echo $this->Form->input('valor', array('div' => false, 'label' => false, 'class' => 'small'));
            echo "</div>";
            echo "<div style='float:left;width:25%;padding-top:16px'>";
            echo $this->Form->End('Buscar');
            echo "</div>";
            echo "</div>";
            ?>
        </div>
        <div class="box"></div>
        <table cellpadding="0" cellspacing="0" class="ui celled table">
            <thead>
                <tr>
                    <th></th>  
                    <th style="width:10%; text-align: center"><?php echo $this->Paginator->sort('Cedula', 'CEDULA'); ?></th>
                    <th style="width:20%"><?php echo $this->Paginator->sort('Nombre(s)', 'Empleado.NOMBRE'); ?></th>                    
                    <th style="width:20%"><?php echo $this->Paginator->sort('Apellido(s)', 'Empleado.APELLIDO'); ?></th>                    
                    <th style="width:10%"><?php echo $this->Paginator->sort('Fecha Ingreso', 'Empleado.INGRESO'); ?></th>                    
                    <th style="width:15%">Cargo</th>
                    <th style="width:20%">Departamento</th>
                    <th style="width:5%;text-align: center" class="actions">Contratos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($empleados as $empleado):
                    $class = ' class="even"';
                    if ($i++ % 2 == 0) {
                        $class = ' class="odd"';
                    }
                    ?>
                    <tr<?php echo $class; ?>>
                        <td></td>
                        <td style="text-align: right;"><?php echo $empleado['Empleado']['CEDULA']; ?></td>                        
                        <td><?php echo $empleado['Empleado']['NOMBRE']; ?></td>                        
                        <td><?php echo $empleado['Empleado']['APELLIDO']; ?></td>
                        <td><?php echo $empleado['Empleado']['INGRESO']; ?></td>                                                
                        <td><?php if(!empty($empleado['Contrato']['0'])){
                                    echo $empleado['Contrato']['0']['Cargo']['NOMBRE'];
                                  }else{
                                    echo "Inactivo";  
                                  }?>
                        </td>
                        <td><?php if(!empty($empleado['Contrato']['0'])){
                                    echo $empleado['Contrato']['0']['Departamento']['NOMBRE'];
                                  }else{
                                    echo "Inactivo";  
                                  }?>
                        </td>                        
                        <td class="actions">
                            <?php                            
                            echo $this->Html->image("Button Add.png", array("alt" => "Agregar", 'title' => 'Agregar', 'width' => '18', 'heigth' => '18', 'url' => array('action' => 'edit', $empleado['Empleado']['id'])));                            
                            ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pages-bottom">
            <div class="actionbox">
                <?php
                echo $this->Paginator->counter(array('format' => 'Actualmente existen %count% empleado(s) en el sistema'));
                ?>
            </div>
            <div class="pagination">
                <?php echo $this->Paginator->prev(null, array(), null, array('class' => 'disabled')); ?>
                <?php echo $this->Paginator->numbers(array('class' => 'disabled', 'separator' => '')); ?>
                <?php echo $this->Paginator->next(null, array(), null, array('class' => 'disabled')); ?>
            </div>
        </div>        
    </div>
</div>
</div>
</div>