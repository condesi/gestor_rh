<div class="ui segment vertical">
    <div class="ui container">
        <div class="ui header block">
            <div class="ui breadcrumb">
                <a href="/GestorRRHH/" class="section"><i class="icon home "></i></a>
                <i class="right angle icon divider"></i>
                <a href="/GestorRRHH/nominas" class="section">Nominas</a>
                <i class="right angle icon divider"></i>
                <div class="section active">Generar Nomina</div>
            </div>
        </div>
        <h2 class="ui header">Datos de la nomina</h2>
        <div class="ui divider"></div>
        <?php 
        $msg =  $this->Session->flash();
        if($msg != ""){ 
        ?>
        <div class="ui message">
            <?php echo $this->Session->flash(); ?>
        </div>
        <?php } ?>
        <?php echo $nomina['Nomina']['MES'] . "&nbsp&nbsp&nbsp/&nbsp&nbsp&nbsp" . $nomina['Nomina']['AÑO'] . "&nbsp&nbsp&nbsp&nbsp&nbsp" . $nomina['Nomina']['QUINCENA'] . " Quincena"; ?>
        <div class="ui divider hidden"></div>   
        <div class="ui breadcrumb">
            <div class="section">
                <?php echo $this->Form->label('Fecha de Inicio'); ?>
                <?php echo fechaElegible($nomina['Nomina']['FECHA_INI']); ?>
            </div>
            <i class="right arrow icon divider"></i>
            <div class="active section">
                <?php echo $this->Form->label('Fecha de Finalizacion'); ?>
                <?php echo fechaElegible($nomina['Nomina']['FECHA_FIN']); ?>
            </div>
        </div>
        <h3 class="ui header">Resumen</h3>
        <div class="ui divider"></div>
        <div class="ui message info">
            <div class="ui divider hidden"></div>
            <?php
            $fijos = 0;
            $contra = 0;
            foreach ($nomina['Recibo'] as $emp) {
                if($emp['MODALIDAD']=='Fijo') {
                    $fijos++;
                }
                if($emp['MODALIDAD']=='Contratado') {
                    $contra++;
                }
            }

            if (empty($nomina['Recibo'])) {
                echo "Esta nomina no contiene informacion, proceda a la opcion Generar Nomina.";
            } else {
                if($nomina['Nomina']['BLOQUEAR']==1){
                    echo "Esta nomina ya no se puede modificar.";                    
                    echo "<br />";
                }
                echo "Fecha de elaboración: " . date('d-M-Y h:i:s a', strtotime($nomina['Nomina']['FECHA_ELA']));
                echo "<br />";
                echo "<br />";
                echo "Contiene: " . count($nomina['Recibo']) . " Empleados";
                echo "<br />";
                echo "Fijos: ".$fijos;
                echo "<br />";
                echo "Contratados: ".$contra;
            }
            ?>
            <div class="ui divider hidden"></div>
        </div>

        <h3 class="ui header">Acciones</h3>
        <div class="ui divider"></div>

        <div class="ui form">
            <?php echo $this->Form->create(false, array('target' => '_blank', 'url' => array('controller' => 'nominas', 'action' => 'mostrar'))); ?>
            <div class="field">
                <div class="three fields">
                    <div class="field">
                        <?php $options = array('1' => 'Empleado - Fijo', '2' => 'Obrero - Fijo', '3' => 'Contratado');
                        echo $this->Form->input('nomina_id', array('type' => 'hidden', 'value' => $nomina['Nomina']['id']));
                        echo $this->Form->input('PERSONAL', array('div' => false, 'label' => 'Personal', 'class' => 'ui dropdown search', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion')); 
                        ?>
                    </div>
                    <div class="field">
                        <?php $options = array('Nomina' => 'Nomina', 'Resumen' => 'Resumen de Nomina', 'Completo' => 'Completo');
                        
                        echo $this->Form->input('TIPO', array('div' => false, 'label' => 'Tipo', 'class' => 'ui dropdown', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion'));
                        ?>
                    </div>
                    <div class="field">
                        <?php 
                        $options = array('Pantalla' => 'Pantalla', 'Archivo' => 'Archivo');
                        echo $this->Form->input('VISUALIZAR', array('div' => false, 'label' => 'Visualizar', 'class' => 'ui dropdown', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion')); 
                        ?>
                    </div>
                </div>
            </div>
            <div class="ui divider hidden"></div>
            <div class="fiel">
                <div class="three fields">
                    <div class="field">
                        <button class="ui button teal" type="submit">Mostrar Nomina</button>
                    </div>
                    <div class="field">
                        <?php 
                        if($nomina['Nomina']['BLOQUEAR']==0){
                            echo $this->Html->link('Generar Nomina', array('action' => 'wizard'),array('class' => 'ui button primary')); 
                        }else{
                            echo $this->Html->link('Generar Nomina', array('action' => 'edit',$nomina['Nomina']['id']),array('class'=>'ui button primary disabled')); 
                        }
                        ?> 
                    </div>
                    <div class="field">
                        <?php 
                        if($nomina['Nomina']['BLOQUEAR']==0){
                            echo $this->Html->link('Bloquear Nomina', array('action' => 'bloquear',$nomina['Nomina']['id']), array('escape' => false, 'class' => 'ui button red'),sprintf('Esta seguro que desea bloquear esta Nomina?'));
                        }else{
                            echo $this->Html->link('Bloquear Nomina', array('action' => 'edit',$nomina['Nomina']['id']), array('class'=>'ui button red disabled'));
                        }?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>