<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corbeil extends CI_Controller {

	public function check(){
		if(!$this->ivtmodel->is_logged()){
			redirect('login/');//redirection vers le controlleur login
			exit;//sortie de code
		}
	}

	public function index()
	{
		$this->check();
		$data = array(
			'title'=> "O'mel | Corbeil", //titre de la page
			'content'=>'corbeil', //vue à afficher
		);
		$this->load->view('template/content', $data);
	}

	public function tableCorbeilAjax(){
		$search = array_merge($this->ivtmodel->get_search_data('depenses', $_POST['start'], $_POST['length'], $_POST['search']['value'], 2), $this->ivtmodel->get_search_data('recettes', $_POST['start'], $_POST['length'], $_POST['search']['value'], 2), $this->ivtmodel->get_search_data('designations', $_POST['start'], $_POST['length'], $_POST['search']['value'], 2));
		$output = array(  
                "draw"  => intval($_POST["draw"]),  
                "recordsTotal" => $this->ivtmodel->count_search_data('depenses', NULL, 2) + $this->ivtmodel->count_search_data('recettes', NULL, 2) + $this->ivtmodel->count_search_data('designations', NULL, 2),
                "recordsFiltered" => $this->ivtmodel->count_search_data('depenses', $_POST['search']['value'], 2) + $this->ivtmodel->count_search_data('recettes', $_POST['search']['value'], 2) +$this->ivtmodel->count_search_data('designations', $_POST['search']['value'], 2),
                "data" => $search
            );  
		echo json_encode($output);
	}

	public function restaurer(){
        $ckeck = 2;
        switch ($this->input->post('table')){
            case 'Désignation':
                $ckeck = ($this->ivtmodel->update('designations', array('statut' => 1), 'id', $this->input->post('id'))) ? 1 : 2;
                break;
            case 'Recette':
                $ckeck = ($this->ivtmodel->update('recettes', array('statut' => 1), 'id', $this->input->post('id'))) ? 1 : 2;
                break;
            case 'Dépense':
                $ckeck = ($this->ivtmodel->update('depenses', array('statut' => 1), 'id', $this->input->post('id'))) ? 1 : 2;
                break;
        }
		echo json_encode($ckeck);
	}
}
