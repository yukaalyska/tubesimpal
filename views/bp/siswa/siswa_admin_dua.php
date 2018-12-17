 
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
                <h5>Data Siswa</h5>

            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered table-striped table-hover data-table">
                    <thead>
                        <tr>
                            <th>Nis</th>					
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Pelanggaran</th>
                            <th>Prestasi</th>
                            <th>Poin</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_siswa as $key => $value) {
  
                            ?>


                        <tr>
                            <td><?php echo $nis=$value['nis']; ?></td>
                            <td><?php echo $value['namasiswa']; ?></td>
                            <td><?php echo $list_jurusan[$value['jurusan']]; ?></td>
                            <td><?php
                            $query = $this->db->query('SELECT * FROM Pelanggaran_siswa where nis='.$nis);
                            $pel = $query->num_rows();
                            if ($pel == 0) {
                                echo "0 Pelanggaran";
                            } else { ?>
                                <a href="<?php echo $action; ?>pelanggaran_detail/<?php echo $value["nis"]; ?>"><i class="glyphicon glyphicon-pencil"></i> <?php 
                                    echo $pel." Pelanggaran";   ?></a>
                            <?php } ?>
                            </td>

                            <td><?php 
                            $query = $this->db->query('SELECT * FROM prestasi where nis='.$nis);
                            $pres = $query->num_rows();
                            if ($pres == 0) {
                                echo "0 Prestasi";
                            } else { ?>    
                                <a href="<?php echo $action; ?>prestasi_detail/<?php echo $value["nis"]; ?>"><i class="glyphicon glyphicon-pencil"></i> <?php 
                                    echo $pres." Prestasi";   ?></a>
                            <?php } ?>
                            </td>

                            <td><?php $query = $this->db->query('SELECT SUM(poin_pel) as poin_pel FROM pelanggaran_siswa where nis='.$nis)->result_array();
                                    foreach ($query as $p) {
                                        if ($p['poin_pel'] == NULL) {
                                            echo "0";
                                        } else {
                                            echo $p['poin_pel'];
                                        }
                                        
                                    }   ?></td>
                             
                           
                        </tr>
 <?php } ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
        <!-- <a href="<?php echo $action; ?>siswa_tambah/" class="btn btn-primary"> Tambah </a> -->
       
    </div>
</div>
</div>