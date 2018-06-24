<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Run extends MY_Controller{

    /**
     * Página de orientações sobre o uso do módulo
     */
    public function usage(){
        $this->load->model('RunModel', 'model');
        $html = 'about features page';
        $this->show($html);
    }
    
}