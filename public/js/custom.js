var count = 0;
$(document).ready( function () {    
    $('#maintables').DataTable();
});

$(document).ready(function(){
  getCust();  
})

//populate customer table in customers module
function getCust(){
   if(window.location.href.indexOf("customers") > -1){  
       $('#loader').show();
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
                $(data).each(function(key, item){                         
                var id = item.custID;
                if(item.OnHold == 1){
                    table += "<tr  style='background-color:#d9534f' id='custRow' onclick='editCust(" + id + ")'>";
                } else {
                    table += "<tr id='custRow' onclick='editCust(" + id + ")'>";
                }
                table += "<th><input type='checkbox'></th>";
                table += "<th>" + item.CustCode +"</th>";
                table += "<th>" + item.CustName +"</th>";
                table += "<th>" + item.MainPhone +"</th>";
                table += "<th>" + item.MainEmail +"</th>";
                if(item.hosted == 1){
                table += "<th'>Yes</th>";                
                } else {
                table += "<th>No</th>";    
                }
                if(item.PulseStore == 1){
                table += "<th>Yes</th>";
                } else {
                table += "<th>No</th>";
                }
                if(item.StockControl == 1){
                table += "<th>No</th>";
                } else {
                table += "<th>Yes</th>";
                }
                table += "<th>" + item.DatePaidTo +"</th>";
                if(item.OnHold == 1){
                table += "<th>Yes</th>";
                } else {
                table += "<th>No</th>";
                }                
                
                table += "</tr>"; 
//                table += "<div id='modal-close-outside' uk-modal>\n\
//                        <div id='editCustModal-" + item.custID +"' uk-modal class='uk-modal-container'>\n\
//                        <div class='uk-modal-dialog uk-modal-body'>\n\
//                        <h4 style='text-align:centre'>Editing account: " + item.CustName +"</h4>\n\
//                        \n\<div class='alert alert-danger' id='requiredFields' hidden>\n\
//                        \n\<p>The following fields are required before the account can be created.</p>\n\
//                        \n\</div>\n\
//                        </div>\n\
//                        </div>\n\
//                        </div>";
                });                
                table += "</tbody>";
                table += "</table>";                                
                $('#custTableDiv').html(table);
                $('#custTable').DataTable();                
                $('#loader').hide();
           }
           
       });
   } 
};

