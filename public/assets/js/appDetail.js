window.addEventListener("DOMContentLoaded", function (events) 
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
	let quantity = document.getElementById('quantity');
	let btnSub = quantity.querySelector(".btn-sub");
	let btnPlus = quantity.querySelector(".btn-plus");
	let intNum = quantity.querySelector(".input-num");
	
	btnSub.addEventListener('click', function(events){
		let valueNum = parseInt(intNum.value);
		valueNum = valueNum - 1;
		if(valueNum < 0){
			valueNum =0;
		}
		intNum.value = valueNum;
		
	});
	btnPlus.addEventListener('click', function(events){
		let valueNum = parseInt(intNum.value) ;
		valueNum = valueNum + 1;
		intNum.value = valueNum; 
	});
	// click images
	let imagesProduct = document.getElementById("images-product");
	let mainImage = imagesProduct.querySelector(".main-image");
	let img = mainImage.querySelector('.img-product');
	let ulImages = imagesProduct.querySelector("#list-images");
	let listImg = ulImages.querySelectorAll(".small-image");
	let listSrcImg = [];
	for (var i = 0; i < listImg.length; i++) {
		listSrcImg[i] = listImg[i].src;
		
	}
	
	listImg[0].addEventListener("click", function()
	{
		img.src = listImg[0].src;
	});
	listImg[1].addEventListener("click", function()
	{
		img.src = listImg[1].src;
	});
	listImg[2].addEventListener("click", function()
	{
		img.src = listImg[2].src;
	});

	// slide hot products
	let listImagesHot = document.getElementById("list-hot-products");
	let prev = document.getElementById("btn-prev");
	let next = document.getElementById("btn-next");
	let indImageHot = -1;

	function handleIndexHot (n)
	{
		indImageHot = indImageHot + n;
		if (indImageHot < 0) {
			indImageHot = 5;
		} else{
			if (indImageHot > 5){
				indImageHot = 0;
			}
		};
	}
	function plusImageHot(n)
	{
		handleIndexHot(n);
		listImagesHot.style.transition = 'transform 0.1s ease';
		listImagesHot.style.transform = 'translateX(' + indImageHot * -270 + 'px)';
		

	}

	function slideHotProducts(n)
	{
		handleIndexHot(n);

		listImagesHot.style.transition = 'transform 1s ease';
		listImagesHot.style.transform = 'translateX(' + indImageHot * -270 + 'px)';
	}
	
	function controlSlideHot()
	{
		slideHotProducts(1);
		setTimeout(controlSlideHot, 3000);

	}
	controlSlideHot();
	prev.addEventListener("click", function()
	{
		plusImageHot(-1);
	});
	next.addEventListener("click", function()
	{
		plusImageHot(1);
	});
	// pick color 
	let listColors = document.getElementById("list-color");
	let listRadio = listColors.querySelectorAll(".radio-color");
	console.log(listRadio);
	listRadio[0].addEventListener("click",function(event)
	{
		if(this.checked === true){
			console.log(0);
		}
	});
	listRadio[1].addEventListener("click",function(event)
	{
		if(this.checked === true){
			console.log(1);
		}
	});
	listRadio[2].addEventListener("click",function(event)
	{
		if(this.checked === true){
			console.log(2);
		}
	});

});


















