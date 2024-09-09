<div class="box">
    <?php echo $this->Session->flash(); ?>
</div>
<div class="box">
    <div class="title"><h2>Datos de la Ausencia</h2>
        <?php echo $this->Html->image("title-hide.gif", array('class' => 'toggle')); ?>
    </div>
    <div class="content pages">
        <?php echo $this->Form->create('Ausencia', array('url' => array('controller' => 'ausencias', 'action' => 'edit_ausencia', $this->data['Ausencia']['id']))); ?>        
        <?php
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->input('empleado_id', array('type' => 'hidden'));
        // INI ROW
        echo "<div class='row'>";
        echo "<div style='float:left;width:40%'>";
        $options = array('Remunerada' => 'Remunerada', 'No Remunerada' => 'No Remunerada');
        echo $this->Form->input('TIPO', array('div' => false, 'label' => 'Tipo de Ausencia', 'class' => 'small', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion'));
        echo "</div>";

        echo "<div style='float:left;width:30%'>";
        echo $this->Form->input('FECHA', array('type' => 'text', 'div' => false, 'label' => 'Fecha', 'class' => 'datepicker dp-applied')) . "</br>";
        echo "</div>";
        echo "</div>";
        // END ROW

        echo "<div class='row'>";
        echo "<div style='float:left;width:40%'>";
        echo $this->Form->input('JUSTIFICACION', array('div' => false, 'label' => 'Justificacion'));
        echo "</div>";
        echo "</div>";
        // END ROW                                       
        ?>            	                      
    </div>
</div>

<div class="box">
    <div class="title"><h2>Acciones</h2>
        <?php echo $this->Html->image("title-hide.gif", array('class' => 'toggle')); ?>
    </div>
    <div class="content form">
        <div class="row">
            <div class="boton">
                <?php echo $this->Form->end('Guardar Cambios'); ?>            
            </div>
            <div class="boton">
                <?php echo $this->Html->link('Regresar', array('action' => 'edit', $this->data['Ausencia']['empleado_id'])); ?>
            </div>        
        </div>        
    </div>
</div>