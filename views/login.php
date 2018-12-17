 <!DOCTYPE html>
<html lang="en">
    <head>
        <title>Halaman Login</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php $this->load->view('asset/tempatcssdll'); ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/unicorn-login.css" />
    </head>    <body>
        <div id="container">
            <div id="logo">
                <img src="<?php echo $Url; ?>smk3.png" alt="" />
            </div>
            
                 <?php $this->load->view('v_message'); ?>
            <div id="loginbox">   
                <form id="loginform" method="post" action="">
                    <p>Enter username and password to continue.</p>
                    <div class="input-group input-sm">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span><input class="form-control" type="text" id="username" placeholder="Username" name="username" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span><input class="form-control" type="password" id="password" placeholder="Password"  name="password"/>
                    </div>
                    <div class="form-actions clearfix">
                        <input type="submit" class="btn btn-block btn-primary btn-default" value="Login" />
                    </div>
                </form>


            </div>
        </div>

        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>  
     <script src="<?php echo base_url(); ?>js/jquery-ui.custom.min.js"></script>
    <?php $this->load->view('asset/footer'); ?>	
</html>
