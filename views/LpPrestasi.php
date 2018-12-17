 
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
                            <th>Kelas</th>
                           
                            <th>Detail</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_prestasi as $key => $value) { ?>
                            <tr>
                                <td class="center"><?php echo $value['nis']; ?></td>
                                <td class="center"><?php echo $value['namasiswa']; ?></td>
                                <td class="center"><?php echo $list_jurusan[$value['jurusan']]; ?></td>
                                
                                <td>
                                    <a href="<?php echo $action; ?>prestasi_detail/<?php echo $value["nis"]; ?>"><i class="glyphicon glyphicon-pencil"></i> Detail</a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
       <a  class="btn btn-primary" href="<?php echo $action . "prestasi_laporan" ; ?> " target="_blank">Cetak Laporan
        </a>
    </div>
</div>
