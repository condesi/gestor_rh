<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Gestor de Recursos Humanos
Description: Módulo para la gestión de empleados y recursos humanos en Perfex.
Version: 1.0.0
Requires at least: 2.3.*
Author: Tu Nombre
Author URI: https://tu-sitio-web.com
*/

define('GESTOR_HR_MODULE_NAME', 'gestor_hr');

// Hooks para inicializar permisos y componentes del módulo
hooks()->add_action('admin_init', 'gestor_hr_permissions');
hooks()->add_action('admin_init', 'gestor_hr_module_init_menu_items');
hooks()->add_action('app_admin_head', 'gestor_hr_add_head_components');
hooks()->add_action('app_admin_footer', 'gestor_hr_add_footer_components');

/**
 * Register activation module hook
 */
register_activation_hook(GESTOR_HR_MODULE_NAME, 'gestor_hr_module_activation_hook');

/**
 * Hook de activación del módulo
 */
function gestor_hr_module_activation_hook() {
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');

    // Verificar si la tabla 'gestor_hr_empleados' fue creada
    $query = $CI->db->query("SHOW TABLES LIKE 'gestor_hr_empleados'");
    if ($query->num_rows() > 0) {
        // La instalación fue exitosa
        log_message('info', 'Módulo Gestor HR activado correctamente.');
    } else {
        // Manejo de errores durante la activación
        log_message('error', 'Error al activar el módulo Gestor HR: tabla no creada.');
    }
}

/**
 * Inicializa los elementos del menú del módulo
 */
function gestor_hr_module_init_menu_items() {
    $CI = &get_instance();
    
    if (has_permission('gestor_hr', '', 'view')) {
        // Agregar menú principal
        $CI->app_menu->add_sidebar_menu_item('gestor_hr', [
            'name' => _l('gestor_hr'),
            'icon' => 'fa fa-users',
            'href' => admin_url('gestor_hr/ajustes'),
        ]);
        
        // Agregar menú para empleados
        $CI->app_menu->add_sidebar_children_item('gestor_hr', [
            'slug' => 'gestor_hr_empleados',
            'name' => _l('empleados'),
            'icon' => 'fa fa-user',
            'href' => admin_url('gestor_hr/empleados'),
        ]);

        // Agregar menú para ajustes
        $CI->app_menu->add_sidebar_children_item('gestor_hr', [
            'slug' => 'gestor_hr_ajustes',
            'name' => _l('ajustes'),
            'icon' => 'fa fa-cog',
            'href' => admin_url('gestor_hr/ajustes'),
        ]);
    }
}

/**
 * Define los permisos del módulo
 */
function gestor_hr_permissions() {
    $capabilities = [];
    $capabilities['capabilities'] = [
        'view'   => _l('permission_view') . ' (' . _l('permission_global') . ')',
        'create' => _l('permission_create'),
        'edit'   => _l('permission_edit'),
        'delete' => _l('permission_delete'),
    ];

    register_staff_capabilities('gestor_hr', $capabilities, _l('gestor_hr'));
}

/**
 * Agrega componentes CSS en el encabezado
 */
function gestor_hr_add_head_components() {
    echo '<link href="' . module_dir_url(GESTOR_HR_MODULE_NAME, 'assets/css/gestor_hr.css') . '" rel="stylesheet" type="text/css" />';
}

/**
 * Agrega componentes JavaScript en el pie de página
 */
function gestor_hr_add_footer_components() {
    echo '<script src="' . module_dir_url(GESTOR_HR_MODULE_NAME, 'assets/js/gestor_hr.js') . '"></script>';
}