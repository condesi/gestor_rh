<?php defined('BASEPATH') or exit('No direct script access allowed');

class PagesController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function display()
    {
        $this->redirect('pages/index');
    }

    public function index()
    {
        $fecha = new DateTime('NOW');
        $noContratadosMes = $this->contrato->count_all(array(
            'joins' => array(
                array(
                    'table' => 'empleado',
                    'alias' => 'EmpleadoJoin',
                    'type' => 'INNER',
                    'conditions' => array(
                        '(link unavailable) = Contrato.empleado_id'
                    )
                )
            ),
            'conditions' => array(
                'Contrato.FECHA_INI >=' => $fecha->format("Y-m-1"),
                'Contrato.FECHA_INI <=' => $fecha->format("Y-m-30")
            )
        ));
        $noEmpleados = $this->empleado->count_all();
        $this->data['empleados'] = $this->empleado->get_all();
        $this->data['noContratadosMes'] = $noContratadosMes;
        $this->data['noEmpleados'] = $noEmpleados;
        $this->load->view('pages/index', $this->data);
    }
}