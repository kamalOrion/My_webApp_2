    <div class="footer">
        <div>
            <strong>Copyright</strong> INOVACT &copy; 2022
        </div>
    </div>
</div>
        

<!-- Mainly scripts -->
    <script src="<?= base_url('assets/');?>js/jquery-3.1.1.min.js"></script>
    <script src="<?= base_url('assets/');?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/');?>js/bootstrap.js"></script>
    <script src="<?= base_url('assets/');?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= base_url('assets/');?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?= base_url('assets/');?>js/plugins/flot/jquery.flot.js"></script>
    <script src="<?= base_url('assets/');?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?= base_url('assets/');?>js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?= base_url('assets/');?>js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?= base_url('assets/');?>js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="<?= base_url('assets/');?>js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?= base_url('assets/');?>js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?= base_url('assets/');?>js/inspinia.js"></script>
    <script src="<?= base_url('assets/');?>js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?= base_url('assets/');?>js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="<?= base_url('assets/');?>js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?= base_url('assets/');?>js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?= base_url('assets/');?>js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?= base_url('assets/');?>js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="<?= base_url('assets/');?>js/plugins/toastr/toastr.min.js"></script>

    <!-- Data picker -->
   <script src="<?= base_url('assets/');?>js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <script src="<?= base_url('assets/');?>js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?= base_url('assets/');?>js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        $(document).ready(function(){
            var ajax_data = {
                data: null,
                designation: {}
            }

            $(".default-k").on("click", function(e){
                e.preventDefault();
                if($(this).hasClass("btn-default")){
                    alert("Aucune ligne selectionné !!!");
                }
            });

            get_designation();

            $(".designation").select2(multi_select_ajax('<?php echo site_url() . '/Designations/selectAjax'; ?>'));

            function multi_select_ajax(url){
                return {
                    dropdownParent: $('.form_with_select2'),
                    delay:250,
                    ajax: {
                        url: url,
                        dataType: 'json',
                        processResults: function (data) {
                            let select = {results:[]};
                            for(element in data){
                                let single = {
                                    id: data[element].libelle,
                                    text: data[element].libelle
                                }
                                select.results.push(single);
                            }
                            return select;
                        }
                    }
                }
            }

            var tableDepense = $('#tableDepense').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'}                    
                ],
                language: {
                    "sProcessing":     "Traitement en cours...",
                        "sSearch":         "Recherche",
                        "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments &nbsp;&nbsp;&nbsp;",
                        "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur  _TOTAL_ &eacute;l&eacute;ments",
                        "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        "sInfoPostFix":    "",
                        "sLoadingRecords": "Chargement en cours...",
                        "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                        "oPaginate": {						
                            "sFirst":      "Premier",
                            "sPrevious":   "Pr&eacute;c&eacute;dent",
                            "sNext":       "Suivant",
                            "sLast":       "Dernier"
                        },
                        "oAria": {
                            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                        }
                },
                "columnDefs": [{ "targets": [ 0 ],"visible": false,"searchable": false },{ "targets": [ 5 ],"visible": false,"searchable": false }],
                "processing": true,
                "serverSide": true,
                ajax:{  
                    url:"<?php echo site_url() . '/Depenses/tableDepensesAjax'; ?>",  
                    type:"POST"  ,
                    dataSrc:function(j){
                        let data_array = [];
                        for(const element of j.data){
                            data_array.push([
                                element.id,
                                format_date(element.date_depense),
                                element.code,
                                ajax_data.designation[element.designation],
                                element.quantite,
                                element.prix_unitaire+" FCFA",
                                element.montant+" FCFA",
                                format_date(element.date_enreg)
                            ]);
                        }
                        return data_array;
                    } 
                }
            });

            var tableDesignation = $('#tableDesignation').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'}                    
                ],
                language: {
                    "sProcessing":     "Traitement en cours...",
                        "sSearch":         "Recherche",
                        "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments &nbsp;&nbsp;&nbsp;",
                        "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur  _TOTAL_ &eacute;l&eacute;ments",
                        "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        "sInfoPostFix":    "",
                        "sLoadingRecords": "Chargement en cours...",
                        "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                        "oPaginate": {						
                            "sFirst":      "Premier",
                            "sPrevious":   "Pr&eacute;c&eacute;dent",
                            "sNext":       "Suivant",
                            "sLast":       "Dernier"
                        },
                        "oAria": {
                            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                        }
                },
                "columnDefs": [{ "targets": [ 0 ],"visible": false,"searchable": false }],
                "processing": true,
                "serverSide": true,
                ajax:{  
                    url:"<?php echo site_url() . '/Designations/tableDesignationsAjax'; ?>",  
                    type:"POST"  ,
                    dataSrc:function(j){
                        let data_array = [];
                        for(const element of j.data){
                            data_array.push([
                                element.id,
                                element.code,
                                element.libelle,
                                element.prix_unitaire+' FCFA',
                                format_date(element.date_enreg)
                            ]);
                        }
                        return data_array;
                    } 
                }
            });

            var tableRecette = $('#tableRecette').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'}                    
                ],
                language: {
                    "sProcessing":     "Traitement en cours...",
                        "sSearch":         "Recherche",
                        "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments &nbsp;&nbsp;&nbsp;",
                        "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur  _TOTAL_ &eacute;l&eacute;ments",
                        "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        "sInfoPostFix":    "",
                        "sLoadingRecords": "Chargement en cours...",
                        "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                        "oPaginate": {						
                            "sFirst":      "Premier",
                            "sPrevious":   "Pr&eacute;c&eacute;dent",
                            "sNext":       "Suivant",
                            "sLast":       "Dernier"
                        },
                        "oAria": {
                            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                        }
                },
                "columnDefs": [{ "targets": [ 0 ],"visible": false,"searchable": false }],
                "processing": true,
                "serverSide": true,
                ajax:{  
                    url:"<?php echo site_url() . '/Recettes/tableRecettesAjax'; ?>",  
                    type:"POST"  ,
                    dataSrc:function(j){
                        let data_array = [];
                        for(const element of j.data){
                            data_array.push([
                                element.id,
                                format_date(element.date_recette),
                                element.code,
                                ajax_data.designation[element.designation],
                                element.quantite,
                                element.prix_unitaire+" FCFA",
                                element.montant+" FCFA",
                                element.montant_ajuste+" FCFA",
                                format_date(element.date_enreg)
                            ]);
                        }
                        return data_array;
                    } 
                }
            });

            var tableCorbeil = $('#tableCorbeil').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'}                    
                ],
                language: {
                    "sProcessing":     "Traitement en cours...",
                        "sSearch":         "Recherche",
                        "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments &nbsp;&nbsp;&nbsp;",
                        "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur  _TOTAL_ &eacute;l&eacute;ments",
                        "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        "sInfoPostFix":    "",
                        "sLoadingRecords": "Chargement en cours...",
                        "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                        "oPaginate": {						
                            "sFirst":      "Premier",
                            "sPrevious":   "Pr&eacute;c&eacute;dent",
                            "sNext":       "Suivant",
                            "sLast":       "Dernier"
                        },
                        "oAria": {
                            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                        }
                },
                "columnDefs": [{ "targets": [ 0 ],"visible": false,"searchable": false }],
                "processing": true,
                "serverSide": true,
                ajax:{  
                    url:"<?php echo site_url() . '/Corbeil/tableCorbeilAjax'; ?>",  
                    type:"POST"  ,
                    dataSrc:function(j){
                        let data_array = [];
                        for(const element of j.data){
                            data_array.push([
                                element.id,
                                get_element_nature(element),
                                ('libelle' in element) ? "<ul><li>Code: "+element.code+"</li><li>Libellé: "+element.libelle+"</li><li>PU: "+element.prix_unitaire+"</li></ul>" : "<ul><li>"+ ((get_element_nature(element) == 'Recette') ? 'Date recette: ' : 'Date dépense: ')+ format_date((get_element_nature(element) == 'Recette')? element.date_recette :  element.date_depense)+"</li><li>Désignation: "+ajax_data.designation[element.designation]+"</li><li>Qté: "+element.quantite+"</li><li>Montant: "+element.montant+" FCFA</li>"+((element.montant_ajuste != undefined)? '</li><li>Montant ajusté: '+element.montant_ajuste+' FCFA</li>' : '') +"</ul>",
                                format_date(element.date_enreg)
                            ]);
                        }
                        return data_array;
                    } 
                }
            });
            var tableUsers = $('#tableUsers').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'}                    
                ],
                language: {
                    "sProcessing":     "Traitement en cours...",
                        "sSearch":         "Recherche",
                        "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments &nbsp;&nbsp;&nbsp;",
                        "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur  _TOTAL_ &eacute;l&eacute;ments",
                        "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        "sInfoPostFix":    "",
                        "sLoadingRecords": "Chargement en cours...",
                        "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                        "oPaginate": {						
                            "sFirst":      "Premier",
                            "sPrevious":   "Pr&eacute;c&eacute;dent",
                            "sNext":       "Suivant",
                            "sLast":       "Dernier"
                        },
                        "oAria": {
                            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                        }
                },
                "columnDefs": [{ "targets": [ 0 ],"visible": false,"searchable": false }],
                "processing": true,
                "serverSide": true,
                ajax:{  
                    url:"<?php echo site_url() . '/Users/tableUsersAjax'; ?>",  
                    type:"POST",
                    dataSrc:function(j){
                        let data_array = [];
                        for(const element of j.data){
                            data_array.push([
                                element.id,
                                element.nom,
                                element.prenoms,
                                element.email,
                                element.statut,
                                element.date_enreg
                            ]);
                        }
                        return data_array;
                    } 
                }
            });

            function get_element_nature(element){
                if('date_depense' in element){
                    return 'Dépense';
                }else if('date_recette' in element){
                    return 'Recette';
                }else if('libelle' in element){
                    return 'Désignation';
                }
            }

            $('#tableDepense tbody').on('click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {

                    $(this).removeClass('selected');

                    if($("#modifier_depense").hasClass('btn-primary') ) {
                    $("#modifier_depense").removeClass("btn-primary");	
                    $("#modifier_depense").addClass("btn btn-default");}

                    if($("#supprimer_depense").hasClass('btn-primary') ) {
                    $("#supprimer_depense").removeClass("btn-primary");	
                    $("#supprimer_depense").addClass("btn btn-default");}
                }
                else {

                    $('tr.selected').removeClass('selected');

                    $(this).addClass('selected');

                    if ($("#modifier_depense").hasClass('btn-default') ) {
                    $("#modifier_depense").removeClass("btn-default");
                    $("#modifier_depense").addClass("btn-primary");}

                    if ($("#supprimer_depense").hasClass('btn-default') ) {
                    $("#supprimer_depense").removeClass("btn-default");
                    $("#supprimer_depense").addClass("btn-primary");}

                }
            });

            $('#tableDesignation tbody').on('click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {

                    $(this).removeClass('selected');

                    if($("#modifier_designation").hasClass('btn-primary') ) {
                    $("#modifier_designation").removeClass("btn-primary");	
                    $("#modifier_designation").addClass("btn btn-default");}

                    if($("#supprimer_designation").hasClass('btn-primary') ) {
                    $("#supprimer_designation").removeClass("btn-primary");	
                    $("#supprimer_designation").addClass("btn btn-default");}
                }
                else {

                    $('tr.selected').removeClass('selected');

                    $(this).addClass('selected');

                    if ($("#modifier_designation").hasClass('btn-default') ) {
                    $("#modifier_designation").removeClass("btn-default");
                    $("#modifier_designation").addClass("btn-primary");}

                    if ($("#supprimer_designation").hasClass('btn-default') ) {
                    $("#supprimer_designation").removeClass("btn-default");
                    $("#supprimer_designation").addClass("btn-primary");}

                }
            });

            $('#tableRecette tbody').on('click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {

                    $(this).removeClass('selected');

                    if($("#modifier_recette").hasClass('btn-primary') ) {
                    $("#modifier_recette").removeClass("btn-primary");	
                    $("#modifier_recette").addClass("btn btn-default");}

                    if($("#supprimer_recette").hasClass('btn-primary') ) {
                    $("#supprimer_recette").removeClass("btn-primary");	
                    $("#supprimer_recette").addClass("btn btn-default");}
                }
                else {

                    $('tr.selected').removeClass('selected');

                    $(this).addClass('selected');

                    if ($("#modifier_recette").hasClass('btn-default') ) {
                    $("#modifier_recette").removeClass("btn-default");
                    $("#modifier_recette").addClass("btn-primary");}

                    if ($("#supprimer_recette").hasClass('btn-default') ) {
                    $("#supprimer_recette").removeClass("btn-default");
                    $("#supprimer_recette").addClass("btn-primary");}

                }
            });

            $('#tableCorbeil tbody').on('click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {

                    $(this).removeClass('selected');

                    if($("#restaurer").hasClass('btn-primary') ) {
                    $("#restaurer").removeClass("btn-primary");	
                    $("#restaurer").addClass("btn btn-default");}
                }
                else {

                    $('tr.selected').removeClass('selected');

                    $(this).addClass('selected');

                    if ($("#restaurer").hasClass('btn-default') ) {
                    $("#restaurer").removeClass("btn-default");
                    $("#restaurer").addClass("btn-primary");}

                }
            });

            $('#tableUsers tbody').on('click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {

                    $(this).removeClass('selected');

                    if($("#modifier_user").hasClass('btn-primary') ) {
                    $("#modifier_user").removeClass("btn-primary");	
                    $("#modifier_user").addClass("btn btn-default");}

                    if($("#statut_user").hasClass('btn-primary') ) {
                    $("#statut_user").removeClass("btn-primary");	
                    $("#statut_user").addClass("btn btn-default");}
                }
                else {

                    $('tr.selected').removeClass('selected');

                    $(this).addClass('selected');

                    if ($("#modifier_user").hasClass('btn-default') ) {
                    $("#modifier_user").removeClass("btn-default");
                    $("#modifier_user").addClass("btn-primary");}

                    if ($("#statut_user").hasClass('btn-default') ) {
                    $("#statut_user").removeClass("btn-default");
                    $("#statut_user").addClass("btn-primary");}

                }
            });

//------------------------------------------------------------------------------------------------------------------------------------------------

            var mem = $('#date_js .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy'
            });

            var mem = $('.date_js').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy'
            });

            function get_designation(){
                $.ajax({
                    url: "<?= site_url(); ?>/Depenses/get_designation",
                    type: "GET",
                    dataType: "json",
                    async: false,
                    error: function(request, error) { // Info de debuggage en cas erreur         
                                alert("Erreur : responseText: "+request.responseText);
                            },
                    success: function(data) {
                                for(designation of data){                                    
                                    ajax_data.designation[designation.id] = designation.libelle;
                                }                             
                            }       
                });
            } 

            function get_key_by_value(object, value){
                return Object.keys(object).find(key => object[key] === value);
            }

            //Fonction non mutable===========================================================================

            function set_select2(data, field_id){
                let data_array = data.split('<br>');
                for(element of data_array){
                    if(element != ''){
                        let option = new Option(element, element, false, true);
                        $('#'+field_id).append(option).trigger('change');
                    }
                }
            }

            //Fonction callback de soumssion de formulaire
            function succes_callback(table_id, form_id, btn_terminer_id, modal_id, sucess_add_smg, sucess_update_smg, flag){

                let code = ajax_data.data;

                $('#'+form_id).find(".error_smg").remove();

                if(typeof code === "object"){
                    for(name of Object.keys(code)){
                        if(code[name] !== ''){
                            if(name != 'date_depense' && name != 'date_recette'){
                                $('#'+form_id).find("[name="+name+"]").after(code[name]);
                            } else $('#'+form_id).find("[name="+name+"]").parent().after(code[name]);
                        }
                    }
                    $('#'+btn_terminer_id).prop('disabled', false);
                }else if(code == 1){
                    rezero(flag);	
                    alert(check_action(flag) ? sucess_update_smg : sucess_add_smg);
                    $('#'+modal_id).modal('toggle');
                    $('#'+btn_terminer_id).prop('disabled', false);
                    $("#"+table_id).DataTable().ajax.reload();
                }else if(code == 2 ){
                    alert("Echec de l'opération !!!")
                    $('#'+btn_terminer_id).prop('disabled', false);
                }
            }

            //Fonction de mise en corbeil
            function put_to_corbeil(table_id, btn_corbeil_id, flag, sucess_smg){
                $("#"+btn_corbeil_id).on('click', function(){
                    if($("#"+btn_corbeil_id).hasClass('btn-primary')){
                        if(confirm((btn_corbeil_id == 'statut_user') ? 'Êtes-vous sur de vouloir changer le statut de cet utilisateur' : 'Êtes-vous sur de vouloir supprimer cet élément')){
                            let url = get_corbeil_url(flag);
                            $.ajax({
                                url: url,
                                type: "GET",
                                dataType: "json",
                                error: function(request, error) { // Info de debuggage en cas erreur         
                                            alert("Erreur : responseText: "+request.responseText);
                                        },
                                success: function(data) {
                                            if(data == 1){
                                                alert(sucess_smg);
                                            }else{
                                                alert('Echèc de la suppressiion');
                                            } 
                                            
                                            $("#"+table_id).DataTable().ajax.reload();
                                            rezero(flag);
                                        }       
                            });
                        }
                    }
                });
            }

            //Restauration des éléments de la corbeil
           
                $("#restaurer").on('click', function(e){
                    if($(e.target).hasClass('btn-primary')){
                        if(confirm('Êtes-vous sur de vouloir restaurer cet élément')){
                            $.ajax({
                                url:"<?= site_url(); ?>/Corbeil/restaurer",
                                type: "POST",
                                dataType: "json",
                                data: {id: tableCorbeil.cell(".selected", 0).data(), table: tableCorbeil.cell(".selected", 1).data()},
                                error: function(request, error) { // Info de debuggage en cas erreur         
                                            alert("Erreur : responseText: "+request.responseText);
                                        },
                                success: function(data) {
                                            alert((data == 1) ? 'Elément restauré avec succès' : "Echèc de l'opération");
                                            $("#tableCorbeil").DataTable().ajax.reload();
                                        }       
                            });
                        }
                    }
                });
            

            //Fonction de formatage de la date
            function format_date(string_date){
                let date_parts = string_date.split(' ');
                if(date_parts.length == 2){
                    date = date_parts[0].split('-');
                    return date[2]+"/"+date[1]+"/"+date[0]+" "+date_parts[1];
                }else {
                    let date_parts = string_date.split('-');
                    return date_parts[2]+"/"+date_parts[1]+"/"+date_parts[0];
                }
            }

            // Auto remplissage du champs 'montant' du formulaire dépense
            // $('#quantite').on('keyup', function(e){
            //     if($('#prix_unitaire').val() != ''){
            //         $('#montant').val($('#quantite').val() * $('#prix_unitaire').val());
            //     }
            // })

            // $('#prix_unitaire').on('keyup', function(e){
            //     if($('#quantite').val() != ''){
            //         $('#montant').val($('#quantite').val() * $('#prix_unitaire').val());
            //     }
            // })

            //Fin fonction non mutable===================================================================


            //Fonction mutable===========================================================================

            //Fonction de soumssion de formulaire
            function submit_form_ajax(e, btn_terminer_id, table, method, flag){
                $('#'+btn_terminer_id).prop('disabled', true);
                let url = e.target.action;
                data = $(e.target).serializeArray();
                if(check_action(flag)) data.push({name: 'id', value: parseInt(table.cell(".selected", 0).data())})
                $.ajax({
                url: url,
                type: method,
                dataType: "json",
                data: data,
                error: function(request, error) { // Info de debuggage en cas erreur         
                            alert("Erreur : responseText: "+request.responseText);
                        },
                success: function(data) {
                            ajax_data.data = data;
                            if(table == tableDepense) succes_callback('tableDepense', 'form_ajout_depense', btn_terminer_id, 'ajouter_depense', "Dépense ajouté avec succès", "Dépense modifier avec succès", 'depense');
                            if(table == tableDesignation) succes_callback('tableDesignation', 'form_ajout_designation', btn_terminer_id, 'ajouter_designation', "Désignation ajouté avec succès", "Désignation modifier avec succès", 'designation');
                            if(table == tableRecette) succes_callback('tableRecette', 'form_ajout_recette', btn_terminer_id, 'ajouter_recette', "Recette ajouté avec succès", "Recette modifier avec succès", 'recette');
                            if(table == tableUsers) succes_callback('tableUsers', 'form_ajout_user', btn_terminer_id, 'ajouter_user', "Utilsateur ajouté avec succès", "Utilsateur modifier avec succès", 'user');
                        }       
                });
            }

            //Fonction executant les actions nécéssaires après fermeture de modal
            function actions_on_modal_hide_init(modal_id, form_id, title_block_id){
                $('#'+modal_id).on('hide.bs.modal', function (e) {
                    if(e.target.id == modal_id){
                        $('#'+form_id).find(".error_smg").remove();
                        $('#'+form_id).get(0).reset();
                        if(title_block_id == 'depenses_modal_title') $('#'+title_block_id).html("<h2 id="+title_block_id+">Ajouter une dépense</h2>");
                        if(title_block_id == 'designations_modal_title') $('#'+title_block_id).html("<h2 id="+title_block_id+">Ajouter une désignation</h2>");
                        if(title_block_id == 'recettes_modal_title') $('#'+title_block_id).html("<h2 id="+title_block_id+">Ajouter une recette</h2>");
                        if(title_block_id == 'users_modal_title') $('#'+title_block_id).html("<h2 id="+title_block_id+">Ajouter un utilisateur</h2>");
                    }
                });
            }

            //Fonction executant les actions nécéssaires avant ourverture de modal
            function set_edition_form(btn_edition, title_block_id, modal_id, table){
                $("#"+btn_edition).on('click', function(){
                    if($("#"+btn_edition).hasClass('btn-primary')){
                        if(title_block_id == 'depenses_modal_title') $("#"+title_block_id).html("<h2 id="+title_block_id+">Modifier une dépense</h2>");
                        $('#'+modal_id).modal('show');

                        if(title_block_id == 'designations_modal_title') $("#"+title_block_id).html("<h2 id="+title_block_id+">Modifier une désignation</h2>");
                        $('#'+modal_id).modal('show');

                        if(title_block_id == 'recettes_modal_title') $("#"+title_block_id).html("<h2 id="+title_block_id+">Modifier une recette</h2>");
                        $('#'+modal_id).modal('show');

                        if(title_block_id == 'users_modal_title') $("#"+title_block_id).html("<h2 id="+title_block_id+">Modifier un utilisateur</h2>");
                        $('#'+modal_id).modal('show');
                    

                        if(table == tableDepense){
                            $("#date_depense").val(table.cell(".selected", 1).data())
                            //$("#code").val(table.cell(".selected", 2).data())
                            set_select2(table.cell(".selected", 3).data(), 'designation') 
                            $("#quantite").val(table.cell(".selected", 4).data())
                            $("#montant").val(table.cell(".selected", 6).data().split(' ')[0])
                        }

                        if(table == tableDesignation){
                            $("#code").val(table.cell(".selected", 1).data())
                            $("#designation").val(table.cell(".selected", 2).data())
                            $("#prix_unitaire").val(table.cell(".selected", 3).data())
                        }

                        if(table == tableRecette){
                            $("#date_recette").val(table.cell(".selected", 1).data())
                            //$("#code").val(table.cell(".selected", 2).data())
                            set_select2(table.cell(".selected", 3).data(), 'designation') 
                            $("#quantite").val(table.cell(".selected", 4).data())
                            $("#montant_ajuste").val(table.cell(".selected", 7).data().split(' ')[0])
                        }

                        if(table == tableUsers){
                            $("#nom").val(table.cell(".selected", 1).data())
                            $("#prenoms").val(table.cell(".selected", 2).data())
                            $("#email").val(table.cell(".selected", 3).data())
                            
                            $.ajax({
                                url: "<?php echo site_url() . '/Users/get_privileges_ajax/'; ?>"+tableUsers.cell(".selected", 0).data(),
                                type: "GET",
                                dataType: "json",
                                error: function(request, error) { // Info de debuggage en cas erreur         
                                            alert("Erreur : responseText: "+request.responseText);
                                        },
                                success: function(data) {
                                    console.log(data);
                                    let privileges_array = data.toString().split('');
                                            for(privilege of privileges_array){
                                                $("#"+privilege).prop('checked', true);
                                            }
                                        }       
                            });
                        }
                    }
                })
            }

            //Fonction de vérification de l'action (ajout ou mise à jours)
            function check_action(flag){
                if(flag == 'depense') return $('#depenses_modal_title h2').html() == "Modifier une dépense";
                if(flag == 'designation') return $('#designations_modal_title h2').html() == "Modifier une désignation";
                if(flag == 'recette') return $('#recettes_modal_title h2').html() == "Modifier une recette";
                if(flag == 'user') return $('#users_modal_title h2').html() == "Modifier un utilisateur";
            }

            //Fonction de retour à l'état d'arriver sur le page
            function rezero(flag){
                if(flag == 'depense'){
                    $("#modifier_depense").removeClass("btn-primary");	
                    $("#supprimer_depense").removeClass("btn-primary");
                    $("#modifier_depense").addClass("btn-default");
                    $("#supprimer_depense").addClass("btn-default");
                }

                if(flag == 'designation'){
                    $("#modifier_designation").removeClass("btn-primary");	
                    $("#supprimer_designation").removeClass("btn-primary");
                    $("#modifier_designation").addClass("btn-default");
                    $("#supprimer_designation").addClass("btn-default");
                }

                if(flag == 'recette'){
                    $("#modifier_recette").removeClass("btn-primary");	
                    $("#supprimer_recette").removeClass("btn-primary");
                    $("#modifier_recette").addClass("btn-default");
                    $("#supprimer_recette").addClass("btn-default");
                }

                if(flag == 'user'){
                    $("#modifier_user").removeClass("btn-primary");	
                    $("#statut_user").removeClass("btn-primary");
                    $("#modifier_user").addClass("btn-default");
                    $("#statut_user").addClass("btn-default");
                }
            }

            //Fonction de recuperation de l'URL de mise en corbeil
            function get_corbeil_url(flag){
                let base_url = "<?= site_url(); ?>";
                if(flag == "depense"){
                    return base_url+"/Depenses/depense_corbeil/"+tableDepense.cell(".selected", 0).data();
                }

                if(flag == "designation"){
                    return base_url+"/Designations/designation_corbeil/"+tableDesignation.cell(".selected", 0).data();
                }

                if(flag == "recette"){
                    return base_url+"/Recettes/recette_corbeil/"+tableRecette.cell(".selected", 0).data();
                }

                if(flag == "user"){
                    return base_url+"/Users/user_statut/"+tableUsers.cell(".selected", 0).data()+"/"+tableUsers.cell(".selected", 4).data();
                }
            }

            // Fonction de soumission des formulaires
            function submit_form(form_id, btn_terminer_id, table, flag){
                $('#'+form_id).on('submit', function(e){
                    e.preventDefault();
                    submit_form_ajax(e, btn_terminer_id, table, 'POST', flag);
                });
            }

            //Fin fonction mutable===========================================================================


            //Soumission du formulaire de la page profil
            $('#profil_mdp_form').on('submit', function(e){
                e.preventDefault();
                $('#profil_mdp_form_terminer').prop('disabled', true);
                $('#profil_mdp_form').find(".error_smg").remove();
                $.ajax({
                    url: e.target.action,
                    type: "POST",
                    dataType: "json",
                    data: $(e.target).serializeArray(),
                    error: function(request, error) { // Info de debuggage en cas erreur         
                                alert("Erreur : responseText: "+request.responseText);
                            },
                    success: function(data) {
                                if(data == 1){
                                    alert('Mot de passe mise à jours avec succès');
                                    $('#profil_mdp_form').get(0).reset();
                                } 
                                if(data == 2) alert("Echès de l'opération !!!")
                                if(typeof data === "object"){
                                    for(name of Object.keys(data)){
                                        if(data[name] !== ''){
                                            $('#profil_mdp_form').find("[name="+name+"]").parent().after(data[name]);
                                        }
                                    }
                                } $('#profil_mdp_form_terminer').prop('disabled', false);
                            }       
                });
            });


            // Soumission des formulaires
            submit_form('form_ajout_depense', 'terminer_ajout_depense', tableDepense, 'depense'),
            submit_form('form_ajout_designation', 'terminer_ajout_designation', tableDesignation, 'designation'),
            submit_form('form_ajout_recette', 'terminer_ajout_recette', tableRecette, 'recette'),
            submit_form('form_ajout_user', 'terminer_ajout_user', tableUsers, 'user')

            actions_on_modal_hide_init('ajouter_depense', 'form_ajout_depense', 'depenses_modal_title')
            actions_on_modal_hide_init('ajouter_designation', 'form_ajout_designation', 'designations_modal_title')
            actions_on_modal_hide_init('ajouter_recette', 'form_ajout_recette', 'recettes_modal_title')
            actions_on_modal_hide_init('ajouter_user', 'form_ajout_user', 'users_modal_title')

            set_edition_form('modifier_depense', 'depenses_modal_title', 'ajouter_depense', tableDepense)
            set_edition_form('modifier_designation', 'designations_modal_title', 'ajouter_designation', tableDesignation)
            set_edition_form('modifier_recette', 'recettes_modal_title', 'ajouter_recette', tableRecette)
            set_edition_form('modifier_user', 'users_modal_title', 'ajouter_user', tableUsers)

            put_to_corbeil('tableDepense', 'supprimer_depense', "depense", 'Dépense supprimmer avec succès')
            put_to_corbeil('tableDesignation', 'supprimer_designation', "designation", 'Désignation supprimmer avec succès')
            put_to_corbeil('tableRecette', 'supprimer_recette', "recette", 'Recette supprimmer avec succès')
            put_to_corbeil('tableUsers', 'statut_user', "user", "Statut de l'tilisateur changer avec succès")

        });
    </script>
    </body>
</html>