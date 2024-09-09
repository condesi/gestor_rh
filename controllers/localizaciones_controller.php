<?php defined('BASEPATH') or exit('No direct script access allowed');

class LocalizacionesController extends AdminController
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
                'Localizacion' => array(
                    'Departamento'
                ),
                'Contrato' => array(
                    'Cargo',
                    'Departamento',
                    'order' => array(
                        'Contrato.FECHA_INI' => 'desc'
                    )
                )
            )
        ));
        $this->load->view('localizaciones/index', $this->data);
    }

    public function edit($id = null)
    {
        $empleado = $this->empleado->get_by_id($id, array(
            'contain' => array(
                'Localizacion' => array(
                    'Departamento'
                )
            )
        ));
        if (!empty($this->input->post())) {
            if (empty($this->input->post()['Localizacion']['departamento_id'])) {
                $id_loc = $empleado['empleado']['localizacion_id'];
                $this->empleado->update($id, array('localizacion_id' => null));
                $this->localizacion->delete($id_loc);
                $this->session->set_flashdata('message', 'Localización física modificada con éxito');
                redirect('localizaciones/index');
                return;
            } else {
                if ($this->localizacion->save($this->input->post()['Localizacion'])) {
                    $empleado['empleado']['localizacion_id'] = $this->localizacion->id;
                    if ($this->empleado->update($id, $empleado['empleado'])) {
                        $this->session->set_flashdata('message', 'Localización física modificada con éxito');
                        redirect('localizaciones/index');
                    }
                }
            }
        }
        $departamentos = $this->departamento->get_all(array('fields' => array('id', 'nombre')));
        $this->set(compact('departamentos', 'empleado'));
    }
}

