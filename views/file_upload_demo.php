<form enctype="multipart/form-data" class="jNice" accept-charset="utf-8" method="post" action="c_homedua/multiple_upload">              
    <fieldset>      
            <label>Title * : </label>                       
            <input type="text" class="text-long" value="" name="title">

            <label>Description : </label>                       
            <textarea class="mceEditor" rows="10" cols="40" name="description"></textarea>

            <label>Image : </label>                     
            <?php echo form_upload('file1'); ?>
            <?php echo form_upload('file2'); ?>                           

            <button class="button-submit" type="submit" name="save" id="">Save</button>
    </fieldset>         
</form>

