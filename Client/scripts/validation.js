function validateForm() {
    var name = document.forms["registerForm"]["fname"].value;
    var email = document.forms["registerForm"]["femail"].value;
    var password = document.forms["registerForm"]["fpassword"].value;
    var telephone = document.forms["registerForm"]["ftele"].value;
    console.log(name + " "+ email + " " + password + " "+ telephone);
    if (!validateEmpty(name, email, password, telephone)) return false;
    if (!validateEmail(email)) return false;
    if (!validatePassword(password)) return false;
    if (!validateTele(telephone)) return false;
}

function validateEmpty(name, email, password, telephone) {
    if (name == "") {
        alert("Name Field is Empty");
        return false;
    }
    if (email == "") {
        alert("Email Field is Empty");
        return false;
    }
    if (password == "") {
        alert("Password Field is Empty");
        return false;
    }
    if (telephone == "") {
        alert("Telephone Field is Empty");
        return false;
    }
    return true;
}
// Regular Expression Pattern
// /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
// Character	Description
// / .. /	All regular expressions start and end with forward slashes.
// ^	Matches the beginning of the string or line.
// \w+	Matches one or more word characters including the underscore. Equivalent to [A-Za-z0-9_].
// [\.-]	\ Indicates that the next character is special and not to be interpreted literally.
// .- matches character . or -.
// ?	Matches the previous character 0 or 1 time. Here previous character is [.-].
// \w+	Matches 1 or more word characters including the underscore. Equivalent to [A-Za-z0-9_].
// *	Matches the previous character 0 or more times.
// ([.-]?\w+)*	Matches 0 or more occurrences of [.-]?\w+.
// \w+([.-]?\w+)*	The sub-expression \w+([.-]?\w+)* is used to match the username in the email. It begins with at least one or more word characters including the underscore, equivalent to [A-Za-z0-9_]. , followed by . or - and . or - must follow by a word character (A-Za-z0-9_).
// @	It matches only @ character.
// \w+([.-]?\w+)*	It matches the domain name with the same pattern of user name described above..
// \.\w{2,3}	It matches a . followed by two or three word characters, e.g., .edu, .org, .com, .uk, .us, .co etc.
// +	The + sign specifies that the above sub-expression shall occur one or more times, e.g., .com, .co.us, .edu.uk etc.
// $	Matches the end of the string or line.
// The above explaination for the regular expression used to validate the email address is found on:
// https://www.w3resource.com/javascript/form/email-validation.php
function validateEmail(email) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        return true;
    }
    alert("Invalid Email Address");
    return false;
}

//Setting Password Standards to have capital letters, numbers and lower case letters.
function validatePassword(password){
    var UpperCaseChars = /[A-Z]/g;
    var LowerCaseChars = /[a-z]/g;
    var numbers = /[0-9]/g;
    var pwLength = 8;
    if (password.match(UpperCaseChars) && password.match(LowerCaseChars) && password.match(numbers) && password.length >= pwLength){
        return true;
    }
    alert("Invalid Password, must be at least 8 characters long, contain at least one capital and lower case letter.")
    return false;

}

function validateTele(telephone){
    telephone = telephone.replace(/-/g, '');
    console.log(telephone);
    // Regex for patter of the phone number.
    var numPattern = /[0-9]{3}[0-9]{3}[0-9]{4}/;
    if (numPattern.test(telephone)){
        return true;
    }
    alert("Invalid Phone Number");
    return false;
}