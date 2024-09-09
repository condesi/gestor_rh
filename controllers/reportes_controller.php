<?php defined('BASEPATH') or exit('No direct script access allowed');

class ReportesController extends AdminController
{
public function __construct()
{
parent::__construct();
}

public function generar_reportes()
{
    $cargos = $this->cargo->get_all(array('fields' => array('id', 'nombre')));
    $departamentos = $this->departamento->get_all(array('fields' => array('id', 'nombre')));
    $asignaciones = $this->asignacion->get_all(array('fields' => array('id', 'nombre')));
    $deducciones = $this->deduccion->get_all(array('fields' => array('id', 'nombre')));

    if (!empty($this->input->post())) {
        $data = $this->empleado->busqueda($this->input->post());
        $this->data['empleados'] = $data;
        if ($this->input->post('TIPO_REPORTE') == '1') {
            $this->load->view('reportes/archivo_general', $this->data);
        } elseif ($this->input->post('TIPO_REPORTE') == '2') {
            $this->load->view('reportes/archivo_contacto', $this->data);
        } elseif ($this->input->post('TIPO_REPORTE') == '3') {
            $this->load->view('reportes/archivo_direccion', $this->data);
        } elseif ($this->input->post('TIPO_REPORTE') == '4') {
            $this->load->view('reportes/archivo_banco', $this->data);
        }
    }

    $this->data['cargos'] = $cargos;
    $this->data['departamentos'] = $departamentos;
    $this->data['asignaciones'] = $asignaciones;
    $this->data['deducciones'] = $deducciones;

    $this->load->view('reportes/generar_reportes', $this->data);
}

}