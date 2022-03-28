<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ivtmodel extends CI_Model {

	function __construct()
	{
		parent::__construct();//contructeur de la classe
	}

	function is_logged()	{
		//renvoi les donn�es de session
		return $this->session->userdata('id') && $this->session->userdata('logged');
	}
	
	//ajouter 	
	function add($table,$data)	{
		$this->db->insert($table,$data);
		return true;
	}	
	
	//update
	function update($table,$data,$cle, $valeur){
		$this->db->update($table,$data,array($cle => $valeur));									
		return true;
	}

	//update
	function delete($table,$cle, $valeur){
		$this->db->delete($table,array($cle => $valeur));									
		return true;
	}
	
	//liste
	function getListe($table,$ordercle,$dir,$where=null,$limit=null)	{
		$q = $this->db->select('*')->from($table)
		->order_by($ordercle,$dir);
		if ($where) {
            $this->db->where($where);
        }
        if ($limit){
            $this->db->limit($limit);
        }
        $q = $this->db->get();
		
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	function getListeWhereArray($select, $table, $where, $group_by=null, $order_by=null, $order=null)	{
		// var_dump($order_by);exit();
		$q = $this->db->select($select)->from($table)
		->where($where) ;
		if ($group_by) {
            $this->db->group_by($group_by);
        }
        if ($order_by) {
            $this->db->order_by($order_by,$order);
        }
        $q = $this->db->get();
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}
	//item
	function getItem($table, $cle, $valeur){
		$q = $this->db->select('*')->from($table)
		->where($cle,$valeur)
		->get();
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}	

	//liste jointure
	function getListeUnJointure($selection,$table,$table1,$cle1,$cletable1)	{
		$q = $this->db->select($selection)->from($table)
		->join($table1, $cle1.'='.$cletable1)
		->get();
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	function getListeUnJointureWhere($selection,$table,$table1,$cletable1,$cletable2,$cle,$valeur)	{
		$q = $this->db->select($selection)->from($table)
		->join($table1, $cletable1.'='.$cletable2)
		->where($cle,$valeur)
		->get();
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	function getListeDeuxJointure($selection,$table,$table1,$table2,$cle1,$cle2,$cletable1,$cletable2)	{
		$q = $this->db->select($selection)->from($table)
		->join($table1, $cle1.'='.$cletable1)
		->join($table2, $cle2.'='.$cletable2)
		->get();
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	function getListeDeuxJointureWhere($selection,$table,$table1,$table2,$cle1,$cle2,$cletable1,$cletable2,$cle,$valeur)	{
		$q = $this->db->select($selection)->from($table)
		->join($table1, $cle1.'='.$cletable1)
		->join($table2, $cle2.'='.$cletable2)
		->where($cle,$valeur)
		->get();
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}
	//connecter un utilisateur
	function  login($email,$password){
		$q = $this->db->select('*')->from('users')
		/*->join('registre r', 'r.code_enreg=u.code_enreg')*/
		->where('email',$email)
		->where('pass',sha1(md5($password)))
		->where('statut','Actif')
		->get();
		
		if($q->num_rows()>0)		{
			$row = $q->row();
			//tableau contenant les donn�es d'identification de l'utilisateur connect�
			$session = array(
				'nom'=>$row->nom,
				'prenoms'=>$row->prenoms,
				'id'=>$row->id,
				'email'=>$row->email,
				'privileges'=>str_split($row->privileges, 1),
				'logged'=>true,
				'lastmodif'=>$row->lastmodif,
			);
			//mise en session des donn�es
			$this->session->set_userdata($session);
			return true;
		}
		return false;
	}
		

	function getListeLimit($table,$debut,$nombre, $order, $dir,$cols_recherche,$recherche)	{
		if($order !=null) {
            $this->db->order_by($order, $dir);
		}		
		if($recherche !=null) {
			$i=0;
			foreach ($cols_recherche as $item) {// loop column 
				if ($item=="datedoc" OR $item=="BOOKING_DATE"){
					$recherche_array=explode("/",$recherche);
					if (count($recherche_array)==2)
					$recherche=$recherche_array[1]."-".$recherche_array[0];
					if (count($recherche_array)==3)
					$recherche=$recherche_array[2]."-".$recherche_array[1]."-".$recherche_array[0];
				}
				if($i===0){ // first loop
					$this->db->group_start(); // open bracket.
					$this->db->like($item,$recherche);
				}
				else{
					$this->db->or_like($item, $recherche);
				}
	
				if(count($cols_recherche) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
				$i++;
				
			}		
		}

        $this->db->limit($nombre,$debut);

		$q = $this->db->select('*')->from($table)
		->get();
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function se_connecter( $email, $password ) {

        $user = $this->getItem("user", "email", $email)[0]; //from base de données   

        if (($user != NULL) && password_verify($password, $user->mdp) && $user->statut == "Actif") {
            $this->session->user = [
                'id' => $user->id,
                'email' => $user->email,
                'nom' => $user->nom,
                'prenoms' => $user->prenom,
                'tel' =>$user->tel,
                'civilite' =>$user->civilite,
                'privilege' =>$user->privilege,

            ];
            return true;
              
        } else {
            $this->se_deconnecter();
            return false;
        }
    }

    public function se_deconnecter() {
        $this->session->user = NULL;
        session_destroy();
    }

	

	//DataTable function for Depenses table ----------------------------------------------
	function get_search_data($table, $start, $length, $text = NULL, $statut = NULL){			
		$this->db->select('*')->from($table);

		if($statut != NULL) $this->db->where('statut', $statut);
		if($table == 'users') $this->db->where('id!=', '1');

		if($table == 'depenses'){
			if($text){  	
			   	$this->db->group_start();
                $this->db->like("date_depense", $text);  
                $this->db->or_like("code", $text);  
                $this->db->or_like("designation", $text);  
                $this->db->or_like("quantite", $text);  
                $this->db->or_like("prix_unitaire", $text);
				$this->db->or_like("montant", $text);
				$this->db->or_like("date_enreg", $text);  
                $this->db->group_end();
           }
		}

		if($table == 'designations'){
			if($text){  	
			   	$this->db->group_start();
                $this->db->like("libelle", $text);  
                $this->db->group_end();
           }
		}

		if($table == 'recettes'){
			if($text){  	
				$this->db->group_start();
				$this->db->like("date_recette", $text);  
				$this->db->or_like("code", $text);  
				$this->db->or_like("designation", $text);  
				$this->db->or_like("quantite", $text);  
				$this->db->or_like("prix_unitaire", $text);
				$this->db->or_like("montant", $text);
				$this->db->or_like("montant_ajuste", $text);
				$this->db->or_like("date_enreg", $text);  
				$this->db->group_end();
			}
		}

		$this->db->order_by('id','desc');
		$this->db->limit($length, $start);
		return $this->db->get()->result();  
	}

	function count_search_data($table, $text = NULL, $statut = NULL){			
		$this->db->select('*')->from($table);
		if($statut != NULL) $this->db->where('statut', $statut);
		if($table == 'users') $this->db->where('id!=', '1');
		
		if($table == 'depenses'){
			if($text){  	
				$this->db->group_start();
				$this->db->like("date_depense", $text);  
				$this->db->or_like("code", $text);  
				$this->db->or_like("designation", $text);  
				$this->db->or_like("quantite", $text);  
				$this->db->or_like("prix_unitaire", $text);
				$this->db->or_like("montant", $text);
				$this->db->or_like("date_enreg", $text);  
				$this->db->group_end();
			}
		}

		if($table == 'designations'){
			if($text){  	
			   	$this->db->group_start();
                $this->db->like("libelle", $text);  
                $this->db->group_end();
           }
		}

		if($table == 'recettes'){
			if($text){  	
				$this->db->group_start();
				$this->db->like("date_recette", $text);  
				$this->db->or_like("code", $text);  
				$this->db->or_like("designation", $text);  
				$this->db->or_like("quantite", $text);  
				$this->db->or_like("prix_unitaire", $text);
				$this->db->or_like("montant", $text);
				$this->db->or_like("montant_ajuste", $text);
				$this->db->or_like("date_enreg", $text);  
				$this->db->group_end();
			}
		}
		
		$this->db->order_by('id','desc');
		return $this->db->count_all_results();  
	}

	public function getItemLikeBoth($table,$cle, $valeur)	{
		$q = $this->db->select('*')->from($table)
		->like('statut', 1)
		->like($cle,$valeur,'both')
		->get();
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function count_table($table)	{
		$q = $this->db->select('*')->from($table)->get();
		return $q->num_rows();
	}

}