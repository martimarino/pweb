function begin(){
	var randomnumber = Math.floor(Math.random()*NUM_BACKGROUND_WALLPAPER); // It generates a number between 0 and NUM_BACKGROUND_WALLPAPER-1
	document.body.style.backgroundImage = "url('./img/index/index_background_" + randomnumber + ".jpg')";

	fadeIn(document.body, 1);
	slideUp(document.getElementById('sign_in_content'), 30, 20);
	
	window.onscroll = scrollingAction;
}