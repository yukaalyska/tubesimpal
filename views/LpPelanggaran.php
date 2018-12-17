
<div id="breadcrumb">
    <a href="#" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">Laporan</a>
</div>

<div class="row">
    <div class="col-xs-12">
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
                            <th>NIS</th>
                            <th>Nama Siswa</th>
<!--                            <th>Jenis Pelanggaran</th>
                            <th>Tanggal</th>-->
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_pelanggaran_siswa as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['nis']; ?></td>
                                <td><?php echo $value['namasiswa']; ?></td>
    <!--                                <td><?php echo $value['jenis_pelanggaran']; ?></td>
                                <td class="center"><?php echo $value['tgl_pelanggaran']; ?></td>-->
                                <td>
    <!--                                    <a href="<?php echo $action; ?>pelanggaran_edit/<?php echo $value["id_pelanggaran_siswa"]; ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a href="<?php echo $action; ?>pelanggaran_siswa_hapus/<?php echo $value["id_pelanggaran_siswa"]; ?>"onclick="return confirm('Anda yakin mau menghapus Data ini ')"><i class="glyphicon glyphicon-remove"></i> Hapus</a>
                                    -->
                                    <a href="<?php echo $action; ?>pelanggaran_detail/<?php echo $value["nis"]; ?>"><i class="glyphicon glyphicon-pencil"></i> Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <a  class="btn btn-primary" href="<?php echo $action . "pelanggaran_laporan"; ?> " target="_blank">Cetak Laporan
        </a>
    </div>
</div>

