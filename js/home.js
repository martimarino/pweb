
function fade(a) {                          //comparsa/scomparsa login
	var e = document.getElementById(a);
    e.className == "fadeout" ? e.className = "fadein" : e.className = "fadeout";
}

function Nav(a) {                //menu a comparsa laterale
	var e = document.getElementById(a);
	e.style.width == "250px" ? e.style.width = "0" : e.style.width = "250px";
}

function favourites() {
	document.location.href="catalog.html";     //porta da icona cuore alla pagina
}

/*
function favourites() {                             //click su icona cuore
    if((document.location.href)=="home.html")
    {
       document.location.href="catalog.html";    
       Nav('leftSidenav');
    }
    else
    {
        Nav('leftSidenav');
    }
}
*/
/*
function favourites() {
    <?php session_start(); ?>

    if ( <?php isset( $_SESSION['user_id'] ) ?> ) 
    {
        document.location.href="catalog.html";     //porta da icona cuore alla pagina
        Nav('leftSidenav');
    } 
    else 
    {
        fade('element');
    }
}*/

function showSlides() {
    var i;      //contatore
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.opacity = 0;  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}   

    slides[slideIndex-1].style.opacity = 1;  
    setTimeout(showSlides, 4000); // Change image every 2 seconds
}

/* -------------------------------------------------------------------------*/

function showPopUp(invalidInput) {
    var popup = document.getElementById("myPopup");

    document.getElementById("myPopup").firstChild.nodeValue=invalidInput;

    popup.classList.toggle("show");
    return;
}


function validate() {
    var name = document.formToValidate.firstname.value;
    var surname = document.formToValidate.lastname.value;
    var email = document.formToValidate.email.value;
    var password = document.formToValidate.password.value;
    var confirm = document.formToValidate.confirm.value;

    var existNUMERICAL = /\d/;
    var email_reg_exp = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;

    if((existNUMERICAL.test(name)) || (name == "") || (name == "undefined")){
        showPopUp("Insert a correct name.");
        document.formToValidate.firstname.focus();
        return false;
    }

    if((existNUMERICAL.test(surname)) || (surname == "") || (surname == "undefined")){
        showPopUp("Insert a correct surname.");
        document.formToValidate.lastname.focus();
        return false;
    }

    if (!email_reg_exp.test(email) || (email == "") || (email == "undefined")) {
        showPopUp("Insert a correct email.");
        document.formToValidate.email.focus();
        return false;
    }

    if (password != confirm) {
        showPopUp("The password confirmed is different from the chosen one, check.");
        document.formToValidate.confirm.value = '';
        document.formToValidate.confirm.focus();
        return false;
    }
    return true;
}

function submit() {

}