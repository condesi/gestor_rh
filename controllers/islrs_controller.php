<?php defined('BASEPATH') or exit('No direct script access allowed');

class IslrsController extends AdminController
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
                $filtro = array('Empleado.DNI LIKE' => $this->input->post('valor'));
            }
            if ($this->input->post('Fopcion') == 2) {
                $filtro = array('Empleado.NOMBRE LIKE' => "%" . $this->input->post('valor') . "%");
            }
            if ($this->input->post('Fopcion') == 3) {
                $filtro = array('Empleado.APELLIDO LIKE' => "%" . $this->input->post('valor') . "%");
            }
        }
        $this->data['empleados'] = $this->empleado->get_all(array(
            'conditions' => $filtro,
            'contain' => array(
                'Grupo',
                'Contrato' => array(
                    'Cargo',
                    'Departamento',
                    'conditions' => array(
                        'FECHA_FIN' => NULL
                    )
                )
            )
        ));
        $this->load->view('islrs/index', $this->data);
    }

    public function edit($id = null)
    {
        if (empty($this->input->post())) {
            $this->data['islrs'] = $this->islr->get_all(array(
                'conditions' => array(
                    'empleado_id' => $id
                ),
                'order' => array(
                    'Islr.FECHA' => 'desc'
                )
            ));
            $empleado = $this->empleado->get_by_id($id);
            $this->set(compact('islrs', 'empleado'));
        } else {
            if ($this->islr->save($this->input->post())) {
                $this->session->set_flashdata('message', 'ISLR agregada con éxito');
                redirect('islrs/edit/' . $this->input->post()['islr']['empleado_id']);
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }

    public function delete($id)
    {
        $empleadoid = $this->islr->get_by_id($id);
        if ($this->islr->delete($id)) {
            $this->session->set_flashdata('message', 'ISLR eliminada con éxito');
            redirect('islrs/edit/' . $empleadoid['empleado_id']);
        }
    }

    public function add()
    {
        $empleadoId = $this->input->get('empleadoId');
        if (!empty($this->input->post())) {
            if ($this->islr->save($this->input->post())) {
                $this->session->set_flashdata('message', 'ISLR agregada con éxito');
                redirect('islrs/edit/' . $empleadoId);
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }
}

