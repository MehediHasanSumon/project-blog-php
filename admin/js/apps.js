$(document).ready(function () {
  $("#password2").on("keyup", function () {
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
