var count = 0;
$(document).ready( function () {    
    $('#maintables').DataTable();
});

//function editUser(){  
//  var modal = document.getElementById("#usersRow");
//  var firstname = modal.dataset.firstname;
//  console.log(firstname);
//};

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
  alert('ITS FRIDAY!');
  count = count + 1;
  alert(count);
};
