<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>แก้ไขข้อมูลสมาชิก</title>
    </head>
    <body>
        <div class="container" style="max-width:500px;">
            <?php echo form_open("bogie/edit/".$this->uri->segment(3)); ?>

            <div class="form-group">
                <label for="member_name">ชื่อไทย : </label>
                <input id="txt_name" type="text" class="form-control" name="name_th" value="<?php echo $bogie->BOGIE_NAME_TH; ?>" required>
            </div>
            <div class="form-group">
                <label for="name_en">ชื่ออังกฤษ : </label>
                <input type="text" class="form-control" name="name_en" value="<?php echo $bogie->BOGIE_NAME_EN; ?>" required>
            </div>

            <div class="form-group">
                <label for="short_name_th">ชื่อย่อไทย : </label>
                <input type="text" class="form-control" name="short_name_th" value="<?php echo $bogie->BOGIE_SHORT_NAME_TH; ?>">
            </div>
            <div class="form-group">
                <label for="short_name_en">ชื่อย่ออังกฤษ : </label>
                <input type="text" class="form-control" name="short_name_en" value="<?php echo $bogie->BOGIE_SHORT_NAME_EN; ?>" >
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="btsave" value="บันทึก"> &nbsp; <?php echo anchor("bogie", "ยกเลิก"); ?>
            </div>

            <?php echo form_close(); ?>
        </div>
    </body>
</html>