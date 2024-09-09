<?php defined('BASEPATH') or exit('No direct script access allowed');

class AusenciasController extends AdminController
{
public function __construct()
{
parent::__construct();
}

public function index()
{
    $filtro = array();
    if (!empty($this->input->post())) {
        if ($this->input->post('Fopcion') == 1) {
            $filtro = array('empleado.dni LIKE' => $this->input->post('valor'));
        }
        if ($this->input->post('Fopcion') == 2) {
            $filtro = array('empleado.nombre LIKE' => "%" . $this->input->post('valor') . "%");
        }
        if ($this->input->post('Fopcion') == 3) {
            $filtro = array('empleado.apellido LIKE' => "%" . $this->input->post('valor') . "%");
        }
    }
    $this->data['empleados'] = $this->empleado->get_all($filtro);
    $this->load->view('ausencias/index', $this->data);
}

public function edit($id = null)
{
    if (empty($this->input->post())) {
        $this->data['ausencias'] = $this->ausencia->get_all(array('empleado_id' => $id));
        $this->data['empleado'] = $this->empleado->get_by_id($id);
        $this->load->view('ausencias/edit', $this->data);
    }
}

public function add()
{
    $this->data['empleadoId'] = $this->uri->segment(3);
    if (!empty($this->input->post())) {
        if ($this->ausencia->save($this->input->post())) {
            $this->session->set_flashdata('message', 'Ausencia agregada con éxito');
            redirect('ausencias/edit/' . $this->input->post('empleado_id'));
        }
        $this->session->set_flashdata('error', $this->ausencia->error);
    }
    $this->load->view('ausencias/add', $this->data);
}

public function delete($id)
{
    $empleadoId = $this->ausencia->get_by_id($id)->empleado_id;
    if ($this->ausencia->delete($id)) {
        $this->session->set_flashdata('message', 'Se ha eliminado con éxito');
        redirect('ausencias/edit/' . $empleadoId);
    } else {
        $this->session->set_flashdata('error', 'Error al eliminar');
        redirect('ausencias/edit/' . $empleadoId);
    }
}

public function edit_ausencia($id)
{
    $this->data['id'] = $id;
    if (empty($this->input->post())) {
        $this->data['ausencia'] = $this->ausencia->get_by_id($id);
    } else {
        if ($this->ausencia->save($this->input->post())) {
            $this->session->set_flashdata('message', 'Ausencia modificada con éxito');
            redirect('ausencias/edit/' . $this->input->post('empleado_id'));
        }
        $this->session->set_flashdata('error', $this->ausencia->error);
    }
    $this->load->view('ausencias/edit_ausencia', $this->data);
}

}