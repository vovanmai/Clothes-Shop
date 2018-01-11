<section id="login-register">
<div class="box-title-login">
	<span>Log in & Register</span>
	<button class="close" id="close-login-box">X</button>
</div>
<div class="box-content">
	<div class="cover-content">
		<div class="login">
			<div class="box-title">Log in</div>
			<div id="login_msg" style="margin-top:20px;margin-left:50px">
				
			</div>
			<form action="javascript:void(0)" method="post" accept-charset="utf-8">
				<input type="text" id="login-username" name="user-name" placeholder="User Name">
				<div id="login-username-warning">
					
				</div>
				<input type="password" id="login-password" name="password" placeholder="Password">
				<div id="login-password-warning">
					
				</div>

				<button type="submit" class="btn-login" id="login-submit">Log in</button>
			</form>
		</div>
		<div class="register">
			<form action="javascript:void(0)" method="post" accept-charset="utf-8">
				<div class="box-title">Register</div>
				<div id="success_register_msg" style="margin-top:20px;">
				    
				</div>

				<input type="text" name="user-name" id="register_username" placeholder="User Name">
				<div id="register-username-warning">
				</div>

				<input type="text"  name="user-name" id="register_fullname" placeholder="Full Name">
				<div id="register-fullname-warning">
				</div>

				<input type="text" name="email" id="register_email" placeholder="Email">
				<div id="register-email-warning">
				</div>


				<input type="password" name="password" id="register_password" placeholder="Password">
				<div id="register-password-warning">
				</div>
				<div class="gender">
					<span>Genders</span>
					<input id="male" type="radio" checked value="1" name="gender">
					<label for="male">Male</label>	
					<input id="female" type="radio" value="0" name="gender">
					<label for="female">Female</label>
				</div>
				<button type="submit"  disabled class="btn-register" style="background: #7db784;" id="register_submit">Register</button>
			</form>
		</div>
	</div>

</div>
</section>