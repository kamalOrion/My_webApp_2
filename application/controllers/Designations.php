<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designations extends CI_Controller {

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
			'title'=> "O'mel | Désignation", //titre de la page
			'content'=>'designation', //vue à afficher
		);
		$this->load->view('template/content', $data);
	}

	public function tableDesignationsAjax(){
		$search = $this->ivtmodel->get_search_data('designations', $_POST['start'], $_POST['length'], $_POST['search']['value'], 1);
		$output = array(  
                "draw"  => intval($_POST["draw"]),  
                "recordsTotal" => $this->ivtmodel->count_search_data('designations', NULL, 1),
                "recordsFiltered" => $this->ivtmodel->count_search_data('designations', $_POST['search']['value'], 1),
                "data" => $search
            );  
		echo json_encode($output);
	}

	public function ajout(){
		$this->check();
        $this->form_validation->set_error_delimiters("<span class='error_smg' style='color: red; font-weight: bold'>", "</span>");

		if(!isset($_POST['id'])){
			$this->form_validation->set_rules(
				'designation', 'Désignation',
				'required|is_unique[designations.libelle]',
				array('required'=>'Ce champs est obligatoire', 'is_unique'=> 'Cette désignation existe déja')
			);
		}
		
        if($this->form_validation->run()){
            $data = array(
                'libelle'=>$this->input->post('designation'),
				'code'=> 'D-'.strval($this->ivtmodel->count_table('designations') + 1),
				'prix_unitaire'=>$this->input->post('prix_unitaire'),
                'statut'=>1,
            );            
            
            if((isset($_POST['id'])) ? $this->ivtmodel->update('designations', $data, 'id', $this->input->post('id')) : $this->ivtmodel->add('designations', $data)) {
                    echo json_encode(1);
                } else echo json_encode(2);
        }else {
            echo json_encode([
				'designation'=>form_error('designation') !=  '' ? form_error('designation'): '',
				'code'=>form_error('code') !=  '' ? form_error('code'): '',
				'prix_unitaire'=>form_error('prix_unitaire') !=  '' ? form_error('prix_unitaire'): '',
			]); //$this->AjouteVGM("cert");
        }
	}

	public function designation_corbeil($id){
		echo json_encode(($this->ivtmodel->update('designations', ['statut' => 2], 'id', $id)) ? 1 : 2);
	}

	public function selectAjax(){
		$data = $this->ivtmodel->getItemLikeBoth('designations', 'libelle', $_GET['term']);
		echo json_encode($data); 
		
	}
}
