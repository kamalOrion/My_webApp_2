<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class='fa fa-users'></i> Utilisateurs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                Dashboard
            </li>
            <li class="breadcrumb-item active">
                <strong>Utilisateurs</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight" style='padding-bottom: 5px;'>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox" style='margin-bottom: 0px'>
                <div class="ibox-content" style='padding: 15px'>
                    <div class='row'>
                        <div class='col-3'>
                            <h4>Liste des utilisateurs</h4>
                        </div>
                        <div class='col-9 text-right'>
                            <?php if(in_array(1, $this->session->userdata('privileges'))): ?>
                            <button class='custom-btn btn btn-primary' data-toggle="modal" data-target="#ajouter_user">
                                <i class='fa fa-plus'></i>
                                Ajouter
                            </button>
                            <?php endif ?>
                            <?php if(in_array(2, $this->session->userdata('privileges'))): ?>
                            <button id='modifier_user' class='custom-btn btn btn-default default-k'>
                                <i class='fa fa-edit'></i>
                                Modifier
                            </button>
                            <?php endif ?>
                            <?php if(in_array(9, $this->session->userdata('privileges'))): ?>
                            <button id='statut_user' class='custom-btn btn btn-default default-k'>
                                <i class='fa fa-circle'></i> 
                                Changer statut
                            </button>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight" style='padding-top: 5px'>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id='tableUsers' class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénoms</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                    <th>Date de création</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>ID</th>
                                    <th>nom</th>
                                    <th>Prénoms</th>
                                    <th>E-mail</th>
                                    <th>status</th>
                                    <th>Date de création</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="ajouter_user" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><span id='users_modal_title'><h2>Ajouter un utilisateur</h2></span></h4>
                <small class="font-bold">Veuillez remplir le formulaire et cliquez sur terminer pour enregistrer</small>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url()."index.php/Users/ajout",array('id'=>'form_ajout_user','class'=>'m-t','role'=>'form'));?>
                    <div class="tab-content">
                        <div id="step1" class="p-m tab-pane active">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group position-relative">
                                            <label>Nom</label>                                    
                                            <?php 
                                            $data = array(
                                                    "id"            => "nom",   
                                                    'name'          => 'nom',
                                                    'type'          => 'text',
                                                    'class'         => 'form-control'.((form_error('nom') != "")?" is-invalid":""),
                                                    'placeholder'         => 'Nom',
                                                    'autocomplete'      =>'off',
                                            );
                                            echo form_input($data); ?>
                                            </div>	
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group position-relative">
                                            <label>Prénoms</label>                                    
                                            <?php 
                                            $data = array(
                                                    "id"            => "prenoms",   
                                                    'name'          => 'prenoms',
                                                    'type'          => 'text',
                                                    'class'         => 'form-control'.((form_error('prenoms') != "")?" is-invalid":""),
                                                    'placeholder'         => 'Prénoms',
                                                    'autocomplete'      =>'off',
                                            );
                                            echo form_input($data); ?>
                                            </div>	
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group position-relative">
                                            <label>E-mail</label>                                    
                                            <?php 
                                            $data = array(
                                                    "id"            => "email",   
                                                    'name'          => 'email',
                                                    'type'          => 'email',
                                                    'class'         => 'form-control'.((form_error('email') != "")?" is-invalid":""),
                                                    'placeholder'   => 'E-mail',
                                                    'autocomplete'      =>'off',
                                            );
                                            echo form_input($data); ?>
                                            </div>	
                                        </div> 
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group position-relative">
                                            <label>Mot de passe</label>                                    
                                            <?php 
                                            $data = array(
                                                    "id"            => "pass",   
                                                    'name'          => 'pass',
                                                    'type'          => 'password',
                                                    'class'         => 'form-control'.((form_error('pass') != "")?" is-invalid":""),
                                                    'placeholder'   => 'Mot de passe',
                                                    'autocomplete'      =>'off',
                                            );
                                            echo form_input($data); ?>
                                            </div>	
                                        </div> 

                                        <div class="col-lg-6">
                                            <div class="form-group position-relative">
                                            <label>Confirmez le mot de pass</label>                                    
                                            <?php 
                                            $data = array(
                                                    "id"            => "confirme",   
                                                    'name'          => 'confirme',
                                                    'type'          => 'password',
                                                    'class'         => 'form-control'.((form_error('confirme') != "")?" is-invalid":""),
                                                    'placeholder'   => 'Confirmez',
                                                    'autocomplete'      =>'off',
                                            );
                                            echo form_input($data); ?>
                                            </div>	
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-lg-12 text-center">
                                    <h4>Privileges</h4>
                                    <hr style="margin: 0">
                                </div>
                            </div>
                            <div id='privileges' class='row mt-3'>
                                <div class="col-6 text-left">
                                    <input id='4' type="checkbox" name='privileges[]' value=4> Recettes
                                </div>
                                <div class="col-6 text-left">
                                    <input id='1' type="checkbox" name='privileges[]' value=1> Ajouter
                                </div>
                                <div class="col-6 text-left">
                                    <input id='5' type="checkbox" name='privileges[]' value=5> Dépenses
                                </div>
                                <div class="col-6 text-left">
                                    <input id='2' type="checkbox" name='privileges[]' value=2> Modifier
                                </div>
                                <div class="col-6 text-left">
                                    <input id='6' type="checkbox" name='privileges[]' value=6> Désignations
                                </div>
                                <div class="col-6 text-left">
                                    <input id='3' type="checkbox" name='privileges[]' value=3> Supprimer
                                </div>
                                <div class="col-6 text-left">
                                    <input id='7' type="checkbox" name='privileges[]' value=7> Corbeil
                                </div>
                                <div class="col-6 text-left">
                                    <input id='0' type="checkbox" name='privileges[]' value=0> Restaurer | Corbeil
                                </div>
                                <div class="col-6 text-left">
                                    <input id='8' type="checkbox" name='privileges[]' value=8> Utilsateurs
                                </div>
                                <div class="col-6 text-left">
                                    <input id='9' type="checkbox" name='privileges[]' value=9> Statut | Utilsateurs
                                </div>
                            </div>
                        </div>
                    </div>               
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Annuler</button>
                <button id='terminer_ajout_user' form='form_ajout_user' type="submit" class="btn btn-primary">Terminer</button>
            </div>
        </div>
    </div>
</div>