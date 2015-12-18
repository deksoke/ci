<div class="col-md-offset-3 col-md-6">
    <?php echo form_open(isset($member) ? 'auth/profile' : 'auth/signup', array('class' => 'form form-horizontal')); ?>

    <div class="form-group">
        <label class="col-md-3 control-label" for="email">Email</label>
        <div class="col-md-9">
            <input type="email" class="form-control <?php echo isset($member) ? 'disabled' : ''; ?>" name="email" required value="<?php echo isset($member) ? $member->email : ''; ?>"/>
        </div>
    </div>
    <div class="form-group <?php echo isset($member) ? 'hide' : ''; ?>">
        <label class="col-md-3 control-label" for="password">Password</label>
        <div class="col-md-9">
            <input type="password" class="form-control" name="password" required value="<?php echo isset($member) ? $this->aauth->hash_password($member->pass, $member->id) : ''; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="username">Your Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="username" required value="<?php echo isset($member) ? $member->name : ''; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
            <input type="reset" class="btn" value="clear"/>
            <input type="submit" class="btn btn-primary" name="btSubmit" value="Submit">
        </div>
    </div>
    <?php

        if(isset($err))
        {
            echo "<pre>".$err."</pre>";
        }

    ?>

    <?php echo form_close(); ?>
</div>
