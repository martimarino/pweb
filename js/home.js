


/* ------------------------------------------------------------------------ */

function fade(a) {                          //comparsa/scomparsa login
	var e = document.getElementById(a);
    e.className == "fadeout" ? e.className = "fadein" : e.className = "fadeout";
}

function Nav(a) {                //menu a comparsa laterale
	var e = document.getElementById(a);
	e.style.width == "250px" ? e.style.width = "0" : e.style.width = "250px";
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

function showPopUp(invalidInput) {
    var popup = document.getElementById("myPopup");

    document.getElementById("myPopup").firstChild.nodeValue=invalidInput;

    popup.classList.toggle("show");
    return;
}

function hideSlidesShowCatalog(){
    var slides = document.getElementsByClassName("mySlides");
    document.removeChild(slides);
    content = document.createElement("div");
    content.setAttribute("id", "content");
    
}

function hideBadges(){
    var badge = document.getElementById("wishlistBadge");
    badge.remove();
    badge = document.getElementById("cartBadge");
    badge.remove();
}

function getSelectedValue(tag){
    var element = document.getElementById(tag);
    var selectedValue = element.options[element.selectedIndex].value; 
    return selectedValue;
}

function insertIntoCatalog(){
    var model = document.getElementById("model_input").value;
    var color = document.getElementById("color_input").value;
    var category = document.getElementById("category_input").value;
    var genre = document.getElementById("genre_input").value;
    var collection = document.getElementById("collection_input").value;
    var price = document.getElementById("price_input").value;
    var image = document.getElementById("image_input").value;

    AdminLoader.insertNewGarment(model, color, category, genre, collection, price, image);
}

function modifyGarment(){
    var garmentId = getSelectedValue("ID");
    var field = getSelectedValue("garmentField");
    var newValue = document.getElementById("new_garment_value").value;
    AdminLoader.modifyGarmentProperty(garmentId, field, newValue);
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

function removeFromRightLst(){
        var heart = document.getElementById("favourites");
        heart.parentNode.removeChild(heart);
        var wishlistBadge = document.getElementById("wishlistBadge");
        wishlistBadge.parentNode.removeChild("wishlistBadge");
        var cart = document.getElementById("cart");
        cart.parentNode.removeChild(cart);
        cartBadge = document.getElementById("cartBadge");
        cartBadge.parentNode.removeChild("cartBadge");
    }