<style type="text/css">
    .select2-container .select2-choice > .select2-chosen {
    margin-right: 90px;
    
}
</style>

<div id="breadcrumb">
    <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
    <a href="#">Menu Pelanggaran</a>
    <a href="#" class="current">Input Pelanggaran</a>
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
                    <form action="" method="post" class="form-horizontal">
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
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">Aspek Pelanggaran</label>
                            <div class="col-sm-3">
                                <select  class="col-3" name="id_aspek" id="id_aspek" onchange="getPilihan(this.value);" class="col-sm-3">
                                    <option></option>
                                    <?php
                                    foreach ($list_tata_tertib as $values) {
                                         
                                        if ($valueData['id_aspek'] == $values['id_aspek']) {
                                            echo "<option value='" . $values['id_aspek'] . "' selected> " . $values['nama_aspek'] . "</option>";
                                        } else {
                                            echo "<option value='" . $values['id_aspek'] . "'> " . $values['nama_aspek'] . "</option>";
                                        }
                                    }
                                    
                                   
                                    ?>


                                </select>
                            </div>
                        </div>
                        <!--SelectInput-->
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">Jenis Pelanggaran</label>
                             <div class="col-md-10">
                                <select name="idpelanggaran" id="idpelanggaran" onchange="getPoin(this.value)" class="">
                                    <option></option>
                                    <?php
                                    foreach ($pelanggaran as $valuep) {

                                        if ($valueData['idpelanggaran'] == $valuep['idpelanggaran']) {
                                            echo "<option value='" . $valuep['idpelanggaran'] . "' selected> " . $valuep['jenis_pelanggaran'] . "</option>";
                                        } else {
                                            echo "<option value='" . $valuep['idpelanggaran'] . "'> " . $valuep['jenis_pelanggaran'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!--NormalTextInput-->
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">Poin/Bobot</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control input-sm" id="poin_pelanggaran" name="poin_pelanggaran"  value="<?php echo $valueData['poin_pel']; ?>" readonly=""/>
                            </div>
                        </div>
                        <!--DatePicker-->
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-lg-2 control-label">Tanggal</label>
                            <div class=" col-sm-9 col-md-9 col-lg-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm date datepicker" data-date=sysdate data-date-format="yyyy-mm-dd">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text"  value="<?php echo $valueData['tgl_pelanggaran']; ?>"  class="form-control"  name="tgl_pelanggaran"/>           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>						
        </div>
    </div>
</div>
</div>
 <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script>
<?php
   if ($typeForm =="ubah"){
?>
    $(document).ready(function() {
        var nis = $("#nis").val();
         getSiswa(nis);
         var id_aspek = $("#id_aspek").val();
         getPilihan(id_aspek);
    });

  <?php }  ?>
    function getPilihan(aspek_id) {
        $.ajax({
            type: "POST",
            data: "id_aspek=" + aspek_id,
            url: "<?php echo site_url('c_home/get_pelanggaran'); ?>",
            update: '#jenis_pelanggaran', //selector to update  
            success: function (data) {
                $("#idpelanggaran").html(data).change();
            }
        });
    }

    function getPoin(idpelanggaran) {
        $.ajax({
            type: "POST",
            data: "idpelanggaran=" + idpelanggaran,
            url: "<?php echo site_url('c_home/get_poin'); ?>",
            success: function (data) {


                $("#poin_pelanggaran").val(data);

            }
        });
    }

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