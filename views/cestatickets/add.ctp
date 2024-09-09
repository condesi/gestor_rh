<div class="box">
    <?php echo $this->Session->flash(); ?>
</div>


<div class="box">
    <div class="title"><h2>Datos de la Nomina de Cestaticket</h2>
        <?php echo $this->Html->image("title-hide.gif", array('class' => 'toggle')); ?>
    </div>
    <div class="content form">
        <?php
        echo $this->Form->create('Cestaticket', array('url' => array('controller' => 'cestatickets', 'action' => 'add')));
        echo $this->Form->input('FECHA_ELA', array('type' => 'hidden', 'value' => date("Y-m-d H:i:s")));
        echo $this->Form->input('SUELDO_MINIMO', array('type'=>'hidden','value'=>0));

        echo "<div class='row'>";
        echo "<div style='float:left;width:30%;'>";
        $options = array('1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo', '4' => 'Abril', '5' => 'Mayo', '6' => 'Junio', '7' => 'Julio'
            , '8' => 'Agosto', '9' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');        
        echo $this->Form->input('CESTATICKET_MES', array('div' => false, 'label' => 'Mes', 'class' => 'small', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione el Opcion'));
        echo "</div>";

        echo "<div style='float:left;width:30%;'>";        
        echo $this->Form->input('CESTATICKET_AÑO', array('div' => false, 'label' => 'Año', 'class' => 'small'));
        echo "</div>";
        echo "</div>";
                
        echo "<div class='row'>";
        echo "<div style='float:left;width:30%;'>";        
        echo $this->Form->input('VALOR_DIARIO', array('div' => false, 'label' => 'Valor Diario  (UT 50%)', 'class' => 'small'));
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div style='float:left;width:30%;'>";
        
        
        echo "</div>";
        echo "</div>";
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
                <?php echo $this->Form->end('Agregar'); ?>                        
            </div>
            <div class="boton">
                <?php echo $this->Html->link('Regresar', array('action' => 'index')); ?>
            </div>
        </div> 
    </div>
</div>
</div>