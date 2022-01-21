$(document).ready(function() {

    $.validator.addMethod("mytst", function (value, element) {
        var flag = true;

        $("[name^=name_ct]").each(function (i, j) {
                $(this).parent('p').find('label.error').remove();
        $(this).parent('p').find('label.error').remove();                        
                if ($.trim($(this).val()) == '') {
                     flag = false;

                     $(this).parent('p').append('<label  id="id_ct'+i+'-error" class="error">This field is required.</label>');
                }
        });


        return flag;


    }, "");
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='edit_question']").validate({

      ignore: '',
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
          // Specify that email should be validated
          // by the built-in "email" rule
        question: "required",
        correctanswer : "required",
        answer: "required"
      },
      // Specify validation error messages
      messages: {
        question: "Please enter the question",
        correctanswer: " * Please check the correct answer ",
        answer: "Please fill the field"
      }, 

      
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });

  });

  
