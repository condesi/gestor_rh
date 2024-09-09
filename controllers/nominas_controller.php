<?php defined('BASEPATH') or exit('No direct script access allowed');

class NominasController extends AdminController
{
public function __construct()
{
parent::__construct();
}

public function index()
{
    $filtro = array();
    if (!empty($this->input->post())) {
        if (!empty($this->input->post('AÑO')) && empty($this->input->post('Fopcion'))) {
            $filtro = array('Nomina.FECHA_INI LIKE' => "%" . $this->input->post('AÑO') . "%");
        }
        if (!empty($this->input->post('Fopcion')) && empty($this->input->post('AÑO'))) {
            $filtro = array('MONTH(Nomina.FECHA_INI)' => $this->input->post('Fopcion'));
        }
        if (!empty($this->input->post('Fopcion')) && !empty($this->input->post('AÑO'))) {
            $filtro = array('MONTH(Nomina.FECHA_INI)' => $this->input->post('Fopcion'), 'Nomina.FECHA_INI LIKE' => "%" . $this->input->post('AÑO') . "%");
        }
    }
    $this->data['nominas'] = $this->nomina->get_all(array(
        'conditions' => $filtro,
        'order' => array(
            'FECHA_INI' => 'desc'
        )
    ));
    $this->load->view('nominas/index', $this->data);
}

public function add()
{
    if (!empty($this->input->post())) {
        if ($this->nomina->save($this->input->post())) {
            $this->session->set_flashdata('message', 'Nomina creada con éxito');
            redirect('nominas/index');
        } else {
            $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
        }
    }
}

public function delete($id)
{
    if ($this->nomina->delete($id)) {
        $this->session->set_flashdata('message', 'Se ha eliminado con éxito');
        redirect('nominas/index');
    }
}

public function edit($id = null)
{
    $asignacion = $this->asignacion->get_all();
    $deduccion = $this->deduccion->get_all();
    $nomina = $this->nomina->get_by_id($id);
    $this->set(compact('asignacion', 'deduccion', 'nomina'));
}

public function mostrar()
{
    // ...
}

public function bloquear($id = null)
{
    $this->nomina->update($id, array('BLOQUEAR' => 1));
    redirect('nominas/edit/' . $id);
}

}