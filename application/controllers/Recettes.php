<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recettes extends CI_Controller {

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
			'title'=> "O'mel | Recettes", //titre de la page
			'content'=>'recettes', //vue à afficher
			'designations' => $this->ivtmodel->getListe('designations', 'id', 'DESC')
		);
		$this->load->view('template/content', $data);
	}

	public function tableRecettesAjax(){
		$search = $this->ivtmodel->get_search_data('recettes', $_POST['start'], $_POST['length'], $_POST['search']['value'], 1);
		$output = array(  
                "draw"  => intval($_POST["draw"]),  
                "recordsTotal" => $this->ivtmodel->count_search_data('recettes', NULL, 1),
                "recordsFiltered" => $this->ivtmodel->count_search_data('recettes', $_POST['search']['value'], 1),
                "data" => $search
            );  
		echo json_encode($output);
	}

	public function ajout(){
		$this->check();
        $this->form_validation->set_error_delimiters("<span class='error_smg' style='color: red; font-weight: bold'>", "</span>");
        
        if($this->form_validation->run()){
			$designation = $this->ivtmodel->getItem('designations', 'libelle', $this->input->post('designation'))[0];
            $data = array(
                'code'=>$designation->code,
                'date_recette'=>date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('date_recette')))),
                'designation'=>$designation->id,
                'quantite'=>$this->input->post('quantite'),
				'prix_unitaire'=>$designation->prix_unitaire,
                'montant'=>$designation->prix_unitaire * $this->input->post('quantite'),
                'montant_ajuste'=>$this->input->post('montant_ajuste'),
                'statut'=>1,
            );            
            
            if((isset($_POST['id'])) ? $this->ivtmodel->update('recettes', $data, 'id', $this->input->post('id')) : $this->ivtmodel->add('recettes', $data)) {
                    echo json_encode(1);
                } else echo json_encode(2);
        }else {
            echo json_encode([
				'code'=>form_error('code') !=  '' ? form_error('code'): '',
				'date_recette'=>form_error('date_recette') !=  '' ? form_error('date_recette'): '',
				'designation'=>form_error('designation') !=  '' ? form_error('designation'): '',
				'quantite'=>form_error('quantite') !=  '' ? form_error('quantite'): '',
				'prix_unitaire'=>form_error('prix_unitaire') !=  '' ? form_error('prix_unitaire'): '',
				'montant'=>form_error('montant') !=  '' ? form_error('montant'): '',
                'montant_ajuste'=>form_error('montant_ajuste') !=  '' ? form_error('montant_ajuste'): '',
			]); 
        }
	}

	public function recette_corbeil($id){
		echo json_encode(($this->ivtmodel->update('recettes', ['statut' => 2], 'id', $id)) ? 1 : 2);
	}

	public function get_designation(){
		echo json_encode($this->ivtmodel->getListe('designations', 'id', 'DESC'));
	}
}
