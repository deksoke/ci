<div class="col-md-offset-3 col-md-6">
    <?php echo form_open('auth/signin', array('class' => 'form form-horizontal')); ?>
    <div class="form-group">
        <label class="col-md-3 control-label" for="email">Email</label>
        <div class="col-md-9">
            <input type="email" class="form-control" name="email" required/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="password">Password</label>
        <div class="col-md-9">
            <input type="password" class="form-control" name="password" required/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
            <input type="reset" class="btn" value="clear"/>
            <input type="submit" class="btn btn-primary" name="btSubmit" value="Ok">
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
