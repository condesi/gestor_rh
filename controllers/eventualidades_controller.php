<?php defined('BASEPATH') or exit('No direct script access allowed');

class EventualidadesController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['eventualidades'] = $this->eventualidad->get_all();
        $this->load->view('eventualidades/index', $this->data);
    }

    public function add()
    {
        if (!empty($this->input->post())) {
            if ($this->eventualidad->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Eventualidad agregada con éxito');
                redirect('eventualidades/index');
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function delete($id)
    {
        if ($this->eventualidad->delete($id)) {
            $this->session->set_flashdata('message', 'Eventualidad eliminada');
            redirect('eventualidades/index');
        }
    }

    public function listado($id = null)
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
        $this->load->view('eventualidades/listado', $this->data);
    }

    public function editar($eventualidad_id, $empleado_id)
    {
        $empleado = $this->empleado->get_by_id($empleado_id);
        $eventualidad = $this->eventualidad->get_by_id($eventualidad_id);
        $this->data['eventualidades'] = $this->eventualidad->detalle_eventualidad->get_all(array('empleado_id' => $empleado_id, 'eventualidad_id' => $eventualidad_id));
        $this->set(compact('empleado', 'eventualidades', 'eventualidad_id', 'eventualidad'));
    }

    public function asignar($eventualidad_id, $empleado_id)
    {
        if (!empty($this->input->post())) {
            if ($this->eventualidad->detalle_eventualidad->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Eventualidad agregada con éxito');
                redirect('eventualidades/editar/' . $eventualidad_id . '/' . $empleado_id);
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function quitar($id)
    {
        $detalle = $this->eventualidad->detalle_eventualidad->get_by_id($id);
        if ($this->eventualidad->detalle_eventualidad->delete($id)) {
            $this->session->set_flashdata('message', 'Eventualidad eliminada');
            redirect('eventualidades/editar/' . $detalle['eventualidad_id'] . '/' . $detalle['empleado_id']);
        }
    }
}
