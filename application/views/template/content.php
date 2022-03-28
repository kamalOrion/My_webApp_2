<?php

    $this->load->view('template/header');//inclusion entete de pag
    $this->load->view('template/menu');//inclusion entete de pag
    $this->load->view($content);//inclusion dynamique corps de page
    $this->load->view('template/footer');//inclusion pied de page

?>