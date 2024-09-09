

<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ausencia extends PerfexModel {
public $name = 'Ausencia';
public $displayField = 'TIPO';

public $belongsTo = array(
    'Empleado' => array(
        'className' => 'Empleado',
        'foreignKey' => 'empleado_id'
    )
);

public $validate = array(
    'TIPO' => array(
        'rule' => 'notEmpty',
        'message' => 'Seleccion una Opcion'
    ),
    'FECHA' => array(
        'rule' => array('date', 'dmy'),
        'message' => 'Fecha incorrecta'
    )
);

public function beforeSave($data) {
    if (!empty($data['Ausencia']['FECHA'])) {
        $data['Ausencia']['FECHA'] = formatoFechaBeforeSave($data['Ausencia']['FECHA']);
    }
    // Si existe el Nomina -> ID entonces es un update osea un generarNomina (que es donde se agregan los empleados)
    if (!isset($data['Ausencia']['id'])) {
        if ($this->existe($data['Ausencia'])) {
            $this->errorMessage = "Ya existe una ausencia para esta fecha.";
            return false;
        }
    }
    return true;
}

public function afterFind($results) {
    foreach ($results as $key => $val) {
        if (!isset($val['Ausencia'])) {
            if (isset($val['FECHA'])) {
                $results[$key]['FECHA'] = formatoFechaAfterFind($val['FECHA']);
            }
        }
        if (isset($val['Ausencia']['FECHA'])) {
            $results[$key]['Ausencia']['FECHA'] = formatoFechaAfterFind($val['Ausencia']['FECHA']);
        }
    }
    return $results;
}

public function existe($data) {
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