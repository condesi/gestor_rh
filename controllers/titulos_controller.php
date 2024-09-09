<?php defined('BASEPATH') or exit('No direct script access allowed');

class TitulosController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // No implementado
    }

    public function edit($id = null)
    {
        if (empty($this->input->post())) {
            $this->data['empleado'] = $this->empleado->get_by_id($id, array(
                'contain' => array(
                    'Grupo'
                )
            ));
            $this->data['titulos'] = $this->titulo->get_all(array(
                'recursive' => -1,
                'limit' => 20,
                'conditions' => array(
                    'empleado_id' => $id
                )
            ));
        }
    }

    public function delete($id)
    {
        $empleadoid = $this->titulo->get_by_id($id, array(
            'fields' => array(
                'Titulo.empleado_id'
            )
        ));
        if ($this->titulo->delete($id)) {
            $this->session->set_flashdata('message', 'Se ha eliminado con éxito');
            redirect('titulos/edit/' . $empleadoid['Titulo']['empleado_id']);
        }
    }

    public function add()
    {
        $this->set("empleadoId", $this->uri->segment(3));
        if (!empty($this->input->post())) {
            if ($this->titulo->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Título agregado con éxito');
                redirect('titulos/edit/' . $this->input->post()['Titulo']['empleado_id']);
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function edit_titulo($id)
    {
        $this->set("id", $id);
        if (empty($this->input->post())) {
            $this->data = $this->titulo->get_by_id($id);
        } else {
            if ($this->titulo->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Título modificado');
                redirect('titulos/edit/' . $this->input->post()['Titulo']['empleado_id']);
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }
}