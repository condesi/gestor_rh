<?php defined('BASEPATH') or exit('No direct script access allowed');

class FeriadosController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['feriados'] = $this->feriado->get_all(array('order' => array('fecha' => 'desc')));
        $this->load->view('feriados/index', $this->data);
    }

    public function add()
    {
        if (!empty($this->input->post())) {
            if ($this->feriado->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Feriado agregado con éxito');
                redirect('feriados/index');
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function delete($id)
    {
        if ($this->feriado->delete($id)) {
            $this->session->set_flashdata('message', 'Feriado eliminado');
            redirect('feriados/index');
        }
    }

    public function edit($id)
    {
        $this->feriado->id = $id;
        if (empty($this->input->post())) {
            $this->data = $this->feriado->get_by_id($id);
        } else {
            if ($this->feriado->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Feriado modificado');
                redirect('feriados/index');
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }
}
