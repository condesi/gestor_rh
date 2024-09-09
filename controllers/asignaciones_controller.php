<?php defined('BASEPATH') or exit('No direct script access allowed');

class AsignacionesController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['asignaciones'] = $this->asignacion->get_all();
        $this->load->view('asignaciones/index', $this->data);
    }
}
