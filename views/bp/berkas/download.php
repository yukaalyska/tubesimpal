 <div id="breadcrumb">
    <a href="#" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
    <a href="#" class="current">Peraturan</a>
    <a href="#" class="current"><?php echo $title; ?></a>
</div>


<div class="row">
    <!--    <div class="col-xs-12">
            <a href="<?php echo $action; ?>zzguru_tambah/" class="btn btn-primary"> Tambah </a>
        </div>-->
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
                            <th>No</th>					
                            <th>Nama Berkas</th>					
                            <th>Keterangan</th>
                            <th>Tgl Upload</th>
                          <?php  if ($type == 1) {  ?>   <th>Aksi</th> <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_berkas as $key => $value) {
                            ?>


                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td>
                                    <?php if ($value['berkas']) { ?>
                                        <a href="<?php echo $urlberkas . "" . $value['berkas']; ?> " target="_blank"><?php echo $value['judul']; ?>
                                        </a>
                                    <?php
                                    } else {

                                        echo $value['judul'];
                                    }
                                    ?>

                                </td>
                                <td><?php echo $value['keterangan']; ?></td>
                                <td><?php echo $value['tgl_upload']; ?></td>
                                 <?php  if ($type == 1) {  ?><td>

                                    <a href="<?php echo $action; ?>upload_edit/<?php echo $value["id_konseling"].'/'.$tipeberkas; ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                     
                                    <a href="<?php echo $action; ?>download_hapus/<?php echo $value["id_konseling"].'/'.$value['type']; ?>"onclick="return confirm('Anda yakin mau menghapus Data ini ')"><i class="glyphicon glyphicon-remove"></i> Hapus</a>


                                 </td> <?php } ?>


                            </tr>
<?php } ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
</div>
