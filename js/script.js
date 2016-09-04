function isEmpty(obj) {
	if (obj.length === 0) {
		return true;
	} else {
		return false;
	}
}//end isEmpty

//INPUT error_id: string value representing id attribute of HTML <p> tag
/*inserts html in between HTML <p> tags notifying of an empty field*/
function printEmptyFieldError(error_id) {
	document.getElementById(error_id).innerHTML = "This field cannot be empty";
}//end printEmptyFieldError()

//INPUT fn_or_ln: string value to be prepended in message
//INPUT error_id: string value representing id attribute of HTML <p> tag
/*to be used for first name and last name validation displays invalid input message*/
function printInvalidFieldError(fn_or_ln ,error_id) {
	document.getElementById(error_id).innerHTML = fn_or_ln + " name can only contain letters and spaces";
}//end printInvalidFieldError

//INPUT obj: form name attribute
//INPUT id: string value representing id attribute of HTML <p> tag
//INPUT fn_or_ln: string value to be prepended in message
/*to be used for first name and last name validation, executes validation for
empty, invalid and valid fields and displays corresponding message*/
function checkName(obj, id, fn_or_ln) {
	var name_pattern = /^[a-z,A-Z ]+$/;

	if (isEmpty(obj, id)) {
		printEmptyFieldError(id);
	} else if (!name_pattern.test(obj)){
		printInvalidFieldError(fn_or_ln, id)
	} else {
		document.getElementById(id).innerHTML = "";
	}
}//end checkName

//INPUT obj: form name attribute
//INPUT id: string value representing iattribute of HTML <p> tag
//INPUT rgx: regex to be tested
//INPUT msg: message to be displayed for invalid inputs
/*generic field validator executes validation for
empty, invalid and valid fields and displays corresponding message*/
function checkField(obj, id, rgx, msg) {
	if (isEmpty(obj)) {
		printEmptyFieldError(id);
	} else if (!rgx.test(obj)) {
		document.getElementById(id).innerHTML = msg;
	} else {
		document.getElementById(id).innerHTML = "";
	}
}//end chedkField

function passwordsMatch() {
    if(isEmpty(document.getElementById("password2").value)) {
		printEmptyFieldError("password_error");
	} else if (document.getElementById("password").value != document.getElementById("password2").value) {
        console.log(document.getElementById("password").value);
        console.log(document.getElementById("password2").value);
        document.getElementById("password_error").style.display = "inline";
		document.getElementById("password_error").innerHTML = "Passwords do not match";
        return false;
    } else {
        document.getElementById("password_error").style.display = "none";
        console.log(document.getElementById("password").value);
        console.log(document.getElementById("password2").value);
        return true;
    }
}

//INPUT obj: form name attribute
//INPUT id: string value representing id attribute of HTML <p> tag
//INPUT rgx: regex to be tested
//INPUT msg: message to be displayed for invalid inputs
/*generic field validator executes validation for
empty, invalid and valid fields and displays corresponding message*/
function checkField(obj, id, msg) {
    var rgx= new RegExp(/[0-9]{10}/);
	if (isEmpty(obj)) {
		printEmptyFieldError(id);
        return false;
	} else if (!rgx.test(obj)) {
        document.getElementById(id).style.display="inline";
		document.getElementById(id).innerHTML = msg;
        return false;
	} else {
        document.getElementById(id).style.display="none";
		document.getElementById(id).innerHTML = "";
        return true;
	}
}//end chedkField

function Checkstuff()
{
    var numb = checkField(signup_form.contact.value, 'contact_error', 'Only numbers allowed');
    var pass = passwordsMatch();
    if (!numb || !pass)
        {
            console.log("false");
            console.log(numb);
            console.log(pass);
            return false;
        }
    else
        console.log("true");
        return true;
}