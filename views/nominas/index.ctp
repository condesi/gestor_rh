<div class="ui segment vertical">
    <div class="ui container">  
        <div class="ui header block">
            <div class="ui breadcrumb">
                <a href="/GestorRRHH/" class="section"><i class="icon home "></i></a>
                <i class="right angle icon divider"></i>
                <div class="section active">Nomina</div>
            </div>
        </div>
        <h1 class="ui header">Nominas de empleados</h1>
        <div class="ui divider"></div>
        <div class="box">
            <?php echo $this->Session->flash(); ?>
        </div>

        <div class="ui form">
            <?php echo $this->Form->create(false); ?>
            <div class="field">
                <div class="four fields">
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
                        echo $this->Form->input('Fopcion', array('div' => false, 'label' => false, 'class' => 'ui selection dropdown', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion'));
                        ?>
                    </div>

                    <div class="field">
                        <?php echo $this->Form->label('A&Ntilde;o: ');
                        echo $this->Form->input('AÑO', array('div' => false, 'label' => false, 'class' => 'ui input')); ?>
                    </div>

                    <div class="field">

                        <label for="">-</label>                            
                        <input type="submit" class="ui button teal" value="Buscar">
                    </div>

                    <div class="field">
                        <label>-</label>
                        <a class="ui button primary" href="/GestorRRHH/nominas/add">Nueva Nomina</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="box"></div>
        <div class="pagination">
            <?php echo $this->Paginator->prev(null, array(), null, array('class' => 'disabled')); ?>
            <?php echo $this->Paginator->numbers(array('class' => 'disabled', 'separator' => '')); ?>
            <?php echo $this->Paginator->next(null, array(), null, array('class' => 'disabled')); ?>
        </div>

        <table cellpadding="0" cellspacing="0" class="ui celled table">
            <thead>
                <tr>
                    <th></th>  
                    <th style="width:10%;"><?php echo $this->Paginator->sort('Mes', 'FECHA_INI'); ?></th>
                    <th style="width:10%;">Año</th>
                    <th style="width:25%;">Quincena</th>
                    <th style="width:20%;"><?php echo $this->Paginator->sort('Fecha Inicio', 'FECHA_INI'); ?></th>
                    <th style="width:20%;"><?php echo $this->Paginator->sort('Fecha Fin', 'FECHA_FIN'); ?></th>                                        
                    <th style="width:15%; text-align: center"class="actions">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(count($nominas) > 0){
                    $i = 0;
                    foreach ($nominas as $nomina):
                    $class = ' class="even"';
                    if ($i++ % 2 == 0) {
                        $class = ' class="odd"';
                    }
                ?>
                <tr<?php echo $class; ?>>
                    <td></td>
                    <td><?php echo $nomina['Nomina']['MES']; ?></td>
                    <td><?php echo $nomina['Nomina']['AÑO']; ?></td>
                    <td><?php echo $nomina['Nomina']['QUINCENA']; ?></td>
                    <td><?php echo fechaElegible($nomina['Nomina']['FECHA_INI']); ?></td>
                    <td><?php echo fechaElegible($nomina['Nomina']['FECHA_FIN']); ?></td>                                                                        
                    <td class="actions">
                        <?php
                    echo $this->Html->image("Button White Info.png", array("alt" => "modificar", 'width' => '18', 'heigth' => '18', 'title' => 'Editar Nomina', 'url' => array('action' => 'edit', $nomina['Nomina']['id'])));
                    echo $this->Html->link($this->Html->image("file_delete.png", array('alt' => 'delete', 'height' => '18', 'width' => '18')), array('controller' => 'Nominas', 'action' => 'delete', $nomina['Nomina']['id']), array('escape' => false), sprintf('Esta seguro que desea eliminar esta Nomina?'));
                        ?>
                    </td>
                </tr>
                <?php endforeach;
                }else{
                    echo '<tr><td colspan="7">No se encontraron registros...</td></tr>';
                }?>

            </tbody>  
            <tfoot>
                <tr>
                    <th colspan="5">
                        <?php echo $this->Paginator->prev(null, array(), null, array('class' => 'disabled')); ?>
                        <?php echo $this->Paginator->numbers(array('class' => 'disabled', 'separator' => '')); ?>
                        <?php echo $this->Paginator->next(null, array(), null, array('class' => 'disabled')); ?>
                        <div class="ui pagination menu">
                            <a class='item' href=''>1</a>
                        </div>
                    </th>
                    <th colspan="2">
                        <?php
                        echo $this->Paginator->counter(array('format' => 'Mostrando %current% Nomina(s), de un total de  %count% Nominas'));
                        ?>

                    </th>
                </tr>
            </tfoot>          
        </table>

    </div>
</div>