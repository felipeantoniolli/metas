<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . 'libraries/util/CI_Object.php';

class MetasComponent extends CI_Object {

    private $data;
    private $habilitado;
    private $nummetas;
    private $delhabilitado;
    private $dados = array();

    public function __construct (MetasData $data) {
        parent::__construct();
        $this->data = $data;
        $this->habilitado = $data->habilitado ? 1 : 0;
        $this->nummetas = $data->nummetas;
        $this->delhabilitado = $data->delhabilitado ? 1 : 0;
    }

    public function getItens() {

        $rs = $this->db->get('metas');
        return $rs->result();;

    }

    public function inserir($dados) {

        $metas = $this->db->get('metas');
        $metas = $metas->result();
        $id = 0;

        foreach($metas as $index) {
            if(is_null($index->id)) {
                $id = 0; 
             } else {
                $id = $index->id;
             }
        }
        $id = $id + 1;
       
        

        $rs = "INSERT into metas (id,titulo, conteudo, estado) values ('".$id."', '" .$dados['titulo'] . "', '". $dados['conteudo'] . "', '0')";
        $this->db->query($rs);

    }

    public function update ($id, $dados) {
        $this->db->update('metas', 
        array('titulo' => $dados['titulo'], 'conteudo' => $dados['conteudo']), "id = $id");
    }
    
    public function updateEstado ($id, $estado) {
        $this->db->update('metas', 
        array('estado' => $estado), "id = $id");
    }

    public function delete($id) {
        $this->db->delete('metas', array('id' => $id));
    }

    public function get_by_id($id){
        $sql = "SELECT * FROM metas WHERE id = $id";
        $res = $this->db->query($sql);

        return $res->result_array();    
    }

