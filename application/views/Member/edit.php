<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>แก้ไขข้อมูลสมาชิก</title>
    </head>
    <body>
        <div class="container" style="max-width:300px;">
            <?php echo form_open("member/edit/".$this->uri->segment(3)); ?>

            <div class="form-group">
                <label for="member_name">ชื่อ : </label>
                <input type="text" class="form-control" name="member_name" value="<?php echo $member->member_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="member_tel">เบอร์โทรศัพท์ : </label>
                <input type="text" class="form-control" name="member_tel" value="<?php echo $member->member_tel; ?>">
            </div>
            <div class="form-group">
                <label for="member_addr">ที่อยู่ : </label>
                <input type="text" class="form-control" name="member_addr" value="<?php echo $member->member_addr; ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="btsave" value="บันทึก"> &nbsp; <?php echo anchor("member", "ยกเลิก"); ?>
            </div>

            <?php echo form_close(); ?>
        </div>
    </body>
</html>