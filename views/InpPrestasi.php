 
<!-- <div id="content"> -->
<!-- <div id="content-header">
        <h1>Input Prestasi</h1>
</div>  -->
<div id="breadcrumb">
    <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
    <a href="#">Menu Prestasi</a>
    <a href="#" class="current">Input Prestasi</a>
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
                    <h5>Data Siswa</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <!--NormalTextInput-->
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">NIS</label>
                            <div class="col-sm-3">
                                <?php
   if ($typeForm =="ubah"){
       ?>
                                 <input type="text" class="form-control input-sm" name="nis" id="nis" value="<?php echo $valueData['nis']; ?>" readonly="">
                                <?php
   }else{ ?>
                                <select name="nis" onchange="getSiswa(this.value);" id="nis">
                                    <option></option>
                                    <?php
                                    foreach ($list_siswa as $keys => $values) {
                                   
                                        if ($valueData['nis'] == $values['nis']) {
                                            echo "<option value='" . $values['nis'] . "' selected> " . $values['nis'] . "</option>";
                                        } else {
                                            echo "<option value='" . $values['nis'] . "'> " . $values['nis'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
   <?php } ?>                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">Nama Siswa</label>
                            <div class="col-sm-3">
                                 <input type="text" class="form-control input-sm" name="namasiswa" id="namasiswa" value="" readonly="">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">Kelas</label>
                            <div class="col-sm-3">
                                 <input type="text" class="form-control input-sm" name="jurusan" id="jurusan" value="" readonly="">
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">Kategori Prestasi</label>
                            <div class="col-sm-9 col-md-9 col-lg-10">
                                <select name="kategori_prestasi">
                                    <?php
                                    foreach ($list_prestasi as $prestasi) {
                                        if ($valueData['kategori_prestasi'] == $prestasi) {
                                            echo "<option value='" . $prestasi . "' selected> " . $prestasi . "</option>";
                                        } else {
                                            echo "<option value='" . $prestasi . "'> " .$prestasi . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">Keterangan</label>
                            <div class = "col-sm-9 col-md-9 col-lg-5">
                                <input type = "text" value = "<?php echo $valueData['keterangan']; ?>" name = "keterangan" class = "form-control input-sm" />
                            </div>
                        </div>
                        <!--NormalTextInput-->
                        <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">Apresiasi/Reward</label>
                            <div class = "col-sm-9 col-md-9 col-lg-5">
                                <input type = "text" name="apresiasi" value = "<?php echo $valueData['apresiasi']; ?>"class = "form-control input-sm" />
                            </div>
                        </div>
                        <!--DatePicker-->
                        <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">Tanggal</label>
                            <div class = " col-sm-9 col-md-9 col-lg-3">
                                <div class = "row">
                                    <div class = "col-md-6">
                                        <div class = "input-group input-group-sm date datepicker" data-date = sysdate data-date-format = "yyyy-mm-dd">
                                            <span class = "input-group-addon"><i class = "fa fa-calendar"></i></span>
                                            <input type = "text" name = "tanggal" value = "<?php echo $valueData['tanggal']; ?>" class = "form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">File upload *jika ada</label>
                            <div class = "col-sm-9 col-md-9 col-lg-10">
                                <input type = "file" name = "foto1">
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">File upload *jika ada</label>
                            <div class = "col-sm-9 col-md-9 col-lg-10">
                                <input type = "file" name = "foto2" />
                            </div>
                        </div>
                        <!--ActionButton-->
                        <div class = "form-actions">
                            <button type = "submit"  name="kirim" name="kirim" class = "btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script>
<?php
   // if ($typeForm =="ubah"){
?>
    $(document).ready(function() {
        var nis = $("#nis").val();
         getSiswa(nis);
    });

  <?php //}  ?>
    
function getSiswa(nis){
        $.ajax({
            type: "POST",
            data: "nis=" + nis,
            url: "<?php echo site_url('c_home/get_siswa'); ?>",
            dataType: 'json',
            success: function(result) {
                $("#namasiswa").val(result.namasiswa);
                $("#jurusan").val(result.jurusan);
                $("#kelas").val(result.kelas);
               
            }
        });
    }

</script>