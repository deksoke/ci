<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>เพิ่มสมาชิกใหม่</title>
    </head>
    <body>
        <div class="container" style="max-width:500px;">
            <?php echo form_open("bogies/add"); ?>

            <div class="form-group">
                <label for="member_name">ชื่อไทย : </label>
                <input type="text" class="form-control" name="name_th" required id="txt_name">
            </div>
            <div class="form-group">
                <label for="name_en">ชื่ออังกฤษ : </label>
                <input type="text" class="form-control" name="name_en" required>
            </div>

            <div class="form-group">
                <label for="short_name_th">ชื่อย่อไทย : </label>
                <input type="text" class="form-control" name="short_name_th">
            </div>
            <div class="form-group">
                <label for="short_name_en">ชื่อย่ออังกฤษ : </label>
                <input type="text" class="form-control" name="short_name_en" >
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="btsave" value="บันทึก"> &nbsp; <?php echo anchor("bogies", "ยกเลิก"); ?>
            </div>

            <?php echo form_close(); ?>
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#txt_name').focus();
        });
    </script>
</html>