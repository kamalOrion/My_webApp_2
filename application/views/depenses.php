<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class='fa fa-money'></i> Dépenses</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                Dashboard
            </li>
            <li class="breadcrumb-item active">
                <strong>Dépenses</strong>
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
                            <h4>Liste des dépenses</h4>
                        </div>
                        <div class='col-9 text-right'>
                            <?php if(in_array(1, $this->session->userdata('privileges'))): ?>
                            <button class='custom-btn btn btn-primary' data-toggle="modal" data-target="#ajouter_depense">
                                <i class='fa fa-plus'></i>
                                Ajouter
                            </button>
                            <?php endif ?>
                            <?php if(in_array(2, $this->session->userdata('privileges'))): ?>
                            <button id='modifier_depense' class='custom-btn btn btn-default default-k'>
                                <i class='fa fa-edit'></i>
                                Modifier
                            </button>
                            <?php endif ?>
                            <?php if(in_array(3, $this->session->userdata('privileges'))): ?>
                            <button id='supprimer_depense' class='custom-btn btn btn-default default-k'>
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
                        <table id='tableDepense' class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Montant</th>
                                    <th>Date d'enregistrement</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Montant</th>
                                    <th>Date d'enregistrement</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="ajouter_depense" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><span id='depenses_modal_title'><h2>Ajouter une dépense</h2></span></h4>
                <small class="font-bold">Veuillez remplir le formulaire et cliquez sur terminer pour enregistrer</small>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url()."index.php/Depenses/ajout",array('id'=>'form_ajout_depense','class'=>'form_with_select2 m-t','role'=>'form'));?>
                    <div class="tab-content">
                        <div id="step1" class="p-m tab-pane active">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group position-relative" id="date_js">
                                                <label class="font-normal">Date de la dépense</label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id='date_depense' name='date_depense' type="text" class="form-control <?= ((form_error('date_depense') != "")?" is-invalid":"") ?>" autocomplete='off' readonly>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group position-relative" style='height: 33px !important'>
                                                <label>Désignation</label>
                                                <select id='designation' name='designation' class="designation select_custom form-control" style='width: 100%;'>
                                                </select>
                                            </div>	
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group position-relative">
                                            <label>Montant</label>                                    
                                            <?php 
                                            $data = array(
                                                    "id"            => "montant",   
                                                    'name'          => 'montant',
                                                    'type'          => 'number',
                                                    'class'         => 'form-control'.((form_error('montant') != "")?" is-invalid":""),
                                                    'placeholder'         => 'Montant',
                                                    'value'         => set_value('montant'),
                                                    'autocomplete'      =>'off',
                                            );
                                            echo form_input($data); ?>
                                            </div>	
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group position-relative">
                                            <label>Quantité</label>                                    
                                            <?php 
                                            $data = array(
                                                    "id"            => "quantite",   
                                                    'name'          => 'quantite',
                                                    'type'          => 'number',
                                                    'class'         => 'form-control'.((form_error('quantite') != "")?" is-invalid":""),
                                                    'placeholder'         => 'Quantité',
                                                    'value'         => set_value('quantite'),
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
                <button id='terminer_ajout_depense' form='form_ajout_depense' type="submit" class="btn btn-primary">Terminer</button>
            </div>
        </div>
    </div>
</div>