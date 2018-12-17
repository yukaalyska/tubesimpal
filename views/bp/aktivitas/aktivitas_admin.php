 
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
                            <th>NO</th>					
                            <th>User Name</th>
                            <th>Tipe User</th>
                            <th>Tgl</th>
                            <th>Aktifitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_aktifitas as $key => $value) {
                            
                            ?>


                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value['username']; ?></td>
                                <td><?php echo $list_status[$value['status']]; ?></td>
                                <td><?php echo $value['tgl']; ?></td>
                                <td><?php echo $value['aktivitas']; ?></td>
 

                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
         
    </div>
</div>
</div>
