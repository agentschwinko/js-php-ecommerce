window.onload = function(){

	/*
	====================================
	login js
	====================================
	*/
	var submitLogin = document.getElementById('submit-login');
	var loginUname = document.getElementById('login-uname');
	var loginPword = document.getElementById('login-pword');
	var errorWrapper = document.getElementById('error-wrapper');
	submitLogin !== null?submitLogin.addEventListener('click', validateLogin, false):'';
	function validateLogin(event){
		var error = '';
		event.preventDefault();
		if(loginUname.value == undefined){
			error += '<p>*Please set the value for username';
		}
		else if(!validateName(loginUname.value)){
			error += '<p>*Invalid name given';
		}

		if(loginPword.value == undefined){
			error += '<p>*Please set the value for password field';
		}
		else if(!validatePassword(loginPword.value)){
			error += '<p>*Passord should not be less than 5 characters';
		}

		if(error !== ''){
			errorWrapper.innerHTML = error;
		}
		else if(loginUname.value.toLowerCase() !== 'John Smith'.toLowerCase() || loginPword.value !== '12345'){
			errorWrapper.innerHTML = "<p>Invalid login!!";
		}
		else{
			window.location = 'shop.html';
		}
	}


	/*
	====================================
	shopping cart js
	====================================
	*///shop cart js
	var cart = {
		p1:{
			q:0,
			p:document.getElementById('price1')?document.getElementById('price1').innerHTML:0
		},
		p2:{
			q:0,
			p:document.getElementById('price2')?document.getElementById('price2').innerHTML:0
		},
		delivery:0,
		gift:false,
		insure:false,
		reward:false
	}
	var clearCartButton = document.getElementById('reset-cart');
	var submitCartButton = document.getElementById('submit-cart');
	var deliveryType = document.getElementById('delivery-type');
	var wrapGift = document.getElementById('wrap-gift');
	var insure = document.getElementById('insure');
	var reward = document.getElementById('reward');
	var checkoutBox = document.getElementById('checkout-box');

	if(clearCartButton){
	clearCartButton.onclick = function(){
		wrapGift.checked = false;
		insure.checked = false;
		reward.checked = false;
		deliveryType.selectedIndex = 0;
		cart.p1.q = 0;
		cart.p2.q = 0;
		cart.delivery = 0;
		cart.gift = false;
		cart.insure = false;
		cart.reward = false;
	};
	}


	var addProductButtons = document.querySelectorAll('.add-product');
	for(var i = 0; i < addProductButtons.length; i++){
		addProductButtons[i].addEventListener('click', addProduct);
	}
	function addProduct(){
		var pid = this.getAttribute('data');
		var q = 0;
		if(parseInt(pid) == 1){
			var q = document.getElementById('q1').value;
			if(q !== undefined && verifyQuantity(q)){
				cart.p1.q = q;
				showSuccessToast('Your cart has been updated');
			}
			else{
				showToast('Invalid quantity given. Give a value between 1 and 20');
				cart.p1.q = 0;
			}

		}
		else if(parseInt(pid) == 2){
			var q = document.getElementById('q2').value;
			if(q !== undefined && verifyQuantity(q)){
				cart.p2.q = q;
				showSuccessToast('Your cart has been updated');
			}
			else{
				showToast('Invalid quantity given.  Give a value between 1 and 20');
				cart.p2.q = 0;
			}

		}
	};

	document.getElementById('submit-cart')?document.getElementById('submit-cart').addEventListener('click', function(){
		var delTypeVal = deliveryType[deliveryType.options.selectedIndex].value;
		var delivery = 0;
		if(cart.p2.q < 1 && cart.p1.q < 1){
			showToast('Your cart is empty');
		}
		else if(parseFloat(delTypeVal) == 0){
			showToast('Select delivery type');
		}
		else{
			cart.delivery = parseFloat(delTypeVal);
			cart.gift = (wrapGift.checked)?true:false;
			cart.insure = (insure.checked)?true:false;
			cart.reward = (reward.checked)?true:false;
			showSuccessToast('Cart information submitted');
		}
	}, false):'';

	document.getElementById('calculate-cart')?document.getElementById('calculate-cart').addEventListener('click', function(){
		var total = 0;
		var delTypeVal = deliveryType[deliveryType.options.selectedIndex].value;
		var delivery = 0;
		if(cart.p2.q < 1 && cart.p1.q < 1){
			showToast('Your cart is empty');
		}
		else if(parseFloat(delTypeVal) == 0){
			showToast('Please click on submit button');
		}
		else{
			var checkoutContent = '<div class="row" style="border-bottom:2px solid #aaa;"><span>Product</span><span>Qty</span><span>Cost</span></div>';
			if(cart.p1.q > 0){
				var dollars = parseFloat(cart.p1.p) * parseInt(cart.p1.q);
				total += dollars;
				checkoutContent += '<div class="row"><span>Product One</span><span>'+cart.p1.q+'</span><span>$'+dollars.toFixed(2)+'</span></div>';
			}
			if(cart.p2.q > 0){
				var dollars = parseFloat(cart.p2.p) * parseInt(cart.p2.q);
				total += dollars;
				checkoutContent += '<div class="row"><span>Product One</span><span>'+cart.p2.q+'</span><span>$'+dollars.toFixed(2)+'</span></div>';
			}
			if(cart.insure){
				var dollars = (10/100)*total;
				total += dollars;
				checkoutContent += '<div class="row"><span>Insurance</span><span></span><span>$'+dollars+'</span></div>';
			}
			if(cart.gift){
				var dollars = 9.99;
				total += dollars;
				checkoutContent += '<div class="row"><span>Gift Wrapping</span><span></span><span>$'+dollars.toFixed(2)+'</span></div>';
			}
			var tax = (13/100)*total;
			total += tax;
			checkoutContent += '<div class="row"><span>Reward</span><span></span><span>'+cart.reward+'</span></div>';
			checkoutContent += '<div class="row"><span>Tax</span><span></span><span>$'+tax.toFixed(2)+'</span></div>';
			checkoutContent += '<div class="row"><span>Total</span><span></span><span>$'+total.toFixed(2)+'</span></div>';
			document.getElementById('checkout-content').innerHTML = checkoutContent;
			checkoutBox.style.display = 'block';
		}
	}, false):'';



	/*
	====================================
	feedback js
	====================================
	*/
	var fName = document.getElementById('f-name');
	var fPhone = document.getElementById('f-phone');
	var fFeedback = document.getElementById('f-feedback');
	var submitFeedback = document.getElementById('submit-feedback');
	submitFeedback?submitFeedback.addEventListener('click', processFeedback, false):'';
	function processFeedback(event){
		var error = '';
		event.preventDefault();
		if(fName.value == undefined){
			error += '<p>*Please set the value for username';
		}
		else if(!validateName(fName.value)){
			error += '<p>*Invalid name given';
		}
		if(fPhone.value == undefined){
			error += '<p>*Please set the value for phone';
		}
		else if(!validatePhone(fPhone.value)){
			error += '<p>*Invalid phone given';
		}
		if(fFeedback.value == undefined){
			error += '<p>*Please set your feedback';
		}
		else if(!validateFeedback(fFeedback.value)){
			error += '<p>*Feed back accepts alphanumeric and periods only, not more than 1000 characters';
		}
		if(error !== ''){
			errorWrapper.innerHTML = error;
			errorWrapper.style.color = '#990000';
		}
		else{
			errorWrapper.innerHTML = 'Thanks for your feedback. Do you want to continue shopping? Click <a href="login.html">here</a>'
			errorWrapper.style.color = '#009900';
		}
	}





	/*
	====================================
	***utility function*****
	====================================
	*/
	function validateName(name){
		if(!/^\s+$/.test(name) && /^[a-zA-Z0-9_ ]{1,100}$/.test(name) ){
			return true;
		}
		else{
			return false;
		}
	}
	function validateFeedback(feedback){
		if(!/^\s+$/.test(feedback) && /^[a-zA-Z0-9_\-\.,\?\s]{1,1000}$/.test(feedback) ){
			return true;
		}
		else{
			return false;
		}
	}
	function validatePassword(pword){
		if(/^.{5,100}$/.test(pword)){
			return true;
		}
		else{
			return false;
		}
	}
	function verifyQuantity(q){
		if(/^[0-9]{1,2}$/.test(q) && q > 0 && q < 21){
			return true;
		}
		else{
			return false;
		}
	}
	function verifyNumber(number){
		if(/^\d{1,18}$/.test(number) ){
			return true;
		}
		else{
			return false;
		}
	}
	function validatePhone(number){
		if(!/^\s+$/.test(name) && /^[\d\+\s\-]{6,18}$/.test(number) ){
			return true;
		}
		else{
			return false;
		}
	}
	function showToast(tex){
		var toast = document.getElementById('toast');
		toast.innerHTML = tex;
		toast.style.display = 'block';
		setTimeout(function(){
			toast.style.display = 'none';
		},3000);
	}
	function showSuccessToast(tex){
		var toast = document.getElementById('toast-success');
		toast.innerHTML = tex;
		toast.style.display = 'block';
		setTimeout(function(){
			toast.style.display = 'none';
		},3000);
	}
};
