<div class="box">
    <?php echo $this->Session->flash(); ?>
</div>

<div class="box">
    <div class="title"><h2>Datos de la Eventualidad</h2>
        <?php echo $this->Html->image("title-hide.gif", array('class' => 'toggle')); ?>
    </div>
    <div class="content form">
        <?php
        echo $this->Form->create('Eventualidad');
        echo "<div class='row'>";
        echo "<div style='float:left;width:50%'>";        
        echo $this->Form->input('NOMBRE', array('div' => false, 'label' => 'Nombre', 'class' => 'medium'));
        echo "</div>";
        echo "<div style='float:left;width:25%'>";        
        $options=array('0'=>'Seleccione una Opcion','Asignación'=>'Asignación','Deducción'=>'Deducción');
        echo $this->Form->input('TIPO', array('div' => false, 'label' => 'Tipo', 'class' => 'small','type'=>'select','options'=>$options));
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
