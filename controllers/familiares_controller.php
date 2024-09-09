<?php defined('BASEPATH') or exit('No direct script access allowed');

class FamiliaresController extends AdminController
{
public function __construct()
{
parent::__construct();
}

public function index()
{
// No implementado
}

public function edit($id = null)
{
if (empty($this->input->post())) {
$this->data['familiares'] = $this->familiar->get_all(array('empleado_id' => $id));
$empleado = $this->empleado->get_by_id($id);
$this->set(compact('empleado', 'familiares'));
}
}

public function add()
{
$empleadoId = $this->input->get('empleadoId');
if (!empty($this->input->post())) {
unset($this->familiar->id);
if ($this->familiar->save($this->input->post())) {
$this->session->set_flashdata('message', 'Familiar agregado con éxito');
redirect('familiares/edit/' . $empleadoId);
} else {
$this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
}
}
}

public function delete($id)
{
$empleadoid = $this->familiar->get_by_id($id);
if ($this->familiar->delete($id)) {
$this->session->set_flashdata('message', 'Familiar eliminado con éxito');
redirect('familiares/edit/' . $empleadoid['empleado_id']);
}
}

public function edit_familiar($id)
{
$this->set("id", $id);
if (empty($this->input->post())) {
$this->data = $this->familiar->get_by_id($id);
} else {
if ($this->familiar->save($this->input->post())) {
$this->session->set_flashdata('message', 'Familiar modificado con éxito');
redirect('familiares/edit/' . $this->input->post()['Familiar']['empleado_id']);
} else {
$this->session->set_flashdata('error', 'Existen errores, corríjalos antes de continuar');
}
}
}

}

