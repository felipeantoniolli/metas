<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Metas extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('MetasModel', 'metas');
        $this->menu_itens = $this->metas->get_menu_itens();
    }

    /**
     * Página inicial do módulo; exibe sua funcionalidade principal. Além desta, um
     * módulo pode ter outras páginas, de acordo com sua finalidade. O importante é
     * lembrar que um módulo deve estar focado em fazer, bem feito e de forma flexível, 
     * apenas uma tarefa.
     */
    public function index(){
        $html = 'Local do Sprint';
        $html = $this->metas->get_sprint();
        $this->show($html);
    }

    /**
     * Página de configuração do conteúdo exibido nas páginas de funcionalidades do módulo
    */

    public function inserir(){
        $data['action'] = $this->metas->inserir();
        $data['titulo'] = 'Inserir';
        $data['meta'] = $this->metas->verifica();
        if($data['meta'] == 1) {
            $html = $this->load->view("inserir", $data);
        } else {
            $html = $this->load->view("aviso", $data);
        }
        $this->show($html);
    }

    public function editar($id) {
        $this->metas->editar($id);
        $data['action'] = $id;
        $data['titulo'] = 'Editar';
        $html = $this->load->view("inserir", $data, true);
        $this->show($html);
    }

    public function deletar($id) {
        $this->metas->deletar($id);
        redirect('metas');
    }

    public function subir($id) {
        $this->metas->subir($id);
        redirect('metas');
    }
    
    public function descer($id) {
        $this->metas->descer($id);
        redirect('metas');
    }
}