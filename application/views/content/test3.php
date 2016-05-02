    <label class="control-label">Select File</label>
    <?php echo form_open_multipart('auctions/start_new_process'); ?>
        <label class="control-label">Select File</label>
    <input name="images[]" id="input-20" type="file" class="file-loading" multiple>
    <script>
    $(document).on('ready', function() {
        $("#input-20").fileinput({
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false
        });
    });
    </script>


    <!-- <input name="images[]" multiple id="input-21" type="file" accept="image/*" class="file-loading"> -->
    <input type="submit"></input>
    <script>
    $(document).on('ready', function() {
      $("#input-images").fileinput({
          browseClass: "btn btn-primary btn-block",
          showCaption: false,
          showRemove: false,
          showUpload: false
      });
  });
    </script>