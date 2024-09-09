<div class="ui segment vertical very padded">
<div class="ui container">  
<div class="box">
    <?php echo $this->Session->flash(); ?>
</div>
<div class="box">
    <div class="title"><h2>Datos del Feriado</h2>
        <!-- <?php echo $this->Html->image("title-hide.gif", array('class' => 'toggle')); ?> -->
    </div>


<!-- <form action="" id="" method="post" accept-charset="utf-8" class="ui form">
  <div class="field">
    <div class="ui pointing below label">
      Día de Feriado
    </div>
    <br>
    <div class="two fields">
      <div class="field">
        <input type="date" name="FECHA" placeholder="dia">
      </div>
      <div class="field">
        <input type="text" name="DESCRIPCION" placeholder="Descripcion">
      </div>
    </div>
  </div>
</form> -->

    <div class="content form">
        <?php
        echo $this->Form->create('Feriado');
        echo "<div class='row'>";
        echo "<div style='float:left;width:20%'>";
        echo $this->Form->label('Dia Feriado');
        echo $this->Form->input('FECHA', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'datepicker dp-applied')) . "</br>";
        echo "</div>";
        echo "</div>";
        echo "<div class='row'>";
        echo "<div style='float:left;width:25%'>";
        echo $this->Form->label('Breve Descripcion');
        echo $this->Form->input('DESCRIPCION', array('div' => false, 'label' => false, 'class' => 'field'));
        echo "</div>";
        echo "</div>";
        ?>
    </div> 
</div>

<div class="box">
    <!-- <div class="title"><h2>Acciones</h2>
        <?php echo $this->Html->image("title-hide.gif", array('class' => 'toggle')); ?>
    </div> -->


    <form action="" id="" method="post" accept-charset="utf-8" class="ui form">
        <button class="ui button fluid teal" type="submit">Agregar</button>    
        <div class="boton">
        <?php echo $this->Html->link('Regresar', array('action' => 'index')); ?> 
        </div>           
    </form>

<!--     <div class="content form">            
        <div class="row">   
            <div class="boton">
                <?php echo $this->Form->end('Agregar'); ?>
            </div>
            <div class="boton">
                <?php echo $this->Html->link('Regresar', array('action' => 'index')); ?>
            </div>              
        </div>        
    </div> -->
</div>
    </div>
</div>