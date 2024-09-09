<div class="ui segment vertical">
    <div class="ui container">
        <div class="ui header block">
            <div class="ui breadcrumb">
                <a href="/GestorRRHH/" class="section"><i class="icon home "></i></a>
                <i class="right angle icon divider"></i>
                <a href="/GestorRRHH/empleados" class="section">Personal</a>
                <i class="right angle icon divider"></i>
                <div class="section active">Nuevo Empleado</div>
            </div>
        </div>
        <h1 class="ui header">Datos del Empleado</h1>
        <div class="ui divider"></div>

        <div class="ui top attached tabular menu">
            <a class="item active" data-tab="datosPersonales">Datos Personales</a>
            <a class="item" data-tab="banco">Banco</a>
            <a class="item" data-tab="curriculum">curriculum</a>
            <a class="item" data-tab="seguridadIndustrial">Seguridad Industrial</a>
            <a class="item" data-tab="emergencia">Emergencia</a>


        </div>

        <div class="ui form">
          <?php 
             
            if (!empty($this->validationErrors)) { ?>
            <div class="ui negative message">
                <p><?php echo $this->Session->flash(); ?></p>
            </div>
            <?php } ?>
           
           
            <?php echo $this->Form->create('Empleado'); ?>
            <input type="hidden" name="_method" value="POST">
            
            <div class="ui bottom attached tab segment active very padded" data-tab="datosPersonales" style="min-height:500px;;">
                <!-- Tab 1-->
                <div class="ui divider hidden"></div>
                <div class="field">
                    <div class="four fields">
                        <div class="field">
                            <?php $options = array('Guatemalteco' => 'Guatemalteco', 'Extranjero' => 'Extranjero');
                            echo $this->Form->input('NACIONALIDAD', array('div' => false, 'label' => 'Nacionalidad', 'class' => 'ui dropdown search', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion')); ?>
                        </div>
                        <div class="field">
                            <?php echo $this->Form->input('CEDULA', array('div' => false, 'label' => 'Identificación', 'class' => 'small')); ?>
                        </div>
                        <div class="field">
                            <?php $options = array('Masculino' => 'Masculino', 'Femenino' => 'Femenino');
                            echo $this->Form->input('SEXO', array('div' => false, 'label' => 'Sexo', 'class' => 'ui dropdown search', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion')); ?>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <?php echo $this->Form->input('NOMBRE', array('div' => false, 'label' => 'Nombre(s)', 'class' => 'medium')); ?>
                </div>
                <div class="field">
                    <?php echo $this->Form->input('APELLIDO', array('div' => false, 'label' => 'Apellido(s)', 'class' => 'medium')); ?>
                </div>

                <div class="field">

                    <div class="four fields">
                        <div class=" field">
                            <label>Fecha de Nacimiento</label>
                            <div class="field">
                                <div class="ui calendar" id="calendar">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input name="data[Empleado][FECHANAC]" type="text" class="datepicker dp-applied" id="FECHANAC">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <?php 
                            $options = array('Soltero' => 'Soltero', 'Casado' => 'Casado', 'Viudo' => 'Viudo', 'Divorciado' => 'Divorciado');
                            echo $this->Form->input('EDOCIVIL', array('div' => false, 'label' => 'Estado Civil', 'class' => 'ui dropdown search', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion')); ?>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="four fields">
                        <div class="field">
                            <label for="">Empleado o Obrero</label>
                            <select name="data[Empleado][grupo_id]" class="ui dropdown search" id="EmpleadoGrupoId" required>
                                <option value="">Seleccione una Opcion</option>
                                <option value="1">Empleado</option>
                                <option value="2">Obrero</option>
                            </select>
                        </div>

                        <div class="field">
                            <label for="EmpleadoINGRESO">Fecha de Ingreso</label>
                            <div class="field">
                                <div class="ui calendar" id="calendarIngreso">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input name="data[Empleado][INGRESO]" type="text" class="datepicker dp-applied" id="EmpleadoINGRESO">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="field">
                    <div class="four fields">
                        <div class="field">
                            <?php echo $this->Form->input('CIUDAD', array('div' => false, 'label' => 'Ciudad de Nacimiento', 'class' => 'medium')); ?>
                        </div>

                        <div class="field">

                            <div class="field">
                                <?php echo $this->Form->input('ESTADO', array('div' => false, 'label' => 'Estado', 'class' => 'medium')); ?>
                            </div>

                        </div>
                    </div>

                </div>



                <div class="field">
                    <div class="four fields">
                        <div class="field">
                            <?php echo $this->Form->input('MUNICIPIO', array('div' => false, 'label' => 'Municipio', 'class' => 'medium'));?>
                        </div>

                        <div class="field">

                            <div class="field">
                                <?php  echo $this->Form->input('EMAIL', array('div' => false, 'label' => 'Correo Electronico', 'class' => 'medium')); ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="field">
                    <div class="four fields">
                        <div class="field">
                            <?php echo $this->Form->input('TELEFONO', array('div' => false, 'label' => 'Telefono Residencial', 'class' => 'medium'));?>
                        </div>

                        <div class="field">

                            <div class="field">
                                <?php  echo $this->Form->input('CELULAR', array('div' => false, 'label' => 'Telefono Celular', 'class' => 'medium'));?>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- end tab1 -->
            </div>
            <div class="ui bottom attached tab segment very padded" data-tab="banco" style="min-height:500px;">
                <!--  tab2 -->

                <div class="ui divider hidden"></div>
                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <?php echo $this->Form->input('BANCO', array('div' => false, 'label' => 'Banco', 'class' => 'medium')); ?>
                        </div>
                        <div class="field">
                            <?php $options = array('Cheque' => 'Cheque', 'Efectivo' => 'Efectivo', 'Banco' => 'Banco');
                            echo $this->Form->input('TPAGO', array('div' => false, 'label' => 'Tipo de Pago', 'class' => 'ui dropdown', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion')); ?>
                        </div>
                    </div>
                </div>
                <div class="fiel">
                    <div class="two fields">
                        <div class="field">
                            <?php echo $this->Form->input('NCUENTA', array('div' => false, 'label' => 'Numero de Cuenta', 'class' => 'medium')); ?>
                        </div>
                    </div>
                </div>


                <!-- end tab2 -->
            </div>
            <div class="ui bottom attached tab segment very padded" data-tab="curriculum" style="min-height:500px;">
                <!-- Tab3 -->

                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <?php 
                            $options = array('Si' => 'Si', 'No' => 'No');
                            echo $this->Form->input('ALFABETA', array('div' => false, 'label' => 'Sabe leer y escribir', 'class' => 'ui dropdown search', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion'));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>Donde Estudio Primaria</label>
                    <textarea rows="2" name="data[Empleado][PRIMARIA]" type="text" class="medium" id="PRIMARIA"></textarea>
                </div>

                <div class="field">
                    <label>Donde Estudio Secundaria</label>
                    <textarea rows="2" name="data[Empleado][SECUNDARIA]" type="text" class="medium" id="SECUNDARIA"></textarea>

                </div>

                <div class="field">
                    <label>Universidad a la que asistio</label>
                    <textarea rows="2" name="data[Empleado][SUPERIOR]" type="text" class="medium" id="SUPERIOR"></textarea>

                </div>
                <!-- End Tab3 -->
            </div>
            <div class="ui bottom attached tab segment very padded" data-tab="seguridadIndustrial" style="min-height:500px;">
                <!-- tab 4 -->
                <div class="field">
                    <div class="three fields">
                        <div class="field">
                            <?php $options = array('O+' => 'O+', 'O-' => 'O-', 'A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-');
                            echo $this->Form->input('SANGRE', array('div' => false, 'label' => 'Tipo de Sangre', 'class' => 'ui dropdown search', 'type' => 'select', 'options' => $options, 'empty' => 'Seleccione una Opcion')); ?>
                        </div>
                        <div class="field">
                            <?php echo $this->Form->input('PESO', array('div' => false, 'label' => 'Peso en Kg', 'class' => 'small')); ?>
                        </div>
                        <div class="field">
                            <?php echo $this->Form->input('ESTATURA', array('div' => false, 'label' => 'Estatura en cms', 'class' => 'small')); ?>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <div class="three fields">
                        <div class="field">
                            <?php echo $this->Form->input('TCAMISA', array('div' => false, 'label' => 'Talla de Camisa', 'class' => 'small')); ?>
                        </div>
                        <div class="field">
                            <?php echo $this->Form->input('TPANTALOM', array('div' => false, 'label' => 'Talla de Pantalon', 'class' => 'small'));  ?>
                        </div>
                        <div class="field">
                            <?php echo $this->Form->input('TCALZADO', array('div' => false, 'label' => 'Talla de Zapatos', 'class' => 'small')); ?>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <?php echo $this->Form->input('EMFERMEDADES', array('div' => false, 'label' => 'Enfermedades', 'class' => 'medium')); ?>
                        </div>
                        <div class="field">
                            <?php echo $this->Form->input('OPERACIONES', array('div' => false, 'label' => 'Operaciones', 'class' => 'medium'));  ?>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <?php echo $this->Form->input('ALERGICO', array('div' => false, 'label' => 'Alergico', 'class' => 'medium')); ?>
                        </div>
                        <div class="field">
                            <?php echo $this->Form->input('COMPLEXION', array('div' => false, 'label' => 'Complexion', 'class' => 'medium'));  ?>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <?php echo $this->Form->input('DISCAPACIDAD', array('div' => false, 'label' => 'Si tiene Discapacidad Breve Descripcion', 'class' => 'large')); ?>
                </div>





                <!-- end tab 4 -->
            </div>
            <div class="ui bottom attached tab segment very padded" data-tab="emergencia" style="min-height:500px;">
                <!-- tab5 -->
                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <?php echo $this->Form->input('NOMEMERGENCIA', array('div' => false, 'label' => 'Contacto de Emergencia', 'class' => 'medium')); ?>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="three fields">
                        <div class="field">
                            <?php echo $this->Form->input('TELEMERGECIA', array('div' => false, 'label' => 'Telefono del contacto', 'class' => 'small')); ?>
                        </div>
                    </div>
                </div>



                <!-- end tab5-->
            </div>

            <button class="ui button fluid primary" type="submit"> Guardar</button>

        </div>

    <div class="ui divider hidden"></div>

    </div>




</div>
