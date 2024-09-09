<div class="ui segment vertical very padded">
<div class="ui container">  
<div class="box">
    <div class="title"><h2>Dias Feriados</h2></div>
    <div class="content pages">
        <div class="row"></div>
        <table cellpadding="0" cellspacing="0" class="ui celled table"> 
            <thead>
                <tr>
                    <th></th>  
                    <th style="width:15%"><?php echo $this->Paginator->sort('Fecha', 'FECHA'); ?></th>                    
                    <th style="width:60%"><?php echo $this->Paginator->sort('Descripcion', 'DESCRIPCION'); ?></th>                    
                    <th style="width:15%;text-align: center" class="actions">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($feriados as $feriado):
                    $class = ' class="even"';
                    if ($i++ % 2 == 0) {
                        $class = ' class="odd"';
                    }
                    ?>
                    <tr<?php echo $class; ?>>
                        <td></td>
                        <td><?php echo fechaElegible($feriado['Feriado']['FECHA']); ?></td>                        
                        <td><?php echo $feriado['Feriado']['DESCRIPCION']; ?></td>                        
                        <td class="actions" center>


                            <?php                            
                            echo $this->Html->image("file_edit.png", array("alt" => "Modificar", 'title' => 'Modificar', 'width' => '20', 'heigth' => '20', 'url' => array('action' => 'edit', $feriado['Feriado']['id'])));
                            echo $this->Html->image("file_delete.png", array("alt" => "Borrar", 'title' => 'Eliminar', 'width' => '20', 'heigth' => '20', 'url' => array('action' => 'delete', $feriado['Feriado']['id'])));
                            ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pages-bottom">
            <div class="actionbox" id="centrar">
                <?php
                echo $this->Paginator->counter(array('format' => 'Actualmente existen %count% dia(s) feriado(s) en el sistema'));
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

<div class="box">
    <?php echo $this->Session->flash(); ?>
</div>

<div class="box">

    <form action="/GestorRRHH/feriados/add/" id="" method="post" accept-charset="utf-8" class="ui form">
        <button class="ui button fluid teal" type="submit">Nuevo</button>                
    </form>


    <!-- <div class="title">	<h2>Acciones</h2></div> -->
<!--     <div class="content form">
        <div class="row boton">
            <div class="boton">
                <button class="ui button fluid teal" type="submit">Nuevo</button>
                <?php echo $this->Html->link('Nuevo Dia Feriado', array('action' => 'add')); ?>
            </div>
        </div>
    </div> -->
</div>

 </div>
                </div>