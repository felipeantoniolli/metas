<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/builder/ConfigBuilder.php';


class ConfigTableBuilder extends ConfigBuilder{

    function __construct(){
        parent::__construct('metas');
    }

    function get_data(){
        // parâmetros básicos de configuração
        $base = parent::get_data();

        // parâmetros específicos de configuração
        $data = array(
            array(
                'nome' => $this->prefix.'habilitado', 
                'valor' => true,
                'descricao' => 'Indica se o sprint ta iniciado ou não',
                'admin_only' => 0
            ),
            array(
                'nome' => $this->prefix.'nummetas', 
                'valor' => 10,
                'descricao' => 'Determina o valor de metas no sprint',
                'admin_only' => 0
            ),
            array(
                'nome' => $this->prefix.'delhabilitado', 
                'valor' => true,
                'descricao' => 'Define se pode deletar ou não',
                'admin_only' => 0
            )
        );
        
        return array_merge($base, $data);
    }
}
