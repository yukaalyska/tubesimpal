 
<!-- <div id="content"> -->
<!-- <div id="content-header">
        <h1>Input Prestasi</h1>
</div>  -->
<?php
//var_dump($valueData); die();
?>
<div id="breadcrumb">
    <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
    <a href="#">Peraturan</a>
    <a href="#" class="current">Upload Peraturan</a>
</div>
<div class="container-fluid">
    <!--Data Siswa-->
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="fa fa-align-justify"></i>									
                    </span>
                    <h5>Data File</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">



                         <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">Nama Berkas</label>
                            <div class = "col-sm-9 col-md-9 col-lg-2">
                                <input type = "text" value = "<?php echo $valueData['judul']; ?>" name = "judul" class = "form-control input-sm" />
                            </div>
                        </div>


                       
                        <!--NormalTextInput-->

                        <!--DatePicker-->
                        <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">Tanggal Upload</label>
                            <div class = " col-sm-9 col-md-9 col-lg-3">
                                <div class = "row">
                                    <div class = "col-md-6">
                                        <div class = "input-group input-group-sm date datepicker" data-date = sysdate data-date-format = "yyyy-mm-dd">
                                            <span class = "input-group-addon"><i class = "fa fa-calendar"></i></span>
                                            <input type = "text" name = "tgl_upload" value = "<?php echo $valueData['tgl_upload']; ?>" class = "form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">File upload</label>
                            <div class = "col-sm-9 col-md-9 col-lg-10">
                                <input type = "file" name = "berkas" />
                            </div>
                        </div>
                         <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">Keterangan</label>
                            <div class = "col-sm-9 col-md-9 col-lg-2">
                                
                                
                                <textarea class="form-control"  style="width: 443px; height: 124px;" name = "keterangan" rows="5"><?php echo $valueData['keterangan']; ?></textarea>
                            </div>
                        </div>
                        <!--ActionButton-->
                        <div class = "form-actions">
                            <button type = "submit" class = "btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
