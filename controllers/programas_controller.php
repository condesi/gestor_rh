<?php defined('BASEPATH') or exit('No direct script access allowed');

class ProgramasController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['programas'] = $this->programa->get_all(array(
            'recursive' => 0,
            'limit' => 20,
            'order' => array(
                '(link unavailable)' => 'asc'
            )
        ));
        $this->load->view('programas/index', $this->data);
    }

    public function add()
    {
        if (!empty($this->input->post())) {
            if ($this->programa->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Programa agregado con éxito');
                redirect('programas/index');
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function delete($id)
    {
        $departamentos = $this->programa->get_by_id($id, array(
            'contain' => array(
                'Departamento'
            )
        ));
        if (!empty($departamentos['Departamento'])) {
            foreach ($departamentos['Departamento'] as $departamento) {
                $this->departamento->update($departamento['id'], array('programa_id' => null));
            }
        }
        if ($this->programa->delete($id)) {
            $this->session->set_flashdata('message', 'Programa eliminado');
            redirect('programas/index');
        }
    }

    public function edit($id)
    {
        $this->programa->id = $id;
        if (empty($this->input->post())) {
            $this->data = $this->programa->get_by_id($id);
        } else {
            if ($this->programa->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Programa modificado');
                redirect('programas/index');
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }
}
