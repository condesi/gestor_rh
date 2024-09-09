<?php defined('BASEPATH') or exit('No direct script access allowed');

class ContratosController extends AdminController
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
        $this->load->view('contratos/index', $this->data);
    }

    public function delete($id)
    {
        $empleadoid = $this->contrato->get_by_id($id)->empleado_id;
        if ($this->contrato->delete($id)) {
            $this->session->set_flashdata('message', 'Contrato eliminado con éxito');
            redirect('contratos/edit/' . $empleadoid);
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar');
            redirect('contratos/edit/' . $empleadoid);
        }
    }

    public function edit($id = null)
    {
        if (empty($this->input->post())) {
            $contratos = $this->contrato->get_all(array('empleado_id' => $id));
            $empleado = $this->empleado->get_by_id($id);
            $this->data['contratos'] = $contratos;
            $this->data['empleado'] = $empleado;
            $this->load->view('contratos/edit', $this->data);
        } else {
            if ($this->contrato->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Contrato agregado con éxito');
                redirect('contratos/edit/' . $this->input->post('empleado_id'));
            } else {
                $this->session->set_flashdata('error', 'Error al agregar');
                redirect('contratos/edit/' . $this->input->post('empleado_id'));
            }
        }
    }

    public function add()
    {
        if (!empty($this->input->post())) {
            if ($this->contrato->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Contrato agregado con éxito');
                redirect('contratos/edit/' . $this->input->post('empleado_id'));
            } else {
                $this->session->set_flashdata('error', 'Error al agregar');
                redirect('contratos/add/' . $this->input->post('empleado_id'));
            }
        }
        $cargos = $this->contrato->cargo->get_all();
        $departamentos = $this->contrato->departamento->get_all();
        $this->set("empleadoId", $this->input->post('empleadoId'));
        $this->set(compact('cargos', 'departamentos'));
    }

public function finalizar($id = null)
{
$contrato = $this->contrato->get_by_id($id);
if (!empty($this->input->post())) {
$fecha_fin = $this->input->post('fecha_fin');
$this->input->post('fecha_fin') = $fecha_fin;
if ($this->contrato->save($this->input->post())) {
$this->session->set_flashdata('message', 'Contrato finalizado con éxito');
redirect('contratos/edit/' . $this->input->post('empleado_id'));
} else {
$this->session->set_flashdata('error', 'Error al finalizar');
redirect('contratos/finalizar/' . $id);
}
}
$this->set('contrato', $contrato);
}

}