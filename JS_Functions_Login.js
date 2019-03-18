function toHome() {
      var frm = document.getElementById("login_result");
      frm.submit();
}
function signInFieldCheck() {
  var email = document.forms["signInForm"]["email"].value;
  var password = document.forms["signInForm"]["password"].value;
  if (email == "") {
    missingFieldAlert();
    document.forms["signInForm"]["email"].style.borderColor = "red";
    return false;
  }
  if (password == "") {
    missingFieldAlert();
    document.forms["signInForm"]["password"].style.borderColor = "red";
    return false;
  }
  return true;
}
function signUpFieldCheck() {
  var email = document.forms["signUpForm"]["email_new"].value;
  var password = document.forms["signUpForm"]["password_new"].value;
  var password_confirm = document.forms["signUpForm"]["password_confirm"].value;
  if (email == "") {
    missingFieldAlert();
    document.forms["signUpForm"]["email_new"].style.borderColor = "red";
    return false;
  }
  if (password == "") {
    missingFieldAlert();
    document.forms["signUpForm"]["password_new"].style.borderColor = "red";
    return false;
  }
  if (password_confirm == "") {
    missingFieldAlert();
    document.forms["signUpForm"]["password_confirm"].style.borderColor = "red";
    return false;
  }
  return true;
}
function missingFieldAlert() {
  alert("Not all necessary fields have been entered. Fill in the boxes highlighted in red.")
}
function toCalender() {
  window.location = "calendar-page.php";
}
