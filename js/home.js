
/* ------------------------------------------------------------------------ */

function fade(a) {                          //comparsa/scomparsa login
	var e = document.getElementById(a);
    e.className == "fadeout" ? e.className = "fadein" : e.className = "fadeout";
}

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

/* ------------------------------------------------------------------------- */

function IndexEffects(){ 
    fadeIn(document.getElementById('index_message'), 1);
    slideUp(document.getElementById('index_message'), 35, 16);
}

function AdminEffects(){
    fadeIn(document.getElementById('admin_message'), 1);
    slideUp(document.getElementById('admin_message'), 35, 16);
}

function fadeIn(element, finalOpacity){
    var op = 0.1;  // initial opacity
    if (op >= finalOpacity)
        return;
    
    var timer = setInterval(function () {
        if (op >= finalOpacity){
            clearInterval(timer);
            op = finalOpacity;
        }
        
        element.style.opacity = op;
        op += op * 0.1;
    }, 20);
    
}

function slideUp(element, startPosition, endPosition){
    if (endPosition > startPosition)
        return;

    var timer = setInterval(function () {
        if (startPosition <= endPosition){
            clearInterval(timer);
            startPosition = endPosition;
        }
        
        element.style.top = startPosition + '%';
        startPosition -= startPosition * 0.01;
        element.style.display = 'block';
    }, 10);
}

/* ------------------------------------------------------------------------- */

function getSelectedValue(tag){
    var element = document.getElementById(tag);
    var selectedValue = element.options[element.selectedIndex].value; 
    return selectedValue;
}

function deleteFromCatalog(){
    var garmentId = getSelectedValue("garmentToDelete");
    AdminLoader.deleteGarment(garmentId);
}

function insertSale(){
    var salePercentage = document.getElementById("new_sale_value").value;  
    var collection = getSelectedValue("collectionToDiscount");  
    AdminLoader.insertNewSale(salePercentage, collection);
}

function modifyOrder(){
    var orderId = getSelectedValue("ordersID");
    var field = getSelectedValue("order_select");
    var value = document.getElementById("order_new_value").value;
    AdminLoader.modifyOrderField(orderId, field, value);
}

function stock(){
    var garmentId = getSelectedValue("stockGarmentID");
    var size = getSelectedValue("sizes");
    var quantity = document.getElementById("quantity").value;
    AdminLoader.modifyQuantity(garmentId, size, quantity);
}

function enableCartButton(){
    document.getElementById("add_to_cart").disabled = false;
    document.getElementById("add_to_cart").style.cursor = "pointer";
    if(document.getElementById("no_more_available"))
        document.getElementById("no_more_available").remove();
}

function validateEmail(mail) 
{
    if (!(mail.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) || (mail.value == '')){
        document.getElementById('form_error').textContent = "invalid mail";
        document.getElementById('form_error').style.visibility='visible';
    }
}

function validateAllLetter(text)
{
    var letters = /^[A-Za-z]+$/;
    var input = document.getElementById(text);
    if (!(input.value.match(letters)) || (input.value == '')){
        document.getElementById('form_error').textContent = text + " input should be alphabetical";
        document.getElementById('form_error').style.visibility='visible';
    }
}

function validateAllnumeric(input)
{
    var numbers = /^[0-9]+$/;
    var toValidate = document.getElementById(input);
    if(!(toValidate.value.match(numbers)) || (toValidate.value == '')){
        document.getElementById('form_error').textContent = input + " input should be numeric";
        document.getElementById('form_error').style.visibility='visible';
    }
}

function validateAddress(street)
   {
    var valid = /\w+(\s\w+){2,}/;
    if(!(street.value.match(valid)) || (street.value == '')){
        document.getElementById('form_error').textContent = "insert a valid address";
        document.getElementById('form_error').style.visibility='visible';
    }
}
