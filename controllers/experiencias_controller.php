<?php defined('BASEPATH') or exit('No direct script access allowed');

class ExperienciasController extends AdminController
{
public function __construct()
{
parent::__construct();
}

public function index()
{
    // No implementado
}

public function delete($id)
{
    $empleadoid = $this->experiencia->get_by_id($id);
    if ($this->experiencia->delete($id)) {
        $this->session->set_flashdata('message', 'Experiencia eliminada con éxito');
        redirect('experiencias/edit/' . $empleadoid['empleado_id']);
    }
}

public function edit($id = null)
{
    if (empty($this->input->post())) {
        $this->data['experiencias'] = $this->experiencia->get_all(array('empleado_id' => $id));
        $empleado = $this->empleado->get_by_id($id);
        $this->set(compact('experiencias', 'empleado'));
    }
}

public function add()
{
    $empleadoId = $this->input->get('empleadoId');
    if (!empty($this->input->post())) {
        if ($this->experiencia->save($this->input->post())) {
            $this->session->set_flashdata('message', 'Experiencia agregada con éxito');
            redirect('experiencias/edit/' . $empleadoId);
        } else {
            $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
        }
    }
}

}
