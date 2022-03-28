<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{ 
		$this->load->view('login', array('title'=> "O'mel | Connexion"));
	}

	public function connexion()
	{ 
		//$this->form_validation->set_error_delimiters('<span class="kamal">', '</span>');
		if($this->form_validation->run()){
			if($this->ivtmodel->login($this->input->post('email'),$this->input->post('pass'))){
				redirect('Depenses'); exit;
			} else {
				$this->session->set_flashdata('error', "Identifiants incorrect ou compte inactif");
				redirect('Login'); exit;
			}
		}else{
			$this->session->set_flashdata('error', 'Données saisies incorrects');
			$this->index();
		}
	}


	public function deconnexion(){
		$this->ivtmodel->se_deconnecter();
		redirect('Login');
	}
}
