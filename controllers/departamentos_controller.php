<?php defined('BASEPATH') or exit('No direct script access allowed');

class DepartamentosController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['departamentos'] = $this->departamento->get_all();
        $this->load->view('departamentos/index', $this->data);
    }

    public function add()
    {
        if (!empty($this->input->post())) {
            if ($this->departamento->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Departamento agregado con éxito');
                redirect('departamentos/index');
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function delete($id)
    {
        if ($this->departamento->delete($id)) {
            $this->session->set_flashdata('message', 'Departamento eliminado');
            redirect('departamentos/index');
        }
    }

    public function edit($id)
    {
        $this->departamento->id = $id;
        if (empty($this->input->post())) {
            $this->data = $this->departamento->get_by_id($id);
        } else {
            if ($this->departamento->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Departamento modificado');
                redirect('departamentos/index');
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function asignar($id)
    {
        $this->departamento->id = $id;
        if (!empty($this->input->post())) {
            if ($this->departamento->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Departamento modificado');
                redirect('departamentos/index');
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
        $departamento = $this->departamento->get_by_id($id);
        $programas = $this->departamento->programa->get_all();
        $this->set(compact('programas', 'id', 'departamento'));
    }
}
