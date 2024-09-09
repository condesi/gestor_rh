<?php defined('BASEPATH') or exit('No direct script access allowed');

class EmpleadosController extends AdminController
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
        $this->load->view('empleados/index', $this->data);
    }

    public function add()
    {
        if (!empty($this->input->post())) {
            if ($this->empleado->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Empleado agregado con éxito');
                redirect('empleados/index');
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
        $grupos = $this->empleado->grupo->get_all();
        $this->set('grupos', $grupos);
    }

    public function delete($id)
    {
        if ($this->empleado->delete($id)) {
            $this->session->set_flashdata('message', 'Empleado eliminado');
            redirect('empleados/index');
        }
    }

    public function view($id)
    {
        if (!$id) {
            $this->session->set_flashdata('error', 'Empleado inválido');
            redirect('empleados/index');
        }
        $empleado = $this->empleado->get_by_id($id);
        $this->set('empleado', $empleado);
    }

    public function edit($id)
    {
        $this->empleado->id = $id;
        if (empty($this->input->post())) {
            $this->data = $this->empleado->get_by_id($id);
            $grupos = $this->empleado->grupo->get_all();
            $this->set('grupos', $grupos);
        } else {
            if ($this->empleado->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Empleado modificado');
                redirect('empleados/index');
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function listado()
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
        $this->load->view('empleados/listado', $this->data);
    }
}
