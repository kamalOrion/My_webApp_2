<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(

    'Login/connexion' => array(  /// (controleur/methode)
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|valid_email',
            'errors' =>  array('required'=>'Ce champs est obligatoire', 'valid_email'=>'Email invalide')
        ), 
        array(
            'field' => 'pass',
            'label' => 'Mot de passe',
            'rules' => 'required',
            'errors' =>  array('required'=>'Ce champs est obligatoire')
        ), 
        
    ),  

    'Designations/ajout' => array(  /// (controleur/methode)
        array(
            'field' => 'prix_unitaire',
            'label' => 'Prix unitaire',
            'rules' => 'required|integer',
            'errors' =>  array('required'=>'Ce champs est obligatoire', 'integer'=>'Seul les chiffres sont autorisés pour ce champs')
        )        
    ),

    'Depenses/ajout' => array(  /// (controleur/methode)
        array(
            'field' => 'designation',
            'label' => 'Désignation',
            'rules' => 'required',
            'errors' =>  array('required'=>'Ce champs est obligatoire')
        ), 
        array(
            'field' => 'date_depense',
            'label' => 'Date de dépense',
            'rules' => 'required',
            'errors' =>  array('required'=>'Ce champs est obligatoire')
        ), 
        array(
            'field' => 'montant',
            'label' => 'Montant',
            'rules' => 'required|integer',
            'errors' =>  array('required'=>'Ce champs est obligatoire', 'integer'=>'Seul les chiffres sont autorisés pour ce champs')
        ), 
        array(
            'field' => 'quantite',
            'label' => 'Quantité',
            'rules' => 'required|integer',
            'errors' =>  array('required'=>'Ce champs est obligatoire', 'integer'=>'Seul les chiffres sont autorisés pour ce champs')
        ), 
    ),  

    'Recettes/ajout' => array(  /// (controleur/methode)
        array(
            'field' => 'designation',
            'label' => 'Désignation',
            'rules' => 'required',
            'errors' =>  array('required'=>'Ce champs est obligatoire')
        ), 
        array(
            'field' => 'date_recette',
            'label' => 'Date de recette',
            'rules' => 'required',
            'errors' =>  array('required'=>'Ce champs est obligatoire')
        ),
        array(
            'field' => 'quantite',
            'label' => 'Quantité',
            'rules' => 'required|integer',
            'errors' =>  array('required'=>'Ce champs est obligatoire', 'integer'=>'Seul les chiffres sont autorisés pour ce champs')
        ),
        array(
            'field' => 'montant_ajuste',
            'label' => 'Montant ajusté',
            'rules' => 'required|integer',
            'errors' =>  array('required'=>'Ce champs est obligatoire', 'integer'=>'Seul les chiffres sont autorisés pour ce champs')
        ), 
        
    ), 
    
    'Users/ajout' => array(  /// (controleur/methode)
        array(
            'field' => 'nom',
            'label' => 'Nom',
            'rules' => 'required',
            'errors' =>  array('required'=>'Ce champs est obligatoire')
        ), 
        array(
            'field' => 'prenoms',
            'label' => 'Prénoms',
            'rules' => 'required',
            'errors' =>  array('required'=>'Ce champs est obligatoire')
        ), 
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|valid_email',
            'errors' =>  array('required'=>'Ce champs est obligatoire', 'valid_email'=>'Email invalide')
        ), 
        array(
            'field' => 'pass',
            'label' => 'Mot de passe',
            'rules' => 'matches[confirme]',
            'errors' =>  array('matches'=>'Mot de passe non identique')
        ), 
        array(
            'field' => 'confirme',
            'label' => 'Confirmer mot de passe',
            'rules' => 'matches[pass]',
            'errors' =>  array('matches'=>'Mot de passe non identique')
        )
        
    ),
    
    'Profil/change_pass' => array(  /// (controleur/methode)
        array(
            'field' => 'actuel_pass',
            'label' => 'Mot de passe actuel',
            'rules' => 'required',
            'errors' =>  array('required'=>'Ce champs est obligatoire')
        ), 
        array(
            'field' => 'nouveau_pass',
            'label' => 'Nouveau mot de passe',
            'rules' => 'required|matches[confirm_pass]',
            'errors' =>  array('required'=>'Ce champs est obligatoire', 'matches'=>'Mot de passe non identique')
        ), 
        array(
            'field' => 'confirm_pass',
            'label' => 'Confirmez le mot de passe',
            'rules' => 'required|matches[nouveau_pass]',
            'errors' =>  array('required'=>'Ce champs est obligatoire', 'matches'=>'Mot de passe non identique')
        )        
    ),
);

    

/* End of file ivt_config.php */
/* Location: ./application/config/ivt_config.php */