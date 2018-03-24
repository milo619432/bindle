var count = 0;
$(document).ready( function () {    
    $('#maintables').DataTable();
});

//customer table awesomeness
$(document).ready( function () {
    $('#custTable').DataTable();
} );

//$(document).ready(function(){
//    $('#loader').hide();
//   $('#custTableDiv').show();   
//});

//populate customer table in customers module
$(document).ready(function(){
   if(window.location.href.indexOf("customers") > -1){           
       $.getJSON("/customers/allCustomers",
        function(data){
            if(data.length > 0 && typeof(data) != 'undefined'){
                var table = "<div id='custTableDiv'>\n\
                <table class='table table-striped table-hover' id='custTable'>\n\
                <thead><tr><th></th>\n\
                <th scope='col'>Code</th>\n\
                <th scope='col'>Company Name</th>\n\
                <th scope='col'>Main Phone</th>\n\
                <th scope='col'>Main Email</th>\n\
                <th scope='col'>Hosted Pulse</th>\n\
                <th scope='col'>PulseStore</th>\n\
                <th scope='col'>Stock</th>\n\
                <th scope='col'>Date Paid Until</th>\n\
                <th scope='col'>On Hold</th>\n\
                </tr>\n\
                </thead>\n\
                <tbody>";
                console.log(data);
                $(data).each(function(key, item){
                console.log(item.OnHold);
                if(item.OnHold == 1){
                    table += "<tr  style='background-color:#d9534f' id='custRow'>";
                } else {
                    table += "<tr id='custRow'";
                }
                table += "<th><input type='checkbox'><th>";
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >" + item.CustCode +"</th>";
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >" + item.CustName +"</th>";
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >" + item.MainPhone +"</th>";
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >" + item.MainEmail +"</th>";
                if(item.hosted == 1){
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >Yes</th>";                
                } else {
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >No</th>";    
                }
                if(item.PulseStore == 1){
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >Yes</th>";
                } else {
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >No</th>";
                }
                if(item.StockControl == 1){
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >Yes</th>";
                } else {
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >No</th>";
                }
                if(item.OnHold == 1){
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >Yes</th>";
                } else {
                table += "<th uk-toggle='target: #editCustModal-" + item.custID +"' >No</th>";
                }
                table += "</tr>";
                });
                table += "</tbody>";
                table += "</table>";                
                //document.getElementById('custTableDiv').innerHTML = table;
                document.getElementById('custTableDiv').innerHtml = table;
           }
           
       });
   } 
});


//check required fields are filled in
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

//add extra contact fields to create customr form
function moreContactFields(){
    if(count < 5)
    {
        count = count + 1;
    var moreFields = "<div class='uk-width-1-2@s'>\n\
\n\<label class='uk-form-label' for='form-horizontal-text'>First Name</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<input class='uk-input' type='text' placeholder='First Name' name='conFirstName" + count +"' required>\n\
\n\</div>\n\
\n\</div>\n\
\n\<br>\n\
\n\<div class='uk-width-1-2@s'>\n\
\n\<label class='uk-form-label' for='form-horizontal-text'>Last Name</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<input class='uk-input' type='text' placeholder='Last Name' name='conLastName" + count +"' required>\n\
\n\</div>\n\
\n\</div>\n\
\n\<br>\n\
\n\<div class='uk-width-1-2@s'>\n\
\n\<label class='uk-form-label' for='form-horizontal-text'>Phone Number</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<input class='uk-input' type='text' placeholder='Phone Number' name='conPhoneNumber" + count +"'>\n\
\n\<input type='hidden' name='count' value='" + count +"'\n\
\n\</div>\n\
\n\</div>\n\
\n\<br>\n\
\n\<div class='uk-width-1-2@s'>\n\
<label class='uk-form-label' for='form-horizontal-text'>Email</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<input class='uk-input' type='email' placeholder='Email' name='conEmail" + count +"' required>\n\
\n\</div>\n\
\n\</div>\n\
\n\<br>\n\
\n\<div class='uk-width-1-2@s'>\n\
\n\<label class='uk-form-label' for='form-horizontal-text'>Main Contact?</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<input class='uk-checkbox' type='checkbox' name='conMain" + count +"' >\n\
\n\</div>\n\
\n\</div>\n\
\n\<div class='u-k-margin'>\n\
<label class='uk-form-label' for='form-horizontal-select'>Select Main Role</label>\n\
\n\<div class='uk-form-controls'>\n\
\n\<select class='uk-select' name='conRoleChoice" + count +"'>\n\
\n\<option value='1'>1</option>\n\
\n\<option value='2'>2</option>\n\
\n\<option value='3'>3</option>\n\
\n\</select>\n\
\n\</div>\n\
\n\</div>\n\
\n\<br>\n\
\n\<hr>\n\
\n\<br>\n\
</div>";    
    $("#additionalContacts").append(moreFields);
    }  
    else 
    {
        var noMoreFields = "<div alert alert-danger><h4>Maximum number of contacts reached</h4></div>";
    $("#additionalContacts").append(noMoreFields);
    }
};
