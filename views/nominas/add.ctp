<div class="ui segment vertical ">
    <div class="ui container"> 
        <div class="ui header block">
            <div class="ui breadcrumb">
                <a href="/GestorRRHH/" class="section"><i class="icon home "></i></a>
                <i class="right angle icon divider"></i>
                <a href="/GestorRRHH/nominas" class="section">Nominas</a>
                <i class="right angle icon divider"></i>
                <div class="section active">Nueva nomina</div>
            </div>
        </div>
        <h1 class="ui header">Parametros para la nomina</h1>
        <div class="ui divider"></div>
        <div class="box">
            <?php echo $this->Session->flash(); ?>    
        </div>


        <div class="ui form container text segment ">
            <?php 
            echo $this->Form->create('Nomina', array('url' => array('controller' => 'nominas', 'action' => 'add')));
            echo $this->Form->input('FECHA_ELA', array('type' => 'hidden', 'value' => date("Y-m-d H:i:s"))); 
            ?>
            <div class="field">
                <div class="two fields">
                    <div class="field">
                        <?php 
                        $options = 
                            array('1' => 'Enero', 
                                  '2' => 'Febrero', 
                                  '3' => 'Marzo', 
                                  '4' => 'Abril', 
                                  '5' => 'Mayo', 
                                  '6' => 'Junio', 
                                  '7' => 'Julio',
                                  '8' => 'Agosto', 
                                  '9' => 'Septiembre', 
                                  '10' => 'Octubre', 
                                  '11' => 'Noviembre', 
                                  '12' => 'Diciembre');
                        echo $this->Form->label('Mes: ');
                        echo $this->Form->input('NOMINA_MES', array('div' => false, 'label' => false, 'class' => 'ui selection dropdown', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione el mes del año'));
                        ?>
                    </div>
                    <div class="field">
                        <?php 
                        echo $this->Form->label('A&Ntilde;o');
                        echo $this->Form->input('NOMINA_AÑO', array('div' => false, 'label' => false, 'class' => 'small')); 
                        ?>
                    </div>
                </div>
            </div>
            <div class="field">
                <?php
                $options = array('Primera' => 'Primera', 'Segunda' => 'Segunda');
                echo $this->Form->input('QUINCENA', array('div' => false, 'label' => 'Quincena', 'class' => 'small', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una opcion'));
                ?>
            </div>
            <div class="field">
                <?php
                echo $this->Form->input('SUELDO_MINIMO', array('div' => false, 'label' => 'Sueldo Minimo', 'class' => 'small'));
                ?>
            </div>
            <button class="ui button fluid teal" type="submit">Agregar</button> 
        </div>    

    </div>
</div>
