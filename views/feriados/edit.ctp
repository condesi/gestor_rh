<div class="ui segment vertical very padded">
<div class="ui container">  
<div class="box">
    <?php echo $this->Session->flash(); ?>
</div>
<div class="box">
    <div class="title"><h2>Modificar Feriado</h2>
        <!-- <?php echo $this->Html->image("title-hide.gif", array('class' => 'toggle')); ?> -->
    </div>
    <div class="content form">
        <?php
        echo $this->Form->create('Feriado');
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo "<div class='row'>";
        echo "<div style='float:left;width:20%'>";        
        echo $this->Form->input('FECHA', array('type' => 'text', 'div' => false, 'label' => 'Dia Feriado', 'class' => 'datepicker dp-applied')) . "</br>";
        echo "</div>";
        echo "</div>";
        echo "<div class='row'>";
        echo "<div style='float:left;width:25%'>";        
        echo $this->Form->input('DESCRIPCION', array('div' => false, 'label' => 'Breve Descripcion', 'class' => 'medium'));
        echo "</div>";
        echo "</div>";                        
        ?>
    </div>
</div>

<div class="box">

    <form action="" id="" method="post" accept-charset="utf-8" class="ui form">
    <button class="ui button fluid teal" type="submit">Guardar Cambios</button>    
    <div class="boton">
    <?php echo $this->Html->link('Regresar', array('action' => 'index')); ?> 
    </div>           
    </form>


    <!-- <div class="title"><h2>Acciones</h2>
        <?php echo $this->Html->image("title-hide.gif", array('class' => 'toggle')); ?>
    </div> -->
<!--     <div class="content form">
        <div class="row">
            <?php echo $this->Form->end('Guardar Cambios'); ?>
        </div>
        <div class="row boton">
            <div class="boton">
                <?php echo $this->Html->link('Regresar', array('action' => 'index')); ?>
            </div>              
        </div> 
    </div> -->
</div>
   </div>
</div>