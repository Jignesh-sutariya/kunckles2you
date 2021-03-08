$(document).ready(function() {
  var input = $("form").first().find(':input').first().attr('id');
  $("#"+input).focus();
  $("#LoginValidation").validate({
    rules: {
      password: "required",
      mobile: {
        required: true,
        digits: true,
        minlength: 10,
        maxlength: 10
      }
    },
    highlight: function(element) {
      $(element).closest('.input-group').removeClass('has-success').addClass('has-danger');
    },
    unhighlight: function(element) {
      $(element).closest('.input-group').removeClass('has-danger').addClass('has-success');
    },
    errorPlacement: function(error, element) {
      return true;
    }
  });

  $("#forgotValidation").validate({
    rules: {
      password: "required",
      mobile: {
        required: true
      }
    },
    highlight: function(element) {
      $(element).closest('.input-group').removeClass('has-success').addClass('has-danger');
    },
    unhighlight: function(element) {
      $(element).closest('.input-group').removeClass('has-danger').addClass('has-success');
    },
    errorPlacement: function(error, element) {
      return true;
    }
  });
});

login = {
          showSwal: function(message, icon){
            Swal.fire({
              title: message,
              icon: icon,
              customClass: {
                confirmButton: 'btn btn-success'
              },
              buttonsStyling: false

            })
          }
        }