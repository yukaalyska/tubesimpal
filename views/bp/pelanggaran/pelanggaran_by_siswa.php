
<div id="breadcrumb">
    <a href="#" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">Laporan</a>
</div>

<div class="row">
    <div class="col-xs-12">
        <legend>Data Siswa</legend>

        <table class="table">
            <tr>
                <td>Nis</td>
                <td>:</td>
                <td><?php echo $dataSiswa->nis; ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo $dataSiswa->namasiswa; ?></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td><?php echo $list_jurusan[$dataSiswa->jurusan]; ?></td>
            </tr>
<!--            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><?php echo $dataSiswa->kelas; ?></td>
            </tr>-->
            <tr>
                <td>Total Poin </td>
                <td>:</td>
                <td><?php echo $dataSiswa->total_poin; ?></td>
            </tr>
        </table>


        <div class="widget-box">						
            <div class="widget-title">
                <span class="icon">
                    <i class="fa fa-th"></i>
                </span>
                <h5>Laporan</h5>
            </div>							
            <div class="widget-content nopadding">

                <?php
                $nis = $dataSiswa->nis;
                $condition = array('pelanggaran_siswa.nis' => $nis,'pelanggaran_siswa.semester'=>$semester,'pelanggaran_siswa.year'=>$year);
                $join = array(
                    'siswa' => 'siswa.nis = pelanggaran_siswa.nis',
                    'aspek' => 'aspek.id_aspek = pelanggaran_siswa.id_aspek',
                    'pelanggaran' => 'pelanggaran.idpelanggaran = pelanggaran_siswa.idpelanggaran'
                );
                $list_pelanggaran_siswa = $this->pelanggaran_siswa->selectTableWithJoin($condition, $join)->result_array();
                ?>


                <table class="table table-bordered table-striped table-hover data-table">
                    <thead>
                        <tr>
                            <th>Aspek Pelanggaran</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Sanksi</th>
                            <th>Poin</th>
                            <th>Tanggal</th>
                             <?php  if ($type == 1) {  ?><th>Aksi</th> <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_pelanggaran_siswa as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['nama_aspek']; ?></td>
                                <td><?php echo $value['jenis_pelanggaran']; ?></td>
                                <td><?php echo $value['sanksi_pelanggaran']; ?></td>
                                <td><?php echo $value['poin_pel']; ?></td>
                                <td class="center"><?php echo $value['tgl_pelanggaran']; ?></td>
                                 <?php  if ($type == 1) {  ?>
                                <td>
                                    <a href="<?php echo $action; ?>pelanggaran_edit/<?php echo $value["id_pelanggaran_siswa"]; ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a href="<?php echo $action; ?>pelanggaran_siswa_hapus/<?php echo $value["id_pelanggaran_siswa"]; ?>"onclick="return confirm('Anda yakin mau menghapus Data ini ')"><i class="glyphicon glyphicon-remove"></i> Hapus</a>

                                </td>
                                 <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
       
        <a  class="btn btn-primary" href="<?php echo $action . "pelanggaran_laporan/" . $nis; ?> " target="_blank">Cetak Laporan
        </a>
    </div>
</div>

