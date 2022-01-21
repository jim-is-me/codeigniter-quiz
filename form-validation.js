$(document).ready(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='add_question']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
          // Specify that email should be validated
          // by the built-in "email" rule
        question: "required",
        correctanswer : "required",
        answer1 : "required",
        answer2 : "required",
        answer3 : "required",
        answer4 : "required",
      },
      // Specify validation error messages
      messages: {
        question: "Please enter the question",
        correctanswer: " * Please check the correct answer ",
        answer1 : "answer required",
        answer2 : "answer required",
        answer3 : "answer required",
        answer4 : "answer required",
      }, 
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
    $("form[name='adminForm']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        email: {
          required: true,
          // Specify that email should be validated
          // by the built-in "email" rule
          email: true
        },
        psw: {
          required: true,
          minlength: 5
        }
      },
      // Specify validation error messages
      messages: {
        email: "Please enter a valid email address",
        psw: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
      }, 
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });

  });
