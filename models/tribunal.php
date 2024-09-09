<?php

class Tribunal extends AppModel {

    var $name = 'Tribunal';
    var $displayField = 'CANTIDAD';
    var $actsAs = array('Containable');
    /**
     * Relaciones
     * 
     */
    var $belongsTo = 'Empleado';
    /**
     * Validaciones
     * 
     */
    var $validate = array(
        'CANTIDAD' => array(
            'rule' => array('numeric'),
            'message' => 'Ingrese un monto valido',
        ),
        'TRIBUNAL_MES' => array(
            'rule' => array('notEmpty'),
            'message' => 'Seleccione un Mes'
        ),
        'QUINCENA' => array(
            'rule' => array('notEmpty'),
            'message' => 'Seleccione una Quincena'
        ),
        'TRIBUNAL_AÑO' => array(
            'tribunalAño-r1' => array(
                'rule' => array('notEmpty'),
                'message' => 'Ingrese el año',
                'last' => true,
            ),
            'tribunalAño-r2' => array(
                'rule' => array('numeric'),
                'message' => 'El año debe ser un Numero',
                'last' => true
            ),
            'tribunalAño-r3' => array(
                'rule' => array('tribunalAño'),
                'message' => 'El año es un valor invalido'
            )
        )
    );
    
    function tribunalAño($check) {
        if ($check['TRIBUNAL_AÑO'] < 1900 || $check['TRIBUNAL_AÑO'] > 2200) {
            return false;
        }
        return true;
    }

    function beforeSave() {
        // Cuando esto existe es porque viene del ADD es un nuevo registro
        if (isset($this->data['Tribunal']['TRIBUNAL_MES']) && isset($this->data['Tribunal']['TRIBUNAL_AÑO'])) {
            // Determinamos las fechas en base a la quincena
            //            
            if ($this->data['Tribunal']['QUINCENA'] == 'Primera') {
                $this->data['Tribunal']['FECHA'] = $this->data['Tribunal']['TRIBUNAL_AÑO'] . '-' . $this->data['Tribunal']['TRIBUNAL_MES'] . '-1';
            }
            if ($this->data['Tribunal']['QUINCENA'] == 'Segunda') {
                $this->data['Tribunal']['FECHA'] = $this->data['Tribunal']['TRIBUNAL_AÑO'] . '-' . $this->data['Tribunal']['TRIBUNAL_MES'] . '-16';
            }            
            
        }

        if (!empty($this->data['Tribunal']['FECHA'])) {
            $this->data['Tribunal']['FECHA'] = formatoFechaBeforeSave($this->data['Tribunal']['FECHA']);
        }
        
        if ($this->existe($this->data['Tribunal'])) {
            $this->errorMessage = "Ya existe una deduccion por tribunales para esta fecha.";
            return false;
        }

        return true;
    }

    function afterFind($results) {
        foreach ($results as $key => $val) {

            if (isset($val['Tribunal']['FECHA'])) {
                $results[$key]['Tribunal']['FECHA'] = formatoFechaAfterFind($val['Tribunal']['FECHA']);
                $results[$key]['Tribunal']['MES'] = $this->getMes($results[$key]['Tribunal']['FECHA']);
                $results[$key]['Tribunal']['AÑO'] = $this->getAño($results[$key]['Tribunal']['FECHA']);
                $results[$key]['Tribunal']['QUINCENA'] = $this->getQuincena($results[$key]['Tribunal']['FECHA']);
            }            
        }
        return $results;
    }
    
    function getMes($date) {
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
            "Noviembre", "Diciembre");
        list($dia, $mes, $anio) = preg_split('/-/', $date);
        return $meses[((int) $mes) - 1];
    }

    function getAño($date) {
        list($dia, $mes, $anio) = preg_split('/-/', $date);
        return $anio;
    }
    
    function getQuincena($date){
        list($dia, $mes, $anio) = preg_split('/-/', $date);
        if($dia=='1'){
            return 'Primera';
        }else{
            return 'Segunda';
        }
    }
    
    function existe($data) {
        $conditions['empleado_id'] = $data['empleado_id'];
        $conditions['FECHA'] = $data['FECHA'];
        $data = $this->find('first', array(
            'conditions' => $conditions
                ));
        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }

}

?>