    public function verifica() { 
        $metas = $this->db->get('metas');
        $metas = $metas->result();
        $i = 0;
        foreach($metas as $index) {
            if($index->estado < 5) {
                $i++;
            }
        }
        if($this->nummetas >= $i) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function getHTML () {

        if ($this->habilitado) {
           
            $this->dados = $this->getItens();

            $html = '';

            $html .= '<div class="container">';
            $html .= '<div class="card">';
            $html .= '<h3 class="card-header primary-color white-text" style="text-align: center;">Para Fazer</h3>';
            $html .= '<div class="card-body">';
            $html .= '<table class="table">';
            $html .= '<thead class="blue-grey lighten-4"><tr><th>#</th><th>Titulo</th><th style="width:400px">Conteudo</th><th style="width:200px">Opções</th></tr></thead>';
            $html .= '<tbody>';
            foreach ($this->dados as $index) {
                if($index->estado == 1){
                    $html .= '<th scope="row">'.$index->id . '</th>
                    <td> ' . $index->titulo . ' </td>
                    <td style="width:400px"> ' . $index->conteudo . '</td>
                    <td style="width:200px">
                    <div class="btn-group mr-2" role="group" aria-label="...">
                    <a href="'.base_url("/metas/descer/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-success" role="group">
                    Descer</button></a>
                    <a href="'.base_url("/metas/subir/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-warning" role="group">BackLog</button></a>
                    <a href="'.base_url("/metas/editar/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-primary" role="group">
                    Editar</button></a>';
                    if($this->delhabilitado == 1){
                    $html .= '<a href="'.base_url("/metas/deletar/$index->id").'">';
                    $html .= '<button type="button" class="btn btn-group btn-sm btn-danger" role="group">Deletar</button></a>';
                    }
                    $html .= '</td></th></div></tbody>';
                }
            }
            $html .= '</table></div></div><br>';
            
            $html .= '<div class="card">';
            $html .= '<h3 class="card-header warning-color white-text" style="text-align: center;">Em Progresso</h3>';
            $html .= '<div class="card-body">';
            $html .= '<table class="table">';
            $html .= '<thead class="blue-grey lighten-4"><tr><th>#</th><th>Titulo</th><th style="width:400px">Conteudo</th><th style="width:200px">Opções</th></tr></thead>';
            $html .= '<tbody>';
            foreach ($this->dados as $index) {
                if($index->estado == 2){
                    $html .= '<th scope="row">'.$index->id . '</th>
                    <td> ' . $index->titulo . ' </td>
                    <td style="width:400px"> ' . $index->conteudo . '</td>
                    <td style="width:200px">
                    <div class="btn-group mr-2" role="group" aria-label="...">
                    <a href="'.base_url("/metas/descer/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-success" role="group">
                    Descer</button></a>
                    <a href="'.base_url("/metas/subir/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-warning" role="group">Subir</button></a>
                    <a href="'.base_url("/metas/editar/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-primary" role="group">
                    Editar</button></a>';
                    if($this->delhabilitado == 1){
                    $html .= '<a href="'.base_url("/metas/deletar/$index->id").'">';
                    $html .= '<button type="button" class="btn btn-group btn-sm btn-danger" role="group">Deletar</button></a>';
                    }
                    $html .= '</td></th></div></tbody>';
                }
            }
            $html .= '</table></div></div><br>';
            
            $html .= '<div class="card">';
            $html .= '<h3 class="card-header success-color white-text" style="text-align: center;">Concluido</h3>';
            $html .= '<div class="card-body">';
            $html .= '<table class="table">';
            $html .= '<thead class="blue-grey lighten-4"><tr><th>#</th><th>Titulo</th><th style="width:400px">Conteudo</th><th style="width:200px">Opções</th></tr></thead>';
            $html .= '<tbody>';
            foreach ($this->dados as $index) {
                if($index->estado == 3){
                    $html .= '<th scope="row">'.$index->id . '</th>
                    <td> ' . $index->titulo . ' </td>
                    <td style="width:400px"> ' . $index->conteudo . '</td>
                    <td style="width:200px">
                    <div class="btn-group mr-2" role="group" aria-label="...">
                    <a href="'.base_url("/metas/subir/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-warning" role="group">Subir</button></a>
                    <a href="'.base_url("/metas/editar/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-primary" role="group">
                    Editar</button></a>';
                    if($this->delhabilitado == 1){
                    $html .= '<a href="'.base_url("/metas/deletar/$index->id").'">';
                    $html .= '<button type="button" class="btn btn-group btn-sm btn-danger" role="group">Deletar</button></a>';
                    }
                    $html .= '</td></th></div></tbody>';
                }
            }
            $html .= '</table></div></div><br>';
            
            $html .= '<div class="card">';
            $html .= '<h3 class="card-header danger-color white-text" style="text-align: center;">BackLog</h3>';
            $html .= '<div class="card-body">';
            $html .= '<table class="table">';
            $html .= '<thead class="blue-grey lighten-4"><tr><th>#</th><th>Titulo</th><th style="width:400px">Conteudo</th><th style="width:200px">Opções</th></tr></thead>';
            $html .= '<tbody>';
            foreach ($this->dados as $index) {
                if($index->estado == 0){
                    $html .= '<th scope="row">'.$index->id . '</th>
                    <td> ' . $index->titulo . ' </td>
                    <td style="width:400px"> ' . $index->conteudo . '</td>
                    <td style="width:200px">
                    <div class="btn-group mr-2" role="group" aria-label="...">
                    <a href="'.base_url("/metas/descer/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-warning" role="group">Topo</button></a>
                    <a href="'.base_url("/metas/editar/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-primary" role="group">
                    Editar</button></a>';
                    if($this->delhabilitado == 1){
                    $html .= '<a href="'.base_url("/metas/deletar/$index->id").'">';
                    $html .= '<button type="button" class="btn btn-group btn-sm btn-danger" role="group">Deletar</button></a>';
                    }
                    $html .= '</td></th></div></tbody>';
                }
            }
            $html .= '</table></div></div></div><br>';
            return $html;

        } else {
            return '<h3 class="card title" style="text-align: center">Sprint Desabilitado</h3>';
        }
    }
}