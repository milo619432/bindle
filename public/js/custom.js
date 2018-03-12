var count = 0;
$(document).ready( function () {    
    $('#maintables').DataTable();
});


function validate(){  
    var allInputs = $(":input");
    var list = "<ul>"
    var errors = false;
    $.each(allInputs, function(key, objValue){
      if($(this).prop('required')){                  
          if(!$(this).val()){  
              errors = true;
              $(this).css("background-color", "#f8d7da");
              list += "<li>" + objValue.placeholder + "</li>"
              event.preventDefault();
          } else {
              $(this).css("background-color", "#d4edda");
          }
       }; 
    });
    list += "<ul>";
    if(true == errors){
        $("#requiredFields").removeAttr('hidden');
        document.getElementById("requiredFields").innerHTML = list;
    };
};

function moreContactFields(){
    count = count + 1;
    var moreFields = "<div class='uk-width-1-2@s'>\n\
\n\<label class='uk-form-label' for='form-horizontal-text'>First Name</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<input class='uk-input' type='text' placeholder='First Name' name='firstName" + count +"'>\n\
\n\</div>\n\
\n\</div>\n\
\n\<br>\n\
\n\<div class='uk-width-1-2@s'>\n\
\n\<label class='uk-form-label' for='form-horizontal-text'>Last Name</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<input class='uk-input' type='text' placeholder='Last Name' name='lastName" + count + "'>\n\
\n\</div>\n\
\n\</div>\n\
\n\<br>\n\
\n\<div class='uk-width-1-2@s'>\n\
\n\<label class='uk-form-label' for='form-horizontal-text'>Phone Number</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<input class='uk-input' type='text' placeholder='Phone Number' name='conPhone" + count + "'>\n\
\n\</div>\n\
\n\</div>\n\
\n\<br>\n\
\n\<div class='uk-width-1-2@s'>\n\
\n\<label class='uk-form-label' for='form-horizontal-text'>Main Contact?</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<input class='uk-checkbox' type='checkbox' name='main" + count + "' >\n\
\n\</div>\n\
\n\</div>\n\
\n\<div class='u-k-margin'>\n\
<label class='uk-form-label' for='form-horizontal-select'>Select Main Role</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<select class='uk-select' name='roleChoice" + count + "'>\n\
\n\<option value='#'>1</option>\n\
\n\<option value='#'>2</option>\n\
\n\<option value='#'>3</option>\n\
\n\</select>\n\
\n\</div>\n\
\n\</div>\n\
\n\<br>\n\
\n\<hr>\n\
\n\<br>\n\
</div>";    
    $("#additionalContacts").append(moreFields);
};
