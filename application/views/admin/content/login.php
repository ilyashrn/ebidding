<!-- BEGIN LOGO -->
        <div class="logo">
            <a href="">
                <img src="../assets/layouts/layout/img/logo4.png" style="height: 50px;" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <?php if ($this->session->flashdata('warn')): ?>
                <div class="alert alert-danger">Username/email or password you inserted is wrong.</div>
            <?php endif ?>
            <!-- BEGIN LOGIN FORM -->
            <?php $attributes = array('class' => "login-form"); echo form_open('admin/main/login_process',$attributes); ?>
                <div class="form-title">
                    <span class="form-title">Selamat datang.</span>
                    <span class="form-subtitle">Silahkan login.</span>
                </div>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input name="login_id" class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username or email" required="" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input name="password" class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" required="" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn red btn-block uppercase">Login</button>
                </div>
            <?php echo form_close(); ?>
            <!-- END LOGIN FORM -->
            <div class="copyright hide"> 2014 © Metronic. Admin Dashboard Template. </div>
        <!-- END LOGIN -->
</script>
</body>
</html>