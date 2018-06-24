<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/builder/TableBuilder.php';

class MetasTableBuilder extends TableBuilder{

    public function __construct(){
        parent::__construct('metas');
    }

    function get_fields(){
        $fields['id'] = array('type' => 'int', 'constraint', 'primary key' =>  11);
        $fields['titulo'] = array('type' => 'VARCHAR', 'constraint' =>  150);
        $fields['conteudo'] = array('type' => 'VARCHAR', 'constraint' =>  500);
        $fields['estado'] = array('type' => 'int', 'constraint' =>  11);

        return $fields;
    }

    function get_data(){
        // para inserir um registro na tabela jumbotron...
        $data[] = array(
            'id' => 1,
            'titulo' => 'Primeira Meta', 
            'conteudo' => 'Esta é uma meta teste para fazer', 
            'estado' => 1
        );
        $data[] = array(
            'id' => 2,
            'titulo' => 'Meta em progresso', 
            'conteudo' => 'Esta é uma meta em progresso', 
            'estado' => 2
        );
        $data[] = array(
            'id' => 3,
            'titulo' => 'Meta concluida', 
            'conteudo' => 'Esta é uma meta concluida', 
            'estado' => 3
        );
        $data[] = array(
            'id' => 4,
            'titulo' => 'Meta no BackLog', 
            'conteudo' => 'Esta é uma meta no Backlog', 
            'estado' => 0
        );


        return $data;
    }

}