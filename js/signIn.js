/*
function User {

}

*/

function isTrue(COND, ELEM, BOOL, MESS) {
	for (var i=0; i<ELEM.length; i++) {
		var j = ELEM[i];
		field = fields[j];
		if (COND.test(field.value) == BOOL) {
			error(MESS, field);
			return true;
		}
	}
	return false;
}

function validateSignIn() {
	if (isTrue(existALPHANUMERICAL, shouldBeALPHANUMERICAL, false, 0)) return;
	if (isTrue(existNONALPHANUMERICAL, shouldBeALPHANUMERICAL, true, 0)) return;
	if (isTrue(existNONNUMERICAL, shouldBeNUMERICAL, true, 1)) return;
	if (isTrue(exist5NUMERICAL, shouldBe5NUMBERS, false, 2)) return;
	if (isTrue(existNUMERICAL, shouldBeALPHABETICAL, true, 3)) return;
	if (isTrue(existNONALPHANUMERICAL, shouldBeALPHABETICAL, true, 3)) return;
	window.alert(MESSAGES[MESSAGES.length-1]);
}


var fields = document.getElementsByTagName("input");
var shouldBeALPHANUMERICAL = [0, 1, 4]; //(1)
var shouldBeNUMERICAL = [2, 4];
var shouldBeALPHABETICAL = [0, 1, 3];
var shouldBe5NUMBERS = [4];
var MESSAGES = [ "The following field does not have valid symbols: ",
				"The following field is not exclusively numerical: ",
				"The following field must have five digits: ",
				"The following field must have only letters: ",
				"...",
				"OK"];
var existALPHANUMERICAL = /\w/;
var existNONALPHANUMERICAL = /\W/;
var existNONNUMERICAL = /\D/;
var existNUMERICAL = /\d/;
var exist5NUMERICAL = /^\d{5}$/;

function error(idmess, field) { 
	window.alert(MESSAGES[idmess] + field.name);
	field.focus(); field.select();
}

