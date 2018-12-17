 
<div id="breadcrumb">
    <a href="#" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">Tabel Master</a>
    <a href="#" class="current">Guru</a>
</div>


<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">

            <div class="widget-title">
                <span class="icon">
                    <i class="fa fa-th"></i>
                </span>
                <h5><?php echo $title; ?></h5>

            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered table-striped table-hover data-table">
                    <thead>
                        <tr>
                            <th>NIP</th>					
                            <th>Nama</th>
                            <th>Status</th>
                            <th>User Status</th>
                            <th>User Describe</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_guru as $key => $value) {
                            ?>


                            <tr>
                                <td><?php echo $value['nip']; ?></td>
                                <td><?php echo $value['nama']; ?></td>
                                <td><?php echo $list_status[$value['status']]; ?></td>
                                <td><?php echo $list_status_aktif[$value['user_active']]; ?></td>
                                <td><?php echo $value['user_desc']; ?></td>

                                <td> <a href="<?php echo $action; ?>guru_edit/<?php echo $value["nip"]; ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
<!--                                    <a href="<?php echo $action; ?>guru_hapus/<?php echo $value["nip"]; ?>"onclick="return confirm('Anda yakin mau menghapus Guru : <?php echo $value["nama"] ?>')"><i class="glyphicon glyphicon-remove"></i> Hapus</a>-->
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
        <a href="<?php echo $action; ?>guru_tambah/" class="btn btn-primary"> Tambah </a>
        
    </div>
</div>
</div>
