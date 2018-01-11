window.addEventListener('DOMContentLoaded', function(events)
{
	let body = document.getElementsByTagName("body")[0];

	let loginBox = document.getElementById("login-register");
	// show login and register box
	let account = document.getElementById("account");
	account.addEventListener("click", function(event)
	{
		var display = loginBox.style.display;
		loginBox.style.display = 'block';
	});
	// close login and register box
	let closeLogin = document.getElementById('close-login-box');
	closeLogin.addEventListener("click", function(event)
	{
		loginBox.style.display = 'none';
	});
	// toggle mobile menu
	let btnMenu = document.getElementById("btn-menu");
	let mobileMenu = document.getElementById("mobile-menu");
	btnMenu.addEventListener("click", function(event)
	{
		let isShow = mobileMenu.style.display;
		if (isShow == "none") {
			mobileMenu.style.display = "block";
		} else{
			mobileMenu.style.display = "none";
		};
		
	});
	let quantity = document.getElementsByClassName("quantity-btn");
	let btnSub = [];
	let btnPlus = [];
	let inputNum = [];
	for(let i =0; i < quantity.length; i++){
		btnSub[i] = quantity[i].querySelector('.btn-sub');
		btnPlus[i] = quantity[i].querySelector('.btn-plus');
		inputNum[i] = quantity[i].querySelector('.input-num');
		btnSub[i].addEventListener('click', function(events)
		{
			
			let valueInput = parseInt(inputNum[i].value);
			valueInput = valueInput - 1;
			if(valueInput < 0){
				valueInput = 0;
			}
			inputNum[i].value = valueInput;
		});
		btnPlus[i].addEventListener('click', function(events)
		{

			let valueInput = parseInt(inputNum[i].value);
			valueInput = valueInput + 1;

			inputNum[i].value = valueInput;
		});
		
	}

	
	
});