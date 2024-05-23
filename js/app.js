$(document).ready(function () {
  // Name Validation
  $("#name").on("keyup", function () {
    var name = $(this).val();
    if (name === "") {
      $("#msg").html("<div class='error'>Please enter your name.</div>");
      $("#login").prop("disabled", true);
    } else {
      $("#msg").html("");
      $("#login").prop("disabled", false);
    }
  });

  // Email Validation
  $("#email").on("keyup", function () {
    var email = $(this).val();
    if (!validateEmail(email)) {
      $("#msg").html("<div class='error'>Enter a valid email address.</div>");
      $("#login").prop("disabled", true);
    } else {
      $("#msg").html("");
      $("#login").prop("disabled", false);
    }
  });

  // Validation with regular expression
  function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  }

  // Password Validation
  $("#password").on("keyup", function () {
    var password = $(this).val();
    if (password === "") {
      $("#msg").html("<div class='error'>Please enter your password.</div>");
      $("#login").prop("disabled", true);
    } else {
      $("#msg").html("");
      $("#login").prop("disabled", false);
    }
  });

  // Password Match
  $("#password2").on("blur", function () {
    var password = $("#password").val();
    var confirmPassword = $(this).val();
    if (password !== confirmPassword) {
      $("#msg").html("<div class='error'>Passwords do not match.</div>");
      $("#login").prop("disabled", true);
    } else {
      $("#msg").html("");
      $("#login").prop("disabled", false);
    }
  });
});

$(document).ready(function () {
  $("#imageUpload").change(function () {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        $("#imagePreview").attr("src", e.target.result).show();
      };

      reader.readAsDataURL(file);
    } else {
      $("#imagePreview").hide();
    }
  });
});