//get single customer to populate edit cust modal. (customerController.php/getSingleCustomer()).
function editCust(id){
    $.getJSON("customers/singleCustomer",{
        queryString: id
    }, 
        function(data){
        if(data.length > 0 && typeof(data) != 'undefined'){
            var custForm = "<div class='alert alert-danger' id='requiredFields' hidden>\n\
                            <p>The following fields are required before the account can be created.</p>\n\
                            </div>\n\
                            <form class='uk-grid-small uk-form-horizontal' uk-grid action='{{action('customerController@addSingleCustomer')}}' method='post'>\n\
                            <ul class='uk-subnav uk-subnav-pill' uk-switcher>\n\
                                <li><a href='#'>Customer Information</a></li>\n\
                                <li><a href='#'>System Information</a></li>\n\
                                <li><a href='#'>Customer Contact Details</a></li>\n\
                                <li><a href='#'>Accounts Information</a></li>\n\
                                <li><a href='#'>Wholesaler Link Information</a>\n\
                            </ul>\n\
                <ul class='uk-switcher uk-margin'   style='width: 100%'>\n\
                    <li>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Account Code</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Code' name='code' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Company Name</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Company Name' name='companyName' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Street 1</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Street 1' name='street1' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Street 2</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Street 2' name='street2' >\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Town</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Town' name='town' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>County</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='County' name='county' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Postcode</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Postcode' name='postcode' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Main Phone</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Main Phone' name='mainphone' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Fax</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Fax' name='fax' >\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Main Email</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='email' placeholder='Main Email' name='mainemail' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Comments</label>\n\
                            <div class='uk-form-controls'>\n\
                                <textarea class='uk-textarea' rows='6' placeholder='Comments' name='comments' ></textarea>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Install Date</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='date' placeholder='date' name='install' >\n\
                            </div>\n\
                        </div>\n\
                    </li>\n\
                    <li>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Hosted Pulse?</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-checkbox' type='checkbox' name='hosted'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Stock?</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-checkbox' type='checkbox' name='stock' >\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>PulseStore?</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-checkbox' type='checkbox' name='pulseStore' >\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Terminal Server?</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-checkbox' type='checkbox' name='terminalserver' >\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>PulseOffice Version #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='PulseOffice Version #' name='pulseVersion'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>OPXML PC</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='OPXML PC' name='opxmlpc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Sage PC</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Sage PC' name='sagepc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>PulseLink PC</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='PulseLink PC' name='pulselinkpc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Sage Version #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Sage Version #' name='sagenum'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>PulseStore Shop #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='PulseStore Shop #' name='pulsestorenumber'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>PulseStore Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='PulseStore Password' name='pulsestorepassword'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Special Upgrade Requirements</label>\n\
                            <div class='uk-form-controls'>\n\
                                <textarea class='uk-textarea' rows='6' placeholder='Upgrade requirements' name='upgradeNotes' ></textarea>\n\
                            </div>\n\
                        </div>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Network Details</label>\n\
                            <div class='uk-form-controls'>\n\
                                <textarea class='uk-textarea' rows='6' placeholder='Network Details' name='network' ></textarea>\n\
                            </div>\n\
                        </div>\n\
                    </li>\n\
                    <li>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>First Name</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='First Name' name='conFirstName0'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Last Name</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Last Name' name='conLastName0'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Phone</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Phone Number' name='conPhoneNumber0'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Email</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='email' placeholder='Email' name='conEmail0'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Main Contact?</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-checkbox' type='checkbox' name='conMain0' >\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-margin'>\n\
                            <label class='uk-form-label' for='form-horizontal-select'>Select Main Role</label>\n\
                            <div class='uk-form-controls'>\n\
                                <select class='uk-select' name='conRoleChoice0'>\n\
                                    <option value='1'>1</option>\n\
                                    <option value='2'>2</option>\n\
                                    <option value='3'>3</option>\n\
                                </select>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <hr>\n\
                        <div id='additionalContacts'></div>\n\
                        <a href='#' onclick='moreContactFields();'>Add More Contacts?</a>\n\
                    </li>\n\
                    <li>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Licence Expiry Date</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='date' placeholder='date' name='expiry'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Licence To Date</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='date' placeholder='date' name='licenceToDate'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>On hold?</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-checkbox' type='checkbox' name='onhold' >\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Date paid until</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='date' placeholder='date' name='paidto'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Licence Notes</label>\n\
                            <div class='uk-form-controls'>\n\
                                <textarea class='uk-textarea' rows='6' placeholder='Licence Notes' name='licenceNotes' ></textarea>\n\
                            </div>\n\
                        </div>\n\
                    </li>\n\
                    <li>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Vow Account #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Vow Account #' name='vowacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Vow Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Vow Password' name='vowpass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Vow Discount %</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='number' min='0' max='100' placeholder='Vow Discount' name='vowdisc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Spicer Account #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Spicers Account #' name='spicacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Spicers Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Spicers Password' name='spicpass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Antalis Account #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Antalis Account #' name='antacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Antalis Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Antalis Password' name='antpass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Truline Account #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Truline Account #' name='truacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Truline Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Truline Password' name='trupass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Beta Account</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Beta Account' name='betaacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Beta Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Beta Password' name='betapass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Exertis Account #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Exertis Account #' name='exertacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Exertis Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Exertis Password' name='exertpass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Buying Group</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='Buying Group' name='buyinggroup'>\n\
                            </div>\n\
                        </div>\n\
                    </li>\n\
                </ul>\n\
                <br>\n\
                <input type='submit' class='btn btn-primary' value='save' onClick='validate();'>\n\
            </form>\n\ ";
            console.log('------------------------------');
            console.log(data[0]);
            UIkit.modal.alert("<div id='editCustForm'>Fetching customer id: " + id + " " + data[0].CustName + "<br> " + custForm + "</div>");
        } else {
           //made a fucky boingo  
        };
    });    
};

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
