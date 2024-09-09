<?php defined('BASEPATH') or exit('No direct script access allowed');

class DeduccionesController extends AdminController
{
public function __construct()
{
parent::__construct();
}

public function index()
{
    $this->data['deducciones'] = $this->deduccion->get_all();
    $this->load->view('deducciones/index', $this->data);
}

}
