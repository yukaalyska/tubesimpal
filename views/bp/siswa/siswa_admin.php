 
<div id="breadcrumb">
    <a href="#" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">Tabel Master</a>
    <a href="#" class="current">Siswa</a>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
        </div>
    </div>
</div>

<div class="row">

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
                            <th>Nis</th>					
                            <th>Nama</th>
                            <th>Kelas</th>
                             <th>User Status</th>
                            <th>User Describe</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_siswa as $key => $value) {
  
                            ?>


                        <tr>
                            <td><?php echo $value['nis']; ?></td>
                            <td><?php echo $value['namasiswa']; ?></td>
                            <td><?php echo $list_jurusan[$value['jurusan']]; ?></td>
                              <td><?php echo $list_status_aktif[$value['user_active']]; ?></td>
                                <td><?php echo $value['user_desc']; ?></td>
                             <td> <a href="<?php echo $action; ?>siswa_edit/<?php echo $value["nis"];?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
<!--                            <a href="<?php echo $action; ?>siswa_hapus/<?php echo $value["nis"];?>"onclick="return confirm('Anda yakin mau menghapus Siswa : <?php echo $value["namasiswa"]?>')"><i class="glyphicon glyphicon-remove"></i> Hapus</a>-->
                             </td>
                           
                        </tr>
 <?php } ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
        <a href="<?php echo $action; ?>siswa_tambah/" class="btn btn-primary"> Tambah </a>
       
    </div>
</div>
</div>
