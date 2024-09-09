<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ajustes_controller extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ajustes_model'); // Cargar el modelo correspondiente
        $data['menu'] = $this->Ajustes_model->get_menu();
        $this->load->vars($data); // Asegúrate de pasar el menú a todas las vistas
    }

    public function index() {
        $filtro = [];
        if (!empty($this->input->post())) {
            $fopcion = $this->input->post('Fopcion');
            $valor = $this->input->post('valor');

            if ($fopcion == 1) {
                $filtro = ['Empleado.CEDULA LIKE' => $valor];
            } elseif ($fopcion == 2) {
                $filtro = ['Empleado.NOMBRE LIKE' => "%$valor%"];
            } elseif ($fopcion == 3) {
                $filtro = ['Empleado.APELLIDO LIKE' => "%$valor%"];
            }
        }

        $this->db->select('*');
        $this->db->from('empleados');
        $this->db->join('contratos', 'contratos.empleado_id = empleados.id', 'left');
        if (!empty($filtro)) {
            $this->db->where($filtro);
        }
        $this->db->limit(20);
        $data['empleados'] = $this->db->get()->result_array();

        $this->load->view('ajustes/index', $data);
    }

    public function edit($id = null) {
        if (empty($this->input->post())) {
            // Cargar datos para editar
            $this->db->select('*');
            $this->db->from('ajustes');
            $this->db->where('empleado_id', $id);
            $data['ajustes'] = $this->db->get()->result_array();

            $this->db->select('*');
            $this->db->from('empleados');
            $this->db->where('id', $id);
            $data['empleado'] = $this->db->get()->row_array();

            $this->load->view('ajustes/edit', $data);
        } else {
            // Guardar cambios
            if ($this->Ajustes_model->save($this->input->post())) {
                $this->session->set_flashdata('success', 'Se ha actualizado con éxito');
            } else {
                $this->session->set_flashdata('error', 'Error al guardar los cambios');
            }
            redirect('gestor_hr/ajustes/edit/' . $this->input->post('empleado_id'));
        }
    }

    public function add() {
        if (!empty($this->input->post())) {
            if ($this->Ajustes_model->save($this->input->post('Ajuste'))) {
                $this->session->set_flashdata('success', 'Ajuste agregado con éxito');
                redirect('gestor_hr/ajustes');
            } else {
                $this->session->set_flashdata('error', 'Error al agregar el ajuste');
            }
        }

        $data['empleadoId'] = $this->input->get('empleadoId');
        $this->load->view('ajustes/add', $data);
    }

    public function delete($id) {
        if ($this->Ajustes_model->delete($id)) {
            $this->session->set_flashdata('success', 'Ajuste eliminado con éxito');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar el ajuste');
        }
        redirect('gestor_hr/ajustes');
    }

    public function view($id) {
        // Obtener el ajuste específico con asignaciones y deducciones
        $this->db->select('Ajuste.*, Asignacion.*, Deduccion.*');
        $this->db->from('ajustes AS Ajuste');
        $this->db->join('asignaciones AS Asignacion', 'Ajuste.id = Asignacion.ajuste_id', 'left');
        $this->db->join('deducciones AS Deduccion', 'Ajuste.id = Deduccion.ajuste_id', 'left');
        $this->db->where('Ajuste.id', $id);
        $data['ajuste'] = $this->db->get()->row_array();

        // Obtener todas las asignaciones y deducciones disponibles
        $data['asignaciones'] = $this->db->get('asignaciones')->result_array();
        $data['deducciones'] = $this->db->get('deducciones')->result_array();

        // Cargar la vista con los datos obtenidos
        $this->load->view('ajustes/view', $data);
    }

    public function edit_ajustes($id = null) {
        if (!empty($this->input->post())) {
            foreach ($this->input->post('Asignacion') as $key => $asignacion) {
                if ($asignacion == 1) {
                    $this->Ajustes_model->habtmAdd('Asignacion', $id, $key);
                } else {
                    $this->Ajustes_model->habtmDelete('Asignacion', $id, $key);
                }
            }
            foreach ($this->input->post('Deduccion') as $key => $deduccion) {
                if ($deduccion == 1) {
                    $this->Ajustes_model->habtmAdd('Deduccion', $id, $key);
                } else {
                    $this->Ajustes_model->habtmDelete('Deduccion', $id, $key);
                }
            }
            $this->session->set_flashdata('success', 'Se ha modificado con éxito');
            redirect('gestor_hr/ajustes/edit/' . $this->input->post('empleado_id'));
        }

        $this->db->select('*');
        $this->db->from('ajustes');
        $this->db->where('id', $id);
        $data['ajuste'] = $this->db->get()->row_array();
        $this->load->view('ajustes/edit_ajustes', $data);
    }
}
?>