<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depenses extends CI_Controller {

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
			'title'=> "O'mel | Dépenses", //titre de la page
			'content'=>'depenses', //vue à afficher
			//'designations' => $this->ivtmodel->getListe('designations', 'id', 'DESC')
		);
		$this->load->view('template/content', $data);
	}

	public function tableDepensesAjax(){
		$search = $this->ivtmodel->get_search_data('depenses', $_POST['start'], $_POST['length'], $_POST['search']['value'], 1);
		$output = array(  
                "draw"  => intval($_POST["draw"]),  
                "recordsTotal" => $this->ivtmodel->count_search_data('depenses', NULL, 1),
                "recordsFiltered" => $this->ivtmodel->count_search_data('depenses', $_POST['search']['value'], 1),
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
                'date_depense'=>date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('date_depense')))),
                'designation'=> $designation->id,
                'quantite'=>$this->input->post('quantite'),
				'prix_unitaire'=>$designation->prix_unitaire,
                'montant'=> $this->input->post('montant'),
                'statut'=>1,
            );            
            
            if((isset($_POST['id'])) ? $this->ivtmodel->update('depenses', $data, 'id', $this->input->post('id')) : $this->ivtmodel->add('depenses', $data)) {
                    echo json_encode(1);
                } else echo json_encode(2);
        }else {
			$errors = [
				'code'=>form_error('code') !=  '' ? form_error('code'): '',
				'date_depense'=>form_error('date_depense') !=  '' ? form_error('date_depense'): '',
				'montant'=>form_error('montant') !=  '' ? form_error('montant'): '',
				'quantite'=>form_error('quantite') !=  '' ? form_error('quantite'): '',
			];
            echo json_encode($errors); //$this->AjouteVGM("cert");
        }
	}

	public function d(){
		var_dump($this->ivtmodel->getItem('designations', 'code', 'D-2')[0]);
	}

	public function depense_corbeil($id){
		echo json_encode(($this->ivtmodel->update('depenses', ['statut' => 2], 'id', $id)) ? 1 : 2);
	}

	public function get_designation(){
		echo json_encode($this->ivtmodel->getListe('designations', 'id', 'DESC'));
	}
}
