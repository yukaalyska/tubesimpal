  <?php $readonly = ($typeForm=='ubah') ?  "readonly=''" : "";
  
  ?>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="fa fa-align-justify"></i>									
                </span>
                <h5>Form Siswa</h5>

            </div>
            <div class="widget-content nopadding">
                <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label">NIS</label>
                        <div class="col-sm-9 col-md-9 col-lg-10">
                            <input type="text" class="form-control input-sm" name="nis" id="required" value="<?php echo $valueData['nis']; ?>" <?php echo $readonly; ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label">Nama</label>
                        <div class="col-sm-9 col-md-9 col-lg-10">
                            <input type="text" class="form-control input-sm" name="namasiswa" id="required" value="<?php echo $valueData['namasiswa']; ?>">
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label">Kelas</label>
                        <div class="col-sm-9 col-md-9 col-lg-10">
                            <input type="text" class="form-control input-sm" name="kelas" id="required" value="<?php echo $valueData['kelas']; ?>">
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label">Kelas</label>
                        <div class="col-sm-9 col-md-9 col-lg-10">
                           <select name="jurusan">
                                <?php
                                foreach ($list_jurusan as $key => $value) {
                                    if ($valueData['jurusan'] == $key) {
                                        echo "<option value='" . $key . "' selected> " .$value. "</option>";
                                    } else {
                                        echo "<option value='" . $key. "'> " . $value . "</option>";  
                                    }
                                    ?>
<?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label">Username</label>
                        <div class="col-sm-9 col-md-9 col-lg-10">
                            <input type="text" class="form-control input-sm" name="username" id="required" value="<?php echo $valueData['username']; ?>" <?php //echo $readonly; ?>>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label">Password</label>
                        <div class="col-sm-9 col-md-9 col-lg-10">
                            <input type="text" class="form-control input-sm" name="password" id="required" value="<?php echo $valueData['password']; ?>">
                        </div>
                    </div>
 <?php  if ($type == 1) {  ?>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label">User Status</label>
                    <?php  ?>
                        <div class="col-sm-9 col-md-9 col-lg-10">
                            <select name="user_active">
                                <?php
                                foreach ($user_status as $key => $value) {
                                    if ($valueData['user_active'] == $key) {
                                        echo "<option value='" . $key . "' selected> " .$value. "</option>";
                                    } else {
                                        echo "<option value='" . $key. "'> " . $value . "</option>";  
                                    }
                                    ?>
<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label">User desc</label>
                        <div class="col-sm-9 col-md-9 col-lg-10">
                            <input type="text" class="form-control input-sm" name="user_desc" id="required" value="<?php echo $valueData['user_desc']; ?>" <?php //echo $readonly; ?>>
                        </div>
                    </div>
 <?php } ?>
                    <div class="form-actions">
                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>			
    </div>
</div>

