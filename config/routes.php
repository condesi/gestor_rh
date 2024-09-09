<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Rutas del mиоdulo Gestor de Recursos Humanos
$route['gestor_hr'] = 'gestor_hr/index'; // Pивgina principal
$route['gestor_hr/ajustes'] = 'gestor_hr/ajustes'; // Vista de ajustes
$route['gestor_hr/ajustes/add'] = 'gestor_hr/add'; // Vista para agregar ajustes
$route['gestor_hr/empleados'] = 'gestor_hr/empleados'; // Vista de empleados
$route['gestor_hr/empleados/add'] = 'gestor_hr/add_empleado'; // Vista para agregar empleado
$route['gestor_hr/empleados/edit/(:num)'] = 'gestor_hr/edit_empleado/$1'; // Vista para editar empleado
$route['gestor_hr/ajustes/edit/(:num)'] = 'gestor_hr/edit_ajustes/$1';