<?php defined('BASEPATH') or exit('No direct script access allowed');

class CargosController extends AdminController
{
public function __construct()
{
parent::__construct();
}

public function index()
{
    $this->data['cargos'] = $this->cargo->get_all();
    $this->load->view('cargos/index', $this->data);
}

public function add()
{
    if (!empty($this->input->post())) {
        if ($this->cargo->save($this->input->post())) {
            $this->session->set_flashdata('message', 'Cargo agregado con éxito');
            redirect('cargos/index');
        }
        $this->session->set_flashdata('error', $this->cargo->error);
    }
    $this->load->view('cargos/add');
}

public function delete($id)
{
    if ($this->cargo->delete($id)) {
        $this->session->set_flashdata('message', 'Cargo eliminado');
        redirect('cargos/index');
    } else {
        $this->session->set_flashdata('error', 'Error al eliminar');
        redirect('cargos/index');
    }
}

public function edit($id)
{
    $this->cargo->id = $id;
    if (empty($this->input->post())) {
        $this->data['cargo'] = $this->cargo->get_by_id($id);
    } else {
        if ($this->cargo->save($this->input->post())) {
            $this->session->set_flashdata('message', 'Cargo modificado');
            redirect('cargos/index');
        }
        $this->session->set_flashdata('error', $this->cargo->error);
    }
    $this->load->view('cargos/edit', $this->data);
}

public function grupo()
{
    $data = $this->cargo->agruparSueldos();
    if (empty($data)) {
        $this->session->set_flashdata('error', 'Ningún cargo en el sistema tiene un sueldo activo en este momento');
        redirect('cargos/index');
    }
    $this->data['cargos'] = $data;
    $this->load->view('cargos/grupo', $this->data);
}

}