<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <div>
                            <h1 class='site_title'>Resto</h1>
                        </div>
                        <div data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="text-muted text-xs block"><?= $this->session->userdata('nom') ?></span>
                            <span class="text-muted text-xs block"><?= $this->session->userdata('prenoms') ?></span>
                        </div>
                    </div>
                    <div class="logo-element">
                        Resto
                    </div>
                </li>
                <li>
                    <!-- <a href="<?= site_url(); ?>/Dashboard"><i class="fa fa-line-chart"></i> <span class="nav-label">Dashboard</span></a> -->
                </li>
                <?php if(in_array(5, $this->session->userdata('privileges'))): ?>
                <li>
                    <a href="<?= site_url(); ?>/Depenses"><i class="fa fa-money"></i> <span class="nav-label">Dépences</span></a>
                </li>
                <?php endif ?>
                <?php if(in_array(4, $this->session->userdata('privileges'))): ?>
                <li>
                    <a href="<?= site_url(); ?>/Recettes"><i class="fa fa-list"></i> <span class="nav-label">Recettes</span></a>
                </li>
                <?php endif ?>
                <?php if(in_array(6, $this->session->userdata('privileges'))): ?>
                <li>
                    <a href="<?= site_url(); ?>/Designations"><i class="fa fa-tags"></i> <span class="nav-label">Désignations</span></a>
                </li>
                <?php endif ?>
                <?php if(in_array(7, $this->session->userdata('privileges'))): ?>
                <li>
                    <a href="<?= site_url(); ?>/Corbeil"><i class="fa fa-trash"></i> <span class="nav-label">Corbeil</span></a>
                </li>
                <?php endif ?>
                <?php if(in_array(8, $this->session->userdata('privileges'))): ?>
                <li>
                    <a href="<?= site_url(); ?>/Users"><i class="fa fa-users"></i> <span class="nav-label">Utilisateurs</span></a>
                </li>
                <?php endif ?>
                <li>
                    <a href="<?= site_url(); ?>/Profil"><i class="fa fa-user-circle"></i> <span class="nav-label">Profil</span></a>
                </li>
            </ul>

        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="<?= site_url(); ?>/Login/deconnexion">
                        <i class="fa fa-sign-out"></i> Déconnexion
                    </a>
                </li>
            </ul>
        </nav>
    </div>