<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class='fa fa-tags'></i> Désignations</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                Dashboard
            </li>
            <li class="breadcrumb-item active">
                <strong>Désignations</strong>
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
                            <h4>Liste des désignations</h4>
                        </div>
                        <div class='col-9 text-right'>
                            <?php if(in_array(1, $this->session->userdata('privileges'))): ?>
                            <button class='custom-btn btn btn-primary' data-toggle="modal" data-target="#ajouter_designation">
                                <i class='fa fa-plus'></i>
                                Ajouter
                            </button>
                            <?php endif ?>
                            <?php if(in_array(2, $this->session->userdata('privileges'))): ?>
                            <button id='modifier_designation' class='custom-btn btn btn-default default-k'>
                                <i class='fa fa-edit'></i>
                                Modifier
                            </button>
                            <?php endif ?>
                            <?php if(in_array(3, $this->session->userdata('privileges'))): ?>
                            <button id='supprimer_designation' class='custom-btn btn btn-default default-k'>
                                <i class='fa fa-trash'></i> 
                                Corbeil
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
                        <table id='tableDesignation' class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Libellé</th>
                                    <th>Prix unitaire</th>
                                    <th>Date de création</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Libellé</th>
                                    <th>Prix unitaire</th>
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

<div class="modal inmodal fade" id="ajouter_designation" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><span id='designations_modal_title'><h2>Ajouter une désignation</h2></span></h4>
                <small class="font-bold">Veuillez remplir le formulaire et cliquez sur terminer pour enregistrer</small>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url()."index.php/Designations/ajout",array('id'=>'form_ajout_designation','class'=>'m-t','role'=>'form'));?>
                    <div class="tab-content">
                        <div id="step1" class="p-m tab-pane active">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group position-relative">
                                            <label>Libellé</label>                                    
                                            <?php 
                                            $data = array(
                                                    "id"            => "designation",   
                                                    'name'          => 'designation',
                                                    'type'          => 'text',
                                                    'class'         => 'form-control'.((form_error('designation') != "")?" is-invalid":""),
                                                    'placeholder'         => 'Désignation',
                                                    'value'         => set_value('designation'),
                                                    'autocomplete'      =>'off',
                                            );
                                            echo form_input($data); ?>
                                            </div>	
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group position-relative">
                                            <label>Prix unitaire</label>                                    
                                            <?php 
                                            $data = array(
                                                    "id"            => "prix_unitaire",   
                                                    'name'          => 'prix_unitaire',
                                                    'type'          => 'number',
                                                    'class'         => 'form-control'.((form_error('prix_unitaire') != "")?" is-invalid":""),
                                                    'placeholder'         => 'Prix unitaire',
                                                    'value'         => set_value('prix_unitaire'),
                                                    'autocomplete'      =>'off',
                                            );
                                            echo form_input($data); ?>
                                            </div>	
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>               
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Annuler</button>
                <button id='terminer_ajout_designation' form='form_ajout_designation' type="submit" class="btn btn-primary">Terminer</button>
            </div>
        </div>
    </div>
</div>