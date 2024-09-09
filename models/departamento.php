<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departamento extends PerfexModel {
public $name = 'Departamento';
public $displayField = 'NOMBRE';

public $actsAs = array(
'Containable'
);

public $hasMany = array(
'Contrato' => array(
'className' => 'Contrato',
'foreignKey' => 'departamento_id'
)
);

public $belongsTo = array(
'Programa' => array(
'className' => 'Programa',
'foreignKey' => 'programa_id'
)
);

public $hasOne = array(
'Localizacion' => array(
'className' => 'Localizacion',
'foreignKey' => 'departamento_id'
)
);

public $validate = array(
'NOMBRE' => array(
'nombreRule-1' => array(
'rule' => 'notEmpty',
'message' => 'Nombre del Departamento necesario',
'last' => true
),
'nombreRule-2' => array(
'rule' => 'isUnique',
'message' => 'Este Departamento ya existe'
)
)
);

public function buscarInformacion($departamento) {
$data = $this->find('first', array(
'conditions' => array(
'Departamento.NOMBRE' => $departamento
),
'contain' => array(
'Programa'
)
));
return $data;
}

public function beforeSave($data) {
if (!empty($data['Departamento']['NOMBRE'])) {
$data['Departamento']['NOMBRE'] = strtoupper($data['Departamento']['NOMBRE']);
}
return true;
}
}