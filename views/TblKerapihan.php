 
<div id="breadcrumb">
    <a href="#" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">Tabel Tata Tertib</a>
    <a href="#" class="current"><?php echo $nama_aspek; ?></a>
</div>
<div class="container-fluid">
    <?php
                 if($type==1){ 
                ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-info">
                <strong>Berikut adalah Tabel <?php echo $nama_aspek;?>. Klik salah satu baris untuk edit atau hapus tabel !</strong>
                <a href="#" data-dismiss="alert" class="close">×</a>
            </div>
        </div>
    </div>
                 <?php } ?>
</div>

<div class="row">
    <?php
    if ($type == 1) {
        ?>
        <div class="col-xs-12">
            <a href="<?php echo $action; ?>tata_tertib_tambah/<?php echo $segment2; ?>" class="btn btn-primary"> Tambah </a>
        </div>
    <?php } ?>
    <div class="col-xs-12">
        <div class="widget-box">

            <div class="widget-title">
                <span class="icon">
                    <i class="fa fa-th"></i>
                </span>
                <h5>Aspek Kerapihan</h5>

            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered table-striped table-hover data-table">
                    <thead>
                        <tr>
                            <th>Jenis Pelanggaran</th>					
                            <th>Sanksi</th>
                            <th>Poin/Bobot</th>
                            <?php
                            if ($type == 1) {
                                ?> <th>Aksi</th> <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_tata_tertib as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['jenis_pelanggaran']; ?></td>
                                <td><?php echo $value['sanksi_pelanggaran']; ?></td>
                                <td><?php echo $value['poin_pelanggaran']; ?></td>

                                <?php
                                if ($type == 1) {
                                    ?>
                                    <td> <a href="<?php echo $action; ?>tata_tertib_edit/<?php echo $value["id_aspek"] . '/' . $value["idpelanggaran"]; ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                        <a href="<?php echo $action; ?>tata_tertib_hapus/<?php echo $value["id_aspek"] . '/' . $value["idpelanggaran"]; ?>"onclick="return confirm('Anda yakin mau menghapus Jenis Pelanggaran : <?php echo $value["jenis_pelanggaran"] ?>')"><i class="glyphicon glyphicon-remove"></i> Hapus</a></td>
                                <?php } ?>

                                </tr>
                            <?php } ?>

                </table>
            </div>
        </div>
        <!--<button class="btn btn-primary">Cetak Tabel</button>-->
    </div>
</div>
</div>
