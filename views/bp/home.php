<div id="breadcrumb">
    <a href="#" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
</div>
 
<div class="row">
    <div class="col-xs-12">
        <div class="alert alert-info">
                 
                Selamat Datang di <strong>Aplikasi Aplikasi Pengelolaan Data Non Akademik Siswa Berbasis Web</strong>. Don't forget to check all the pages!
                <br>Informasi Non Akademik Siswa Berbasis Web adalah informasi yang tidak berhubungan dengan kegiatan akademik siswa.
                <br>Contoh informasi non akademik yaitu pelanggaran dan prestasi siswa.
                <a href="#" data-dismiss="alert" class="close">×</a>
            </div>
    </div>
    <div class="col-xs-12">
        <div class="widget-box">

            <div class="widget-title">
                <span class="icon">
                    <i class="fa fa-th"></i>
                </span>
                <h5>Pengumuman</h5>

            </div>
            <div class="widget-content nopadding">
                 <table class="table table-bordered table-striped table-hover data-table">
            <thead>
                <tr>
                    <th></th>                  
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($list_berkas as $key => $value) {
                    $urlGambar = $urlberkas . "" . $value['berkas'];
                    ?>


                    <tr>

                        <td align="center">

                            <img src="<?php echo $urlGambar; ?>" class="img-responsive"  style="width: 500px;"> 

                            <a href="<?php echo $urlberkas . "" . $value['berkas']; ?> " target="_blank"><?php echo $value['judul']; ?>
                                        </a>
                        </td>





                    </tr>
<?php } ?>
            </tbody>

        </table>
            </div>
        </div>
         
    </div>
</div>
</div>
