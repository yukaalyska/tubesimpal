     <?php 
 if($type == 3){
     $nis = $this->session->userdata("nis");
    $profile ="siswa_edit/".$nis;
 }else{
    $nip = $this->session->userdata("nip");
    $profile ="guru_edit/".$nip;   
 }

 
 ?>

<body data-color="grey" class="flat">
    <div id="wrapper">
        <div id="header">
            <h1><a href="./index.html"></a></h1>
            <a id="menu-trigger" href="#"><i class="fa fa-bars"></i></a>	
        </div>

        <!--Menu Bar-->
       <div id="user-nav">
	            <ul class="btn-group">	                
	                <li class="btn dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="fa fa-user"></i> <span class="text"><?php echo $nama; ?></span>  <b class="caret"></b></a>
	                    <ul class="dropdown-menu messages-menu">
	                        <li class="title"><i class="fa fa-envelope-alt"></i>Profile<a class="title-btn" href="#" title="Write new message"><i class="fa fa-share"></i></a></li>
	                        <li class="message-item">
	                        	<a href="<?php echo $action.''.$profile.'/2'; ?>">
                                                     Detail User 
	                        	</a>
	                        </li>
	                        <li class="message-item">
	                        	<a href="<?php echo $action.'tahun_ajaran'; ?>">
                                                     Ubah Tahun Ajaran 
	                        	</a>
	                        </li>
	                         
	                         
	                    </ul>
	                </li>
	                
	                <li class="btn"><a title="" href="<?php echo $action . 'logout'; ?>"><i class="fa fa-share"></i> <span class="text">Keluar</span></a></li>
	            </ul>
	        </div>

        <div id="sidebar">
            <ul>

                <li class="<?php
                if ($segment == "index" or $segment == false) {
                    echo "active";
                }
                ?>"><a href="<?php echo $action; ?>index"><i class="fa fa-home"></i> <span><?php //echo $type; ?>Home</span></a></li>

                <?php
                if ($type == 1) {
                    ?>
                    <!--                Tabel Master-->
                    <li class="submenu <?php
                    if ($segment == "siswa" || $segment == "guru" || $segment == "aspek" || $segment == "siswa_tambah" or $segment == 'guru_tambah') {
                        echo "active open";
                    }
                    ?>">
                        <a href="#"><i class="fa fa-th"></i> <span><?php //echo $segment; ?>Tabel Master</span> <i class="arrow fa fa-chevron-right"></i></a>
                        <ul>
                            <!--<li class=""><a href="<?php echo $action; ?>aspek/">Data Aspek</a></li>-->
                            <li class="<?php
                            if ($segment == "guru_tambah" || $segment == "guru" or $segment == false) {
                                echo "active";
                            }
                            ?>"><a href="<?php echo $action; ?>guru/">  Data Guru</a></li>
                            <li class="<?php
                            if ($segment == "siswa_tambah" || $segment == "siswa") {
                                echo "active";
                            }
                            ?>"><a href="<?php echo $action; ?>siswa/">Data Siswa</a></li>

                        </ul>
                    </li>

                <?php } ?>
                <li class="submenu <?php
                if ($segment == "tata_tertib" || $segment == "tata_tertib_tambah" || $segment == "tata_tertib_edit") {
                    echo "active open";
                }
                ?>">
                    <a href="#"><i class="fa fa-th"></i> <span>Tabel Tata Tertib</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li class="<?php
                        if ($id_aspek == "1") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo $action; ?>tata_tertib/1">Aspek Kerapihan</a></li>
                        <li class="<?php
                        if ($id_aspek == "2") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo $action; ?>tata_tertib/2">Aspek Kerajinan</a></li>
                        <li class="<?php
                        if ($id_aspek == "3") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo $action; ?>tata_tertib/3">Aspek Kelakuan</a></li>
                        <li class="<?php
                        if ($id_aspek == "4") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo $action; ?>tata_tertib/4">Lain-lain</a></li>
                    </ul>
                </li>
                <li class="submenu <?php
                if ($segment == "pelanggaran_input" || $segment == "pelanggaran" || $segment=="pelanggaran_detail" || $segment =="pelanggaran_edit") {
                    echo "active open";
                }
                ?>">
                    <a href="#"><i class="fa fa-th-list"></i> <span>Menu Pelanggaran </span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                      
                        <?php  if ($type == 2) {  ?>
                          
                            <li class="<?php
                            if ($segment == "pelanggaran_input") {
                                echo "active";
                            }
                            ?>"><a href="<?php echo $action; ?>pelanggaran_input">Input Pelanggaran</a></li>
                            <?php } ?>
                        <li class="<?php
                        if ($segment == "pelanggaran") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo $action; ?>pelanggaran">Laporan</a></li>
                    </ul>
                </li>
                <li class="submenu <?php
                
                if ($segment == "prestasi_input" || $segment == "prestasi" || $segment=="prestasi_detail" || $segment == "prestasi_edit" ) {
                    echo "active open";
                } 
           
                ?>">
                    <a href="#"><i class="fa fa-th-list"></i> <span>Menu Prestasi</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                         <?php  if ($type == 1) {  ?>
                        <li class="<?php
                        if ($segment == "prestasi_input") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo $action; ?>prestasi_input">Input Prestasi</a></li>
                         <?php } ?>
                        <li class="<?php
                        if ($segment == "prestasi") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo $action; ?>prestasi">Laporan</a></li>							
                    </ul>
                </li>
                <li class="submenu <?php
                if ($segment == "download" || $segment == "upload") {
                    echo "active open";
                }
                ?>">
                    <a href="#"><i class="fa fa-th-list"></i> <span>Berkas Konseling</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li class="<?php
                        if ($segment == "download") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo $action; ?>download">Download Berkas</a></li>
                        
                        <?php  if ($type == 2) {  ?> <li class="<?php
                        if ($segment == "upload") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo $action; ?>upload/1">Upload Berkas</a></li> <?php } ?>
                    </ul>
                </li>



                <li class="submenu <?php
                if ($segment == "peraturan" || $segment=="peraturan_tambah" ) {
                    echo "active open";  
                }
                ?>">
                    <a href="#"><i class="fa fa-th-list"></i> <span>Peraturan</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li class=""><a href="<?php echo $action; ?>peraturan">Peraturan Berkas</a></li>
                         <?php  if ($type == 1) {  ?><li class=""><a href="<?php echo $action; ?>peraturan_tambah/2">Peraturan Tambah</a></li> <?php } ?>
                    </ul>
                </li>

                <!-- <li class="<?php
                if ($segment == "siswa_dua") {
                    echo "active";  
                }
                ?>  ">
                    <a href="<?php echo $action;?>siswa_dua"><i class="fa fa-th-list"></i> <span>Data Siswa</span></a>
                    
                </li> -->

                <?php  if ($type == 1) {  ?>
                <li class="<?php
                if ($segment == "siswa_dua") {
                    echo "active";  
                }
                ?> ">
                    <a href="<?php echo $action;?>siswa_dua"><i class="fa fa-th-list"></i> <span>Data Siswa</span></a>
                    
                </li> 
                  <?php } ?>

                  <?php  if ($type == 2) {  ?>
                <li class="<?php
                if ($segment == "siswa_dua") {
                    echo "active";  
                }
                ?> ">
                    <a href="<?php echo $action;?>siswa_dua"><i class="fa fa-th-list"></i> <span>Data Siswa</span></a>
                    
                </li> 
                  <?php } ?>

                <?php  if ($type == 3) {  ?>
                <li class="<?php
                if ($segment == "siswa_tiga") {
                    echo "active";  
                }
                ?> ">
                    <a href="<?php echo $action;?>siswa_tiga"><i class="fa fa-th-list"></i> <span>Data Siswa</span></a>
                    
                </li> 
                  <?php } ?>
                
                 <li class="<?php
                if ($segment == "aktivitas") {
                    echo "active";  
                }
                ?>  ">
                    <a href="<?php echo $action;?>aktivitas"><i class="fa fa-th-list"></i> <span>Aktivitas User</span></a>
                    
                </li> 
                  <?php  if ($type == 1) {  ?>
                <li class="<?php
                if ($segment == "startsemester") {
                    echo "active";  
                }
                ?> ">
                    <a href="<?php echo $action;?>startsemester"><i class="fa fa-th-list"></i> <span>Tahun Ajaran</span></a>
                    
                </li> 
                  <?php } ?>
                <li class="">
                       <a href="<?php echo $action;?>grafikPelanggaran"><i class="fa fa-th-list"></i> <span>Grafik Pelanggaran</span></a>
                </li>
            </ul>
        </div>