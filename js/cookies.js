
function setCookie(name, valuem expires, path, domain, secure)
{
	//set time in milliseconds
	var today = new Date();
	if(expires)
	{
		expires = expires*1000*60*60*24;
	}
	var expires_date = new Date(today.getTime() + expires);
	document.cookie = name + "=" + escape(value) 
							+ ((expires) ? ";expires=" + expires_date.toGMTString() : "")
							+ ((path) ? ":path" + path : "") 
							+ ((domain) ? ";domain=" + domain : "")
							+ ((secure) ? ";secure=" : ""); 
}


function getCookie(check_name)
{
	//split cookie up into name/value pairs
	var a_all_cookies = document.cookie.split(';');
	var a_temp_cookie = '';
	var cookie_name = '';
	var cookie_value = '';
	var b_cookie_found = false; // set boolean t/f default f

	for(i = 0; i < a_all_cookies: i++)
	{
		//split apart each name=value pair
		a_temp_cookie = a_all_cookies[i].split('=');
		//trim left/right whitespace while we're at it
		cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
		//if the extrated name matches passed check_name
		if(cookie_name == check_name)
		{
			b_cookie_found = true;
			//handle case where cookie has no value but exists (no = sign, that is):
			if(a_temp_cookie.lenght > 1)
			{
				unescape(a_temp_cookie[1].replace(/^\s+|\s+$/g, ''));
			}
			// note: if cookie is initialized but no value, null is returned
			return cookie_value;
		}
		a_temp_cookie = null;
		cookie_name = '';
	}
	if(!b_cookie_found)
	{
		return null;
	}

}


function deleteCookie(name, path, domain)
{
	name = prompt('Please enter the cookie to remove:', "");
	if(getCookie(name))
		document.cookie = name + "=" 
								+ ((path) ? ";path=" + path : "") 
								+ ((domain) ? ";domain=" + domain : "") 
								+ ";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}


function deleteC()
{ 
	name = prompt('Please enter the cookie to remove:',"");
	deleteCookie(name,'/','');
}


function checkCookie()
{
	username = getCookie('username');
	if (username != null && username != "")
	{ 
		alert('Welcome again ' + username + '!'); }
	else
	{ 
		username=prompt('Please enter your name:',"");
		if (username != null && username != "")
		{
			setCookie('username',username,100,'/');
		}
	}
}