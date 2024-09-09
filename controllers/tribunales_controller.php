<?php defined('BASEPATH') or exit('No direct script access allowed');

class TribunalesController extends AdminController
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
            $filtro = array('Empleado.DNI LIKE' => $this->input->post('valor'));
        }
        if ($this->input->post('Fopcion') == 2) {
            $filtro = array('Empleado.NOMBRE LIKE' => "%" . $this->input->post('valor') . "%");
        }
        if ($this->input->post('Fopcion') == 3) {
            $filtro = array('Empleado.APELLIDO LIKE' => "%" . $this->input->post('valor') . "%");
        }
    }
    $this->data['empleados'] = $this->empleado->get_all(array(
        'conditions' => $filtro,
        'contain' => array(
            'Grupo',
            'Contrato' => array(
                'Cargo',
                'Departamento',
                'conditions' => array(
                    'FECHA_FIN' => NULL
                )
            )
        )
    ));
    $this->load->view('tribunales/index', $this->data);
}

public function edit($id = null)
{
    if (empty($this->input->post())) {
        $tribunales = $this->tribunal->get_all(array(
            'conditions' => array(
                'empleado_id' => $id
            ),
            'limit' => 20,
            'order' => array(
                'Tribunal.FECHA' => 'desc'
            )
        ));
        $empleado = $this->empleado->get_by_id($id, array(
            'contain' => array(
                'Grupo'
            )
        ));
        $this->set(compact('tribunales', 'empleado'));
    }
}

public function delete($id)
{
    $empleadoid = $this->tribunal->get_by_id($id, array(
        'fields' => array(
            'Tribunal.empleado_id'
        )
    ));
    if ($this->tribunal->delete($id)) {
        $this->session->set_flashdata('message', 'Se ha eliminado con éxito');
        redirect('tribunales/edit/' . $empleadoid['Tribunal']['empleado_id']);
    }
}

public function add()
{
    $this->set("empleadoId", $this->uri->segment(3));
    if (!empty($this->input->post())) {
        if ($this->tribunal->save($this->input->post())) {
            $this->session->set_flashdata('message', 'Tribunal agregado con éxito');
            redirect('tribunales/edit/' . $this->input->post()['Tribunal']['empleado_id']);
        } else {
            $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
        }
    }
}

}
