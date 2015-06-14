//THESE FUNCTIONS USE THE COOKIE-PLUGIN. PATH: /plugin/jquery.cookie.js

function saveCookies() {
	//saves all important values in cookies
	//expires in 1500 days
	$.cookie('stream_main_ip', $('#txt-stream-main-ip').val(), { expires: 1500 });
	$.cookie('stream_main_port', $('#txt-stream-main-port').val(), { expires: 1500 });
}

function getCookieObj() {
	//returns the object with the saved values of the cookies
	return $.cookie();
}

function isCookieObjValid(cookieObj) {
	//checks if the attributes of the cookie object are set
	return (cookieObj.stream_main_ip != null) && (cookieObj.stream_main_ip != 'undefined')
		&& (cookieObj.stream_main_port != null) && (cookieObj.stream_main_port != 'undefined');
}