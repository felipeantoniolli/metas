<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . 'modules/metas/libraries/component/MetasComponent.php';
include_once APPPATH . 'modules/metas/libraries/component/MetasData.php';

class MetasModel extends MY_Model{

    private $nome;
    private $conteudo;
    private $estado;
    private $html;

    function __construct(){
        parent::__construct('Metas');
    }

    public function get_nome() {
        return $this->nome;
    }
    public function set_nome($nome) {
        $this->nome = $nome;
    }
    public function conteudo() {
        return $this->conteudo;
    }
    public function set_descricao($conteudo) {
        $this->conteudo = $conteudo;
    }
    public function get_estado() {
        return $this->estado;
    }
    public function set_estado($estado) {
        $this->estado = $estado;
    }

    public function get_sprint() {

        $data = new MetasData(1);
        $metas = new MetasComponent($data);
        return $metas->getHtml();
        
    }

    public function inserir() {

        if(sizeof($_POST)) { 
            
            $this->form_validation->set_rules('titulo', 'Titulo', 'required|min_length[5]');
            $this->form_validation->set_rules('conteudo', 'Conteudo', 'required|min_length[1]');

            $dados = array();
            $dados['titulo'] = $this->input->post('titulo');
            $dados['conteudo'] = $this->input->post('conteudo');

            $data = new MetasData(1);
            $metas = new MetasComponent($data);

            $metas->inserir($dados);

        }
    }

    public function editar($id) {

        $data = new MetasData(1);
        $metas = new MetasComponent($data);
        
        if(sizeof($_POST) == 0) {
            $v = $metas->get_by_id($id);
            $_POST = $v[0];
        }
        else {
            
            $dados['titulo'] = $this->input->post('titulo');
            $dados['conteudo'] = $this->input->post('conteudo');
            $dados['id'] = $this->input->post('id');
            $dados['estado'] = $this->input->post('estado');
            $metas->update($id, $dados); 
            redirect("metas");
        }
    }

    public function subir($id) {
        $data = new MetasData(1);
        $metas = new MetasComponent($data);
        $dados = $metas->get_by_id($id);
        $estado = intVal($dados[0]['estado']);
        $estado = $estado - 1;
        $metas->updateEstado($id, $estado); 
    }

    public function descer($id) {
        $data = new MetasData(1);
        $metas = new MetasComponent($data);
        $dados = $metas->get_by_id($id);
        $estado = intVal($dados[0]['estado']);
        $estado = $estado + 1;
        $metas->updateEstado($id, $estado); 
    }

    public function deletar($id) {
        $data = new MetasData(1);
        $metas = new MetasComponent($data);
        $metas->delete($id); 
        redirect("metas");
    }

    public function verifica() {
        $data = new MetasData(1);
        $metas = new MetasComponent($data);
        $result = $metas->verifica();
        return $result;
    }

}