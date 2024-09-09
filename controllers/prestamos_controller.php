<?php defined('BASEPATH') or exit('No direct script access allowed');

class PrestamosController extends AdminController
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
                    'order' => array(
                        'Contrato.FECHA_INI' => 'desc'
                    )
                )
            )
        ));
        $this->load->view('prestamos/index', $this->data);
    }

    public function edit($id = null)
    {
        if (empty($this->input->post())) {
            $prestamos = $this->prestamo->get_all(array(
                'conditions' => array(
                    'empleado_id' => $id
                ),
                'order' => array(
                    'Prestamo.FECHA' => 'desc'
                )
            ));
            $empleado = $this->empleado->get_by_id($id, array(
                'contain' => array(
                    'Grupo'
                )
            ));
            $this->set(compact('prestamos', 'empleado'));
        }
    }

    public function delete($id)
    {
        $empleadoid = $this->prestamo->get_by_id($id, array(
            'fields' => array(
                'Prestamo.empleado_id'
            )
        ));
        if ($this->prestamo->delete($id)) {
            $this->session->set_flashdata('message', 'Se ha eliminado con éxito');
            redirect('prestamos/edit/' . $empleadoid['Prestamo']['empleado_id']);
        }
    }

    public function add()
    {
        $this->set("empleadoId", $this->uri->segment(3));
        if (!empty($this->input->post())) {
            if ($this->prestamo->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Préstamo agregado con éxito');
                redirect('prestamos/edit/' . $this->input->post()['Prestamo']['empleado_id']);
            } else {
                $this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
            }
        }
    }
}
