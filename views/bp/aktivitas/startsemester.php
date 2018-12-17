<?php 
//var_dump($valueData); 
 
?>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="fa fa-align-justify"></i>									
                </span>
                <h5>Pengaturan Periode</h5>

            </div>
            <div class="widget-content nopadding">
                <form class="form-horizontal" method="post" action="#" name="basic_validate" id="start-semester-form" novalidate="novalidate">
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label">Tahun</label>
                         <div class="controls">
                            <input type="number" value="<?php echo $valueData['start_year']; ?>" id="start_year" name="start_year" class="col-sm-2" onchange="getFromToDate();"> /
                            <input type="number" value="<?php echo $valueData['next_year']; ?>" id="nextYear" name="next_year" class="cols-sm-1" disabled="disabled">
                        </div>
                    </div>
                     
                      <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label">Semester</label>
                         <div class="controls">
                             <select name="start_semester" id="start_semester" onchange="getFromToDate();">
                                <?php
                               
                                foreach ($list_semester as $key => $value) {
                                    if ($valueData['start_semester'] == $key) {
                                        echo "<option value='" . $key . "' selected> " .$value. "</option>";
                                    } else {
                                        echo "<option value='" . $key. "'> " . $value . "</option>";  
                                    }
                                    ?>
<?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">Dari</label>
                            <div class = "col-sm-9 col-md-9 col-lg-3">
                                <div class = "row">
                                    <div class = "col-md-6">
                                        <div class = "input-group input-group-sm date datepicker" data-date = sysdate data-date-format = "yyyy-mm-dd">
                                            <span class = "input-group-addon"><i class = "fa fa-calendar"></i></span>
                                            <input id="from_date" type = "text" name = "from_date" value = "<?php echo $valueData['from_date']; ?>" class = "form-control" <?php echo $disabled;?> />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class = "form-group">
                            <label class = "col-sm-3 col-md-3 col-lg-2 control-label">Sampai</label>
                            <div class = " col-sm-9 col-md-9 col-lg-3">
                                <div class = "row">
                                    <div class = "col-md-6">
                                        <div class = "input-group input-group-sm date datepicker" data-date = sysdate data-date-format = "yyyy-mm-dd">
                                            <span class = "input-group-addon"><i class = "fa fa-calendar"></i></span>
                                            <input id="to_date" type = "text" name = "to_date" value = "<?php echo $valueData['to_date']; ?>" class = "form-control" <?php echo $disabled;?>/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    <div class="form-actions">
                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
            </div>
            </div>
            </div>
            </div>
            
            <script type="text/javascript">
    var getFromToDate = function() {
        $('.submit').attr('disabled', 'disabled');
        var nextYear = parseInt($("#start_year").val())+1;
        $("#nextYear").val(nextYear);
        $.ajax({
            
            url: '<?php echo site_url('c_home/getFromToDate'); ?>',
            data: $("#start-semester-form").serialize(),
            type: 'post',
            dataType: 'json',
            success: function(result) {
                $("#from_date").val(result.from_date);
                $("#to_date").val(result.to_date);
                $('.submit').removeAttr('disabled');
            }
        });
    };

</script>