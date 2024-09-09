<?php
defined('BASEPATH') or exit('No direct script access allowed'); class Comercial extends PerfexModel {
public $name = 'Comercial';
public $displayField = 'CANTIDAD';

public $actsAs = array(
'Containable'
);

public $belongsTo = array(
'Empleado' => array(
'className' => 'Empleado',
'foreignKey' => 'empleado_id'
)
);

public $validate = array(
'CANTIDAD' => array(
'rule' => array('numeric'),
'message' => 'Ingrese un monto valido',
),
'COMERCIAL_MES' => array(
'rule' => array('notEmpty'),
'message' => 'Seleccione un Mes'
),
'QUINCENA' => array(
'rule' => array('notEmpty'),
'message' => 'Seleccione una Quincena'
),
'COMERCIAL_AÑO' => array(
'comercialAño-r1' => array(
'rule' => array('notEmpty'),
'message' => 'Ingrese el año',
'last' => true,
),
'comercialAño-r2' => array(
'rule' => array('numeric'),
'message' => 'El año debe ser un Numero',
'last' => true
),
'comercialAño-r3' => array(
'rule' => array('comercialAño'),
'message' => 'El año es un valor invalido'
)
)
);

public function comercialAño($check) {
if ($check['COMERCIAL_AÑO'] < 1900 || $check['COMERCIAL_AÑO'] > 2200) {
return false;
}
return true;
}

public function beforeSave($data) {
// Cuando esto existe es porque viene del ADD es un nuevo registro
if (isset($data['Comercial']['COMERCIAL_MES']) && isset($data['Comercial']['COMERCIAL_AÑO'])) {
// Determinamos las fechas en base a la quincena
// if ($data['Comercial']['QUINCENA'] == 'Primera') {
$data['Comercial']['FECHA'] = $data['Comercial']['COMERCIAL_AÑO'] . '-' . $data['Comercial']['COMERCIAL_MES'] . '-1';
// }
// if ($data['Comercial']['QUINCENA'] == 'Segunda') {
$data['Comercial']['FECHA'] = $data['Comercial']['COMERCIAL_AÑO'] . '-' . $data['Comercial']['COMERCIAL_MES'] . '-16';
// }
} $data['Comercial']['FECHA'] = formatoFechaBeforeSave($data['Comercial']['FECHA']);
}
if($this->existe($data['Comercial'])){
$this->errorMessage = "Ya existe una deduccion por credito comercial para esta fecha.";
return false;
}
return true;
}

public function afterFind($results) {
foreach ($results as $key => $val) {
if (isset($val['Comercial']['FECHA'])) {
$results[$key]['Comercial']['FECHA'] = formatoFechaAfterFind($val['Comercial']['FECHA']);
$results[$key]['Comercial']['MES'] = $this->getMes($results[$key]['Comercial']['FECHA']);
$results[$key]['Comercial']['AÑO'] = $this->getAño($results[$key]['Comercial']['FECHA']);
$results[$key]['Comercial']['QUINCENA'] = $this->getQuincena($results[$key]['Comercial']['FECHA']);
}
}
return $results;
}

public function getMes($date) {
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
list($dia, $mes, $anio) = preg_split('/-/', $date);
return $meses[((int) $mes) - 1];
}

public function getAño($date) {
list($dia, $mes, $anio) = preg_split('/-/', $date);
return $anio;
}

public function getQuincena($date){
list($dia, $mes, $anio) = preg_split('/-/', $date);
if($dia=='1'){
return 'Primera';
}else{
return 'Segunda';
}
}

public function existe($data){
$conditions['empleado_id']=$data['empleado_id'];
$conditions['FECHA']=$data['FECHA'];
$data=$this->find('first',array(
'conditions'=>$conditions
));
if(!empty($data)){
return true;
}else{
return false;
}
}
}