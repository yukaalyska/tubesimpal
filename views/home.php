<?php $this->load->view('asset/tempatcssdll'); ?>
   <?php $this->load->view('asset/menu_samping'); ?>
<!--Home-->
<div id="content">
    <div id="content-header" class="mini">
        <h1><?php echo $title; ?></h1>
    </div>
    <?php $this->load->view('v_message');
    if($semester==1){
        $namaSemester = 'Ganjil';
        
    }else{
        $namaSemester = 'Genap';
    }
    $tahun = $year;
    $tahun2 = $year+1;
    
 
    ?>
   <ul class="breadcrumb">
       <li class="active pull-right">Semester <?php echo $namaSemester.', '.$tahun.'/'.$tahun2; ?>        </li></ul>
    <?php $this->load->view($content); ?>				
</div>	
<?php $this->load->view('asset/footer'); ?>		
