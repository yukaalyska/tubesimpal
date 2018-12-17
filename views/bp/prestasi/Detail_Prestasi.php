 
<!-- <div id="content-header">
        <h1>Laporan</h1>
</div>
<div class="alert alert-info">
        <strong>Berikut adalah Preview Laporan Prestasi. Klik salah satu baris untuk melihat detail view !</strong>.
        <a href="#" data-dismiss="alert" class="close">×</a>
</div> -->
<div id="breadcrumb">
    <a href="#" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="">Menu Prestasi</a>
    <a href="#" class="current">Laporan</a>
</div>
<div class="row">
    <div class="col-xs-12">
        <legend>Data Siswa</legend>

        <?php foreach ($dataSiswa as $value) {
            ?>

            <table class="table">
                <tr>
                    <td width="20%">Nis</td>

                    <td><?php echo $value["nis"]; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>

                    <td><?php echo $value["namasiswa"]; ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>

                    <td><?php echo $list_jurusan[$value["jurusan"]]; ?></td>
                </tr>
<!--                <tr>
                    <td>Kelas</td>

                    <td><?php echo $value["kelas"]; ?></td>
                </tr>-->

            </table>
            <?php
            $nis = $value["nis"];
            $join = array(
                'siswa' => 'siswa.nis = prestasi.nis',
            );
              
            $condition = array('prestasi.nis' => $nis,'prestasi.year'=>$year,'prestasi.semester'=>$semester);
            $list_prestasi = $this->prestasi->selectTableWithJoin($condition, $join)->result_array();
            ?>
            <div class="widget-box">						
                <div class="widget-title">
                    <span class="icon">
                        <i class="fa fa-th"></i>
                    </span>
                    <h5>Laporan</h5>
                </div>							
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                            <tr>
                                <th>Kategori Prestasi</th>
                                <th>Keterangan</th>
                                <th>Reward</th>
                                <th>Tanggal</th>
                                <th>Bukti Sertifikat</th>
                                <?php  if ($type == 1) {  ?> <td>Aksi</td> <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list_prestasi as $key => $value) {
                                $fileGambar = $value["foto"];
                                $urlGambar = ($value["foto"]) ? $urlprestasi . '' . $fileGambar : $no_image;
                                $fileGambar2 = $value["foto2"];
                                $urlGambar2 = ($value["foto2"]) ? $urlprestasi . '' . $fileGambar2 : $no_image;
                                ?>
                                <tr>
                                    <td class="center"><?php echo $value['kategori_prestasi']; ?></td>

                                    <td class="center"><?php echo $value['keterangan']; ?></td>
                                    <td class="center"><?php echo $value['apresiasi']; ?></td>
                                    <td class="center"><?php echo $value['tanggal']; ?></td>
                                    <td class="center"> 
                                        <img src="<?php echo $urlGambar; ?>" class="img-responsive" alt="<?php echo $value["foto"]; ?>" style="width: 120px;"> 
                                        <img src="<?php echo $urlGambar2; ?>" class="img-responsive" alt="<?php echo $value["foto2"]; ?>" style="width: 120px;"> 

                                    </td>
                                       <?php  if ($type == 1) {  ?>
                                <td>
                                    <a href="<?php echo $action; ?>prestasi_edit/<?php echo $value["idprestasi"]; ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a href="<?php echo $action; ?>prestasi_hapus/<?php echo $value["idprestasi"]; ?>"onclick="return confirm('Anda yakin mau menghapus Data ini ')"><i class="glyphicon glyphicon-remove"></i> Hapus</a>

                                </td>
                                 <?php } ?>
                                </tr>
 

 


                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <a  class="btn btn-primary" href="<?php echo $action . "prestasi_laporan/".$nis ; ?> " target="_blank">Cetak Laporan
        </a>
        </div>
    </div>
<?php } ?>