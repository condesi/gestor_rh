<?php defined('BASEPATH') or exit('No direct script access allowed');

class HorasExtrasController extends AdminController
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
            $filtro = array('Empleado.CEDULA LIKE' => $this->input->post('valor'));
        }
        if ($this->input->post('Fopcion') == 2) {
            $filtro = array('Empleado.NOMBRE LIKE' => "%" . $this->input->post('valor') . "%");
        }
        if ($this->input->post('Fopcion') == 3) {
            $filtro = array('Empleado.APELLIDO LIKE' => "%" . $this->input->post('valor') . "%");
        }
        if ($this->input->post('mostrar') == 1) {
            $hoy = date('d-m-Y');
            $ids = $this->horasextra->empleado->contrato->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        'Contrato.FECHA_FIN' => null,
                        'Contrato.FECHA_FIN >' => $hoy
                    ),
                    'AND' => array(
                        'Cargo.NOMBRE' => 'VIGILANTE'
                    )
                )
            ));
            $id_empleados = Set::extract('/Empleado/id', $ids);
        }
    }
    if (isset($id_empleados)) {
        $this->data['empleados'] = $this->empleado->get_all(array(
            'conditions' => array(
                '(link unavailable)' => $id_empleados
            ),
            'contain' => array(
                'Grupo',
                'Contrato' => array(
                    'Cargo',
                    'Departamento',
                    'order' => array(
                        'Contrato.FECHA_INI' => 'desc'
                    )
                )
            )
        ));
    } else {
        $this->data['empleados'] = $this->empleado->get_all(array(
            'contain' => array(
                'Grupo',
                'Contrato' => array(
                    'Cargo',
                    'Departamento',
                    'order' => array(
                        'Contrato.FECHA_INI' => 'desc'
                    )
                )
            )
        ));
    }
    $this->load->view('horasextras/index', $this->data);
}

public function edit($id = null)
{
    if (empty($this->input->post())) {
        $this->data['empleado'] = $this->empleado->get_by_id($id);
        $this->data['horasextras'] = $this->horasextra->get_all(array(
            'conditions' => array(
                'empleado_id' => $id
            )
        ));
        $this->load->view('horasextras/edit', $this->data);
    } else {
        if ($this->horasextra->save($this->input->post())) {
            $this->session->set_flashdata('message', 'Hora extra agregada con éxito');
            redirect('horasextras/edit/' . $this->input->post()['horasextra']['empleado_id']);
        } else {
            $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
        }
    }
}

public function add()
{
    $empleadoId = $this->input->get('empleadoId');
    if (!empty($this->input->post())) {
        if ($this->horasextra->save($this->input->post())) {
            $this->session->set_flashdata('message', 'Hora extra agregada con éxito');
            redirect('horasextras/edit/' . $empleadoId);
        } else {
            $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
        }
    }
}
 public function delete($id)
{
$empleadoid = $this->horasextra->get_by_id($id);
if ($this->horasextra->delete($id)) {
$this->session->set_flashdata('message', 'Hora extra eliminada con éxito');
redirect('horasextras/edit/' . $empleadoid['empleado_id']);
}
}

public function edit_horaextra($id)
{
$this->set("id", $id);
if (empty($this->input->post())) {
$this->data = $this->horasextra->get_by_id($id);
} else {
if ($this->horasextra->save($this->input->post())) {
$this->session->set_flashdata('message', 'Hora extra modificada con éxito');
redirect('horasextras/edit/' . $this->input->post()['horasextra']['empleado_id']);
} else {
$this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
}
}
}
}
