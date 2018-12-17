
<!-- <div id="content">
        <div id="content-header">
                <h1></h1>
</div>
-->
<?php 

    
    $type ="Input tata Tertib";
?>
<div id="breadcrumb">
    <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
     <a href="#" class="current">Tabel Tata Tertib</a>
    <a href=""><?php echo $nama_aspek; ?></a>
    <a href="#" class="current"><?php echo $type; ?></a>
</div> 
<div class="container-fluid">
    <!--Data Siswa-->
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="fa fa-align-justify"></i>									
                    </span>
                    <h5>Data <?php echo $nama_aspek; ?></h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="" method="post" class="form-horizontal">
                        <!--NormalTextInput-->
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">Jenis Pelanggaran</label>
                            <div class="col-sm-9 col-md-9 col-lg-10">
                                <input name="jenis_pelanggaran" type="text" class="form-control input-sm" value="<?php echo $valueData['jenis_pelanggaran']; ?>" />
                            </div>
                        </div>
                        <!--NormalTextInput-->
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">Sanksi</label>
                            <div class="col-sm-9 col-md-9 col-lg-10">
                                <input type="text" name="sanksi_pelanggaran" class="form-control input-sm" value="<?php echo $valueData['sanksi_pelanggaran']; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">Poin/Bobot</label>
                            <div class="col-sm-9 col-md-9 col-lg-10">
                                <input type="text" name="poin_pelanggaran" class="form-control input-sm" value="<?php echo $valueData['poin_pelanggaran']; ?>"/>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>						
        </div>
    </div>
</div>
