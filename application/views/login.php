
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Resto | Login</title>

    <link rel="icon" href="<?= base_url(); ?>assets/ico/ico.jpeg"  sizes="32x32" />
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="text-center animated fadeInDown">
        <div>
            <div class='login_title'>

                <h1 class="logo-name">Resto</h1>

            </div>
            
            <div class='login_form_box'>
            <?php if($this->session->flashdata('error')):?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error');?></div>
            <?php endif;?>
                <form class="m-t" role="form" method="POST" action="<?= site_url(); ?>/Login/connexion">
                    <div class="form-group text-left">
                        <input name='email' type="email" class="form-control" placeholder="Email" value="<?php echo set_value('email');?>"  required>
                        <?php echo form_error('email','<span class="label label-important">','</span>');?>
                    </div>
                    <div class="form-group">
                        <input name='pass' type="password" class="form-control" placeholder="Mot de passe" value="<?php echo set_value('password');?>" required>
                        <?php echo form_error('pass','<span class="label label-important">','</span>');?>
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Se connecter</button>

                    <a href="#">Mot de passe oublier ?</a>
                </form>
            </div>
            <p class="m-t"> <small>INOVACT &copy; 2022</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    

</body>

</html>
