<?php

return [

   //tituloss

    'title' => 'AdminLTE 2',

    'title_prefix' => '',

    'title_postfix' => '',

    //logos

    'logo' => '<b>Sou</b>Thern',

    'logo_mini' => '<b></b>',

    //Skin color

    'skin' => 'blue',

    //Layout

    'layout' => null,


    //URLSs
    'collapse_sidebar' => false,


    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    //Menu itemss

    'menu' => [
        'ADMINISTRADOR',

        [
            'text' => 'Inicio',
            'url' => 'home',
            'icon' => 'fas fa-fw fas fa-home'
        ],

        [
            'text' => 'Unidades Mineras',
            'url' => 'unities',
            'icon' => 'fas fa-fw far fa-building'
        ],


        [
            'text' => 'Compañias',
            'url' => 'companies',
            'icon' => 'fas fa-fw far fa-building'
        ],

        [
            'text' => 'Curso',
            'url' => 'courses',
            'icon' => 'fa fa-list-alt"'
        ],
        [
            'text' => 'Tipo Curso',
            'url' => 'type_courses',
            'icon' => 'fa fa-list-alt"'
        ],


        'CONFIGURACIÓN',

        [
            'text' => 'Usuarios',
            'url' => 'users',
            'icon' => 'fas fa-fw fa fa-users'
        ],
        [
            'text' => 'Roles',
            'url' => 'roles',
            'icon' => 'fas fa-fw fa-list'
        ],
        [
            'text' => 'Inscripciones',
            'url' => 'inscriptions',
            'icon' => 'fas fa-fw fa-list'
        ],
        [
            'text' => 'Permisos',
            'url' => 'roles',
            'icon' => 'fas fa-fw fa-unlock-alt'
        ],


],



    // Menu Filters


    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    //Plugins

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
