div class="col-md-4 form-group">
    <label><span class="req">*</span> Upload a professional passport photograph</label>
    <input type="file" id="imgInp" name="passportImage" class="form-control input_user" style=" display: none;">
    <img id="passportImg" src="<?=base_url('uploads/logo/uploadImg.jpg');?>" alt="" style="width: 200px; cursor: pointer;" />
</div>



================================
<script type="text/javascript">
    $('#passportImg').bind("click" , function () {
        $('#imgInp').click();
    });
    
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#passportImg').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
    
    $("#imgInp").change(function() {
        readURL(this);
    });
</script>
