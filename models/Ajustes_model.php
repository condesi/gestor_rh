<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ajustes_model extends PerfexModel {

    public function getRelations() {
        return [
            'empleado' => [
                'type' => 'belongsTo',
                'model' => 'Empleado',
                'foreign_key' => 'empleado_id',
            ],
            'asignaciones' => [
                'type' => 'hasMany',
                'model' => 'Asignacion',
                'foreign_key' => 'ajuste_id',
            ],
            'deducciones' => [
                'type' => 'hasMany',
                'model' => 'Deduccion',
                'foreign_key' => 'ajuste_id',
            ],
        ];
    }

    public function getBelongsTo() {
        return [
            'empleado_id' => 'Empleado',
        ];
    }

    public function beforeSave($data) {
        // Determinar las fechas de inicio y fin
        if (!empty($data['ajuste_mes_inicio']) && !empty($data['ajuste_año_inicio'])) {
            $data['fecha_ini'] = $data['ajuste_año_inicio'] . '-' . $data['ajuste_mes_inicio'] . 
                ($data['quincena_inicio'] == 'Primera' ? '-1' : '-16');
        }

        if (!empty($data['ajuste_mes_fin']) && !empty($data['ajuste_año_fin'])) {
            if ($data['quincena_fin'] == 'Primera') {
                $data['fecha_fin'] = $data['ajuste_año_fin'] . '-' . $data['ajuste_mes_fin'] . '-15';
            } else {
                $date = new DateTime("{$data['ajuste_año_fin']}-{$data['ajuste_mes_fin']}-01");
                $date->modify('last day of this month');
                $data['fecha_fin'] = $date->format('Y-m-d');
            }
        } else {
            $data['fecha_fin'] = null; // Establece null si no se proporcionan fechas
        }

        return $data;
    }

    public function afterFind($results) {
        foreach ($results as $key => $val) {
            if (isset($val['fecha_ini'])) {
                $results[$key]['fecha_ini'] = formatoFechaAfterFind($val['fecha_ini']);
            }
            if (isset($val['fecha_fin'])) {
                $results[$key]['fecha_fin'] = formatoFechaAfterFind($val['fecha_fin']);
            }
        }
        return $results;
    }

    public function customValidation($check) {
        if (empty($check['empleado_id'])) {
            $this->errorMessage = "El empleado es requerido.";
            return false;
        }
        return true;
    }

    public function ajusteAño($check) {
        if (empty($check['ajuste_año_inicio']) || empty($check['ajuste_año_fin'])) {
            $this->errorMessage = "Los años de inicio y fin son requeridos.";
            return false;
        }

        if (!is_numeric($check['ajuste_año_inicio']) || !is_numeric($check['ajuste_año_fin'])) {
            $this->errorMessage = "Los años deben ser numéricos.";
            return false;
        }

        if ($check['ajuste_año_inicio'] > $check['ajuste_año_fin']) {
            $this->errorMessage = "El año de inicio no puede ser mayor que el año de fin.";
            return false;
        }

        return true;
    }

    public function get_all() {
        $this->db->select('*');
        $this->db->from('ajustes');
        return $this->db->get()->result_array();
    }

    public function get($id) {
        $this->db->select('*');
        $this->db->from('ajustes');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function save($data) {
        $data = $this->beforeSave($data);
        if ($data === false) {
            return false; // Return if validation fails
        }

        if (!$this->customValidation($data) || !$this->ajusteAño($data)) {
            return false; // Return if custom validation fails
        }

        if (isset($data['id']) && !empty($data['id'])) {
            // Actualizar
            $this->db->where('id', $data['id']);
            return $this->db->update('ajustes', $data);
        } else {
            // Insertar
            return $this->db->insert('ajustes', $data);
        }
    }

    public function delete($id) {
        return $this->db->delete('ajustes', array('id' => $id));
    }

    public function get_asignaciones($ajuste_id) {
        $this->db->select('*');
        $this->db->from('asignaciones');
        $this->db->where('ajuste_id', $ajuste_id);
        return $this->db->get()->result_array();
    }

    public function get_deducciones($ajuste_id) {
        $this->db->select('*');
        $this->db->from('deducciones');
        $this->db->where('ajuste_id', $ajuste_id);
        return $this->db->get()->result_array();
    }
}