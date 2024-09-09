<?php defined('BASEPATH') or exit('No direct script access allowed');

class CestaticketsController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $filtro = array();
        if (!empty($this->input->post())) {
            if (!empty($this->input->post('AÑO')) && empty($this->input->post('Fopcion'))) {
                $filtro = array('cestaticket.fecha_ini LIKE' => "%" . $this->input->post('AÑO') . "%");
            }
            if (!empty($this->input->post('Fopcion')) && empty($this->input->post('AÑO'))) {
                $filtro = array('MONTH(cestaticket.fecha_ini)' => $this->input->post('Fopcion'));
            }
            if (!empty($this->input->post('Fopcion')) && !empty($this->input->post('AÑO'))) {
                $filtro = array('MONTH(cestaticket.fecha_ini)' => $this->input->post('Fopcion'), 'cestaticket.fecha_ini LIKE' => "%" . $this->input->post('AÑO') . "%");
            }
        }
        $this->data['cestatickets'] = $this->cestaticket->get_all($filtro);
        $this->load->view('cestatickets/index', $this->data);
    }

    public function add()
    {
        if (!empty($this->input->post())) {
            if ($this->cestaticket->save($this->input->post())) {
                $this->session->set_flashdata('message', 'Cestaticket creada con éxito');
                redirect('cestatickets/index');
            }
            $this->session->set_flashdata('error', $this->cestaticket->error);
        }
        $this->load->view('cestatickets/add');
    }

    public function edit($id = null)
    {
        $cestaticket = $this->cestaticket->get_by_id($id);
        $this->data['cestaticket'] = $cestaticket;
        $this->load->view('cestatickets/edit', $this->data);
    }

    public function delete($id)
    {
        if ($this->cestaticket->delete($id)) {
            $this->session->set_flashdata('message', 'Cestaticket eliminada con éxito');
            redirect('cestatickets/index');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar');
            redirect('cestatickets/index');
        }
    }

    public function generar($id = null)
    {
        $this->autoRender = false;
        if (!empty($this->input->post())) {
            $this->_generar($id);
        }
        $this->render('/cestatickets/loading');
    }

    private function _generar($id = null)
    {
        $this->autoRender = false;
        $this->cestaticket->generarCestaticket($id);
        if ($this->cestaticket->errorMessage != '') {
            $this->session->set_flashdata('error', $this->cestaticket->errorMessage);
        } else {
            $this->session->set_flashdata('message', 'Nómina generada con éxito');
            $this->cestaticket->id = $id;
            $this->cestaticket->saveField('fecha_ela', date("Y-m-d H:i:s"));
        }
        redirect('cestatickets/edit/' . $id);
    }

    public function mostrar()
    {
        $this->autoRender = false;
        if (!empty($this->input->post())) {
            $id = $this->input->post('cestaticket_id');
            $cestaticket = $this->cestaticket->get_by_id($id);
            $mes = $cestaticket['cestaticket']['MES'];
            $año = $cestaticket['cestaticket']['AÑO'];
            if (empty($this->input->post('PERSONAL')) || empty($this->input->post('VISUALIZAR'))) {
                $this->session->set_flashdata('error', 'Debe seleccionar el personal y el modo de visualizar');
                $this->render('error', 'nomina');
                return;
            } else {
                if ($this->input->post('PERSONAL') == '1') {
                    $grupo = 'Empleado'; // Empleado
                    $modalidad = 'Fijo';
                } 
                
                if ($this->input->post('PERSONAL') == '2') {
                    $grupo = 'Obrero'; // Obrero
                    $modalidad = 'Fijo';
                }
                if ($this->input->post('PERSONAL') == '3') {
                    $grupo = array('Empleado', 'Obrero'); // Empleado y Obrero
                    $modalidad = 'Contratado';
                }
                $empleados = $this->cestaticket->mostrarCestaticket($id, $grupo, $modalidad);
                $resumen = $this->cestaticket->calcularResumen($empleados);
            }
            if (empty($empleados)) {
                $this->render('error', 'nomina');
                if ($this->cestaticket->errorMessage == '') {
                    $this->session->set_flashdata('error', 'Actualmente no existen datos relacionados a esta nómina, Genere la Nómina primero');
                } else {
                    $this->session->set_flashdata('error', $this->cestaticket->errorMessage);
                }
                return;
            }
            if ($this->input->post('VISUALIZAR') == 'Pantalla') {
                $this->set('empleados', $empleados);
                $this->render('pantalla_cestaticket', 'nomina');
            }
            if ($this->input->post('VISUALIZAR') == 'Archivo') {
                $this->set(compact('empleados', 'modalidad', 'grupo', 'mes', 'año', 'resumen'));
                $this->render('archivo_cestaticket', 'nominaExcel');
            }
        }
    }

    public function dia_adicional($id = null)
    {
        $filtro = array();
        if (!empty($this->input->post())) {
            $id = $this->input->post('cestaticket_id');
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
        $ids = $this->cestaticket->DetalleCestaticket->Empleado->find('all', array(
            'recursive' => 0,
            'conditions' => $filtro,
            'fields' => array('id')
        ));
        $id_empleados = Set::extract('/Empleado/id', $ids);
        $this->paginate = array(
            'DetalleCestaticket' => array(
                'limit' => 20,
                'conditions' => array(
                    'cestaticket_id' => $id,
                    'empleado_id' => $id_empleados,
                ),
                'contain' => array(
                    'Empleado' => array(
                        'Grupo',
                        'Contrato' => array(
                            'Cargo',
                            'Departamento',
                            'order' => array(
                                'Contrato.FECHA_INI' => 'desc'
                            ),
                        )
                    )
                )
            )
        );
        $data = $this->paginate('DetalleCestaticket');
        if (!empty($data)) {
            $this->set('empleados', $data);
        } else {
            $this->session->set_flashdata('error', 'Actualmente no existen datos relacionados a esta nómina, Genere la Nómina primero');
            redirect('cestatickets/edit/' . $id);
        }
    }

    public function add_dia_adicional($id = null)
    {
        $data = $this->cestaticket->DetalleCestaticket->find('first', array(
            'conditions' => array(
                '(link unavailable)' => $id
            ),
            'contain' => array(
                'Cestaticket'
            )
        ));
        $data['DetalleCestaticket']['DIAS_ADICIONALES']++;
        $data['DetalleCestaticket']['TOTAL'] += $data['Cestaticket']['VALOR_DIARIO'];
        $this->cestaticket->DetalleCestaticket->save($data['DetalleCestaticket']);
        redirect('cestatickets/dia_adicional/' . $data['DetalleCestaticket']['cestaticket_id']);
    } public function remove_dia_adicional($id = null)
{
    $data = $this->cestaticket->DetalleCestaticket->find('first', array(
        'recursive' => 0,
        'conditions' => array(
            '(link unavailable)' => $id
        )
    ));
    if ($data['DetalleCestaticket']['DIAS_ADICIONALES'] - 1 >= 0) {
        $data['DetalleCestaticket']['DIAS_ADICIONALES']--;
        $data['DetalleCestaticket']['TOTAL'] -= $data['Cestaticket']['VALOR_DIARIO'];
        $this->cestaticket->DetalleCestaticket->save($data['DetalleCestaticket']);
    }
    redirect('cestatickets/dia_adicional/' . $data['DetalleCestaticket']['cestaticket_id']);
}

public function bloquear($id = null)
{
    $this->cestaticket->id = $id;
    $this->cestaticket->saveField('BLOQUEAR', 1);
    redirect('cestatickets/edit/' . $id);
}

}
