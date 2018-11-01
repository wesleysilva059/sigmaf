<?php

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;

//Menu::macro('fullsubmenuexample', function () {
//    return Menu::new()->prepend('<a href="#"><span> Multilevel PROVA </span> <i class="fa fa-angle-left pull-right"></i></a>')
//        ->addParentClass('treeview')
//        ->add(Link::to('/link1prova', 'Link1 prova'))->addClass('treeview-menu')
//        ->add(Link::to('/link2prova', 'Link2 prova'))->addClass('treeview-menu')
//        ->url('http://www.google.com', 'Google');
//});

Menu::macro('adminlteSubmenu', function ($submenuName) {
    return Menu::new()->prepend('<a href="#"><span> ' . $submenuName . '</span> <i class="fa fa-angle-left pull-right"></i></a>')
        ->addParentClass('treeview')->addClass('treeview-menu');
});
Menu::macro('adminlteMenu', function () {
    return Menu::new()
        ->addClass('sidebar-menu')->setAttribute('data-widget','tree');
});
Menu::macro('adminlteSeparator', function ($title) {
    return Html::raw($title)->addParentClass('header');
});

Menu::macro('adminlteDefaultMenu', function ($content) {
    return Html::raw('<i class="fa fa-link"></i><span>' . $content . '</span>')->html();
});

Menu::macro('sidebar', function () {
    return Menu::adminlteMenu()
        ->add(Html::raw('Menu')->addParentClass('header'))
        
        ->action('HomeController@index', '<i class="fa fa-home"></i><span>Inicio</span>')
        
        ->add(Link::to('/resetpassword', '<i class="fa fa-key"></i><span>Redefinir Senha</span>'))

        ->add(Link::to('/users', '<i class="fa fa-user"></i><span>Usuários</span>'))

        ->add(Link::to('/vehicles', '<i class="fa fa-car"></i><span>Veiculos/Máquinas</span>'))

        ->action('HomeController@index', '<i class="fa fa-truck"></i><span>Fornecedores</span>')

        ->add(Link::to('/maintenances', '<i class="fa fa-wrench"></i><span>Manutenções</span>'))

        ->action('HomeController@index', '<i class="fa fa-cog"></i><span>Lubrificações</span>')

        ->action('HomeController@index', '<i class="fa fa-eraser"></i><span>Limpezas</span>')

        ->link('http://www.acacha.org', Menu::adminlteDefaultMenu('Relatórios'))

        ->link('http://www.acacha.org', Menu::adminlteDefaultMenu('Ajuda'))
//        ->url('http://www.google.com', 'Google')
        ->add(Menu::adminlteSeparator('Mensagens'))
        #adminlte_menu
        ->add(Link::toUrl('/contact', '<i class="fa fa-link"></i><span>Caixa de Entrada</span>'))
        ->add(Menu::adminlteSeparator('Cadastros Gerais'))
        ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-share"></i><span>Cadastros</span> <i class="fa fa-angle-left pull-right"></i></a>')
            ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-share"></i><span>Veiculos</span> <i class="fa fa-angle-left pull-right"></i></a>')
                    ->addParentClass('treeview')
                    ->add(Link::to('/makes', 'Fabricantes'))->addClass('treeview-menu')
                    ->add(Link::to('/vehicleModels', 'Modelos'))->addClass('treeview-menu')
                    ->add(Link::to('/vehicleTypes', 'Tipos de Veículos'))->addClass('treeview-menu')
                )
            ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-share"></i><span>Manutenções</span> <i class="fa fa-angle-left pull-right"></i></a>')
                    ->addParentClass('treeview')
                    ->add(Link::to('/filterChangeTypes', 'Tipo de Troca de Filtros'))->addClass('treeview-menu')
                    ->add(Link::to('/oilChangeTypes', 'Tipos de Troca de Oléo'))->addClass('treeview-menu')
                    ->add(Link::to('/machineShops', 'Oficinas'))->addClass('treeview-menu')
                    ->add(Link::to('/maintenanceCategories', 'Categorias de Manutenção'))->addClass('treeview-menu')
                    ->add(Link::to('/maintenanceStatuses', 'Status de Manutenção'))->addClass('treeview-menu')
                )
            ->addParentClass('treeview')
            ->add(Link::to('/departments', 'Sercretárias/Orgãos'))->addClass('treeview-menu')
            ->add(Link::to('/occupations', 'Cargos'))->addClass('treeview-menu')
            ->add(Link::to('/permissions', 'Permissões'))->addClass('treeview-menu')
            ->add(Link::to('/costCenters', 'Centros de custo'))->addClass('treeview-menu')    
        )
//        ->add(
//            Menu::fullsubmenuexample()
//        )
//        ->add(
//            Menu::adminlteSubmenu('Best menu')
//                ->add(Link::to('/acacha', 'acacha'))
//                ->add(Link::to('/profile', 'Profile'))
//                ->url('http://www.google.com', 'Google')
//                ->url('http://www.google.com', 'Google')
//                ->add(Menu::new()->prepend('<a href="#"><span>Multilevel 2</span> <i class="fa fa-angle-left pull-right"></i></a>')
//                ->addParentClass('treeview')
//                ->add(Link::to('/link21', 'Link21'))->addClass('treeview-menu')
//                ->add(Link::to('/link22', 'Link22'))
                
//            )
//        )
        ->setActiveFromRequest();
});
