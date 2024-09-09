<?php defined('BASEPATH') or exit('No direct script access allowed');

class HistorialesController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['cargos'] = $this->cargo->get_all(array('contain' => array('Historial' => array('conditions' => array('fecha_fin' => NULL)))));
        $this->load->view('historiales/index', $this->data);
    }

    public function delete($id)
    {
        $cargoid = $this->historial->get_by_id($id);
        if ($this->historial->delete($id)) {
            $this->session->set_flashdata('message', 'Historial eliminado');
            redirect('historiales/edit/' . $cargoid['cargo_id']);
        }
    }

    public function edit($id = null)
    {
        if (empty($this->input->post())) {
            $this->data['historiales'] = $this->historial->get_all(array('cargo_id' => $id));
            $cargo = $this->cargo->get_by_id($id);
            $this->set(compact('historiales', 'cargo'));
        } else {
            if ($this->historial->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Historial agregado');
                redirect('historiales/edit/' . $this->input->post()['historial']['cargo_id']);
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function add()
    {
        $cargoId = $this->input->get('cargoId');
        if (!empty($this->input->post())) {
            if ($this->historial->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Historial agregado');
                redirect('historiales/edit/' . $cargoId);
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function add_group($id)
    {
        $grupo = explode(',', $id);
        $this->set("grupo", $grupo);
        if (!empty($this->input->post())) {
            $error = false;
            $saves = 0;
            foreach ($grupo as $value) {
                $this->historial->create();
                $this->input->post()['historial']['cargo_id'] = $value;
                if ($this->historial->save($this->input->post())) {
                    $saves++;
                } else {
                    $error = true;
                }
            }
            if ($error && $saves != 0) {
                $this->session->set_flashdata('error', 'Ocurrió un error que impidió modificar uno o más cargos');
            }
            if (!$error || $saves != 0) {
                redirect('/cargos/grupo/');
            }
        }
    }
}