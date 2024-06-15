$(document).ready(function () {
  //* validate email address
  const email = document.getElementById("email");
  email.addEventListener("blur", () => {
    let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
    let emailCheck = email.value;
    if (regex.test(emailCheck)) {
      email.classList.remove("is-invalid");
      emailError = true;
    } else {
      email.classList.add("is-invalid");
      emailError = false;
    }
  });

  // * validate username
  $("#usernameCheck").hide();
  let usernameError = true;
  $("#username").keyup(function () {
    validateUsername();
  });
  function validateUsername() {
    let usernameValue = $("#username").val();
    if (usernameValue.length == "") {
      $("#usernameCheck").show();
      usernameError = false;
      return false;
    } else if (usernameValue.length < 8 || usernameValue.length > 16) {
      $("#usernameCheck").show();
      $(usernameCheck).html("**Username length must be between 8 and 16");
      usernameError = false;
      return false;
    } else {
      $("#usernameCheck").hide();
    }
  }

  //* validate password
  $("#passwordCheck").hide();
  let passwordError = true;
  $("#password").keyup(function () {
    validatePassword();
  });

  function validatePassword() {
    const password = document.getElementById("password");
    password.addEventListener("blur", () => {
      let regex =
        /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/;
      let passwordCheck = password.value;
      if (regex.test(passwordCheck)) {
        $("#passwordCheck").hide();
        passwordError = true;
      } else {
        $("#passwordCheck").show();
        $("#passwordCheck").html(
          "**Password length must be between 8 and 16 characters with combination at least 1 lowercase, 1 uppercase, 1 number and 1 special character"
        );
        passwordError = false;
      }
    });
  }

  //* validate confirmpassword
  $("#confirmpasswordCheck").hide();
  let confirmPasswordError = true;
  $("#confirmpassword").keyup(function () {
    validateConfirmPassword();
  });

  function validateConfirmPassword() {
    let passwordValue = $("#password").val();
    let confirmPasswordValue = $("#confirmpassword").val();
    if (confirmPasswordValue.length == "") {
      $("#confirmpasswordCheck").show();
      confirmPasswordError = false;
      return false;
    } else if (passwordValue != confirmPasswordValue) {
      $("#confirmpasswordCheck").show();
      $("#confirmpasswordCheck").html("**Passwords do not match");
      confirmPasswordError = false;
      return false;
    } else {
      $("#confirmpasswordCheck").hide();
    }
  }

  //* submitBtn
  $("#submitBtn").click(function () {
    validateUsername();
    validateEmail();
    validatePassword();
    validateConfirmPassword();

    if (
      usernameError == true &&
      emailError == true &&
      passwordError == true &&
      confirmPasswordError == true
    ) {
      return true;
    } else {
      return false;
    }
  });
});
