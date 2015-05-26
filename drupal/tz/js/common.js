function isPhone(phoneNo){
	var re = /^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i;
	return re.test(phoneNo);
}
