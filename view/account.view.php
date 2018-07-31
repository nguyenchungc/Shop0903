<!-- Main Container -->
<section class="main-container col1-layout">
    <div class="main container">
      
        
        <div class="page-content">
          
            <div class="account-login">
              
   
          
              <div class="box-authentication" method="POST" action="register.php">
                <h4>Đăng nhập</h4>
               <p class="before-login-text">Xin chào, hãy đăng nhập theo tài khoản của bạn</p>
                <label for="emmail_login">Địa chỉ email<span class="required">*</span></label>
                <input id="emmail_login" type="text" class="form-control">
                <label for="password_login">Mật khẩu<span class="required">*</span></label>
                <input id="password_login" type="password" class="form-control">
                <p class="forgot-pass"><a href="#">Quên mật khẩu?</a></p>
                <button class="button"><i class="fa fa-lock"></i>&nbsp; <span>Đăng nhập</span></button><label class="inline" for="rememberme">
													<input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember me
												</label>
              </div>
              <div class="box-authentication">
                <h4>Đăng ký tài khoản</h4><p>Khởi tạo tài khoản của bạn</p> 											
                <label for="emmail_register">Địa chỉ email <span class="required">*</span></label>
                <input id="emmail_register" type="text" class="form-control" name="email">
                <label for="password_register">Mật khẩu<span class="required">*</span></label>
                <input id="password_register" type="password" class="form-control" name="password_1">
                <label for="password_register">nhập lại mật khẩu<span class="required">*</span></label>
                <input id="password_register" type="password" class="form-control" name="password_2">
                <button class="button"><i class="fa fa-user" name ="register"></i>&nbsp; <span>Đăng ký</span></button>
                <button class="button"><i class="fa fa-lock"></i>&nbsp; <span>Đăng nhập</span></button>
              </div>
      </div>

    </div>
  </section>
  <!-- Main Container End --> 