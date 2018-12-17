 <?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-info">
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>
<?php }
if ($this->session->flashdata('error')) {  ?>
<div class="alert alert-danger">
        <strong><?php echo $this->session->flashdata('error'); ?></strong>
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>

<?php }?>
 
