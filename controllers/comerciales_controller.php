<?php defined('BASEPATH') or exit('No direct script access allowed');

class ComercialesController extends AdminController
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
                $filtro = array('empleado.cedula LIKE' => $this->input->post('valor'));
            }
            if ($this->input->post('Fopcion') == 2) {
                $filtro = array('empleado.nombre LIKE' => "%" . $this->input->post('valor') . "%");
            }
            if ($this->input->post('Fopcion') == 3) {
                $filtro = array('empleado.apellido LIKE' => "%" . $this->input->post('valor') . "%");
            }
        }
        $this->data['empleados'] = $this->empleado->get_all($filtro);
        $this->load->view('comerciales/index', $this->data);
    }

    public function edit($id = null)
    {
        if (empty($this->input->post())) {
            $comerciales = $this->comercial->get_all(array('empleado_id' => $id));
            $empleado = $this->empleado->get_by_id($id);
            $this->data['comerciales'] = $comerciales;
            $this->data['empleado'] = $empleado;
            $this->load->view('comerciales/edit', $this->data);
        }
    }

    public function delete($id)
    {
        $empleadoid = $this->comercial->get_by_id($id)->empleado_id;
        if ($this->comercial->delete($id)) {
            $this->session->set_flashdata('message', 'Crédito eliminado con éxito');
            redirect('comerciales/edit/' . $empleadoid);
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar');
            redirect('comerciales/edit/' . $empleadoid);
        }
    }

    public function add($id = null)
    {
        $this->set("empleadoId", $this->input->post('empleadoId'));
        if (!empty($this->input->post())) {
            if ($this->comercial->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Crédito agregado con éxito');
                redirect('comerciales/edit/' . $this->input->post('empleadoId'));
            } else {
                $this->session->set_flashdata('error', 'Error al agregar');
                redirect('comerciales/add/' . $this->input->post('empleadoId'));
            }
        }
    }
}
