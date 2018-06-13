var count = 0;
$(document).ready( function () {    
    $('#maintables').DataTable();
});

$(document).ready(function(){
    getCust();  
    if(window.location.href.indexOf('issues') > -1 || window.location.href.indexOf('addIssue') > -1 || window.location.href.indexOf('dash') > -1 || window.location.href.indexOf('login') > -1){
        getIssues();
    }  
});

$(document).ready(function(){
   if(window.location.href.indexOf('login') > -1) {
       url = "/dash";
      $(location).attr("href", url);
   }
});

//populate modal drop down in issues
function getAllCusts(){    
        $.getJSON("/customers/allCustomers",
        function(data){
            if(data.length > 0 && typeof(data) != 'undefined'){                
                var menu = $("#issueCustMenu");                
                $(data).each(function(key, item){                         
                menu.append($("<option />").val(item.custID).text(item.CustName));
       });
    }   
})
}

function getUsers(){    
        $.getJSON("/issues/getUsers",
        function(data){
            if(data.length > 0 && typeof(data) != 'undefined'){ 
                console.log(data);
                var menu = $("#assignedTo");                
                $(data).each(function(key, item){                         
                menu.append($("<option />").val(item.UserID).text(item.firstName + " " + item.lastName));
       });
    }   
})
}

$(document).ready(function(){
    if(window.location.href.indexOf('dash') > -1 ){        
        $.getJSON("/dash/panels",
        function(data){        
        $(data).each(function(key,item){
            $("#totals").text(item.total[0].COUNT);
            $("#outstanding").text(item.outstanding[0].outstanding);
            $("#today").text(item.today[0].TODAY);
            item.total[0].COUNT
//            console.log(item.today[0].TODAY);
//            console.log(item.outstanding[0].outstanding);
//            console.log(item.total[0].COUNT);
        })
        
//        $("#totals").text("data[0].outstanding");
       
    });    
    }  
});


//populate issues table
function getIssues(){
        if(window.location.href.indexOf('issues') > -1 || window.location.href.indexOf('addIssue') > -1 || window.location.href.indexOf('editIssue') > -1 || window.location.href.indexOf('dash') > -1){
        $("#loader").show();
        $.getJSON("/issues/getIssues",
        function(data){
            if(data.length > 0 && typeof(data) != 'undefined'){
                console.log(data);
                var table = "<table class='table table-striped table-hover' id='issueTable'>\n\
                <thead><tr><th></th>\n\
                <th scope='col'>Ticket number</th>\n\
                <th scope='col'>Company Name</th>\n\
                <th scope='col'>Product</th>\n\
                <th scope='col'>Issue date</th>\n\
                <th scope='col'>Issue status</th>\n\
                <th scope='col'>Symptom</th>\n\
                </tr>\n\
                </thead>\n\
                <tbody>";
            }
            $(data).each(function(key, item){
                var issueID = item.LogID;
                table += "<tr id='custRow' onclick='editIssue(" + issueID + ")'>";
                table += "<th><input type='checkbox'></th>";
                table += "<th>" + item.LogID +"</th>";
                table += "<th>" + item.CustName +"</th>";
                table += "<th>" + item.product +"</th>";
                table += "<th>" + item.DateofIssue +"</th>";
                if(item.statusID == null){
                    table += "<th>Live issue</th>";
                }
                else
                {
                    table += "<th>Closed</th>";
                }                
                table += "<th>" + item.Symptoms +"</th>"; 
                table += "</tr>";
            });
            table += "</tbody>";
            table += "</table>";    
            $('#issueTableDiv').html(table);
            $('#issueTable').DataTable();                
            $('#loader').hide();
        });    
        }        
};



//populate customer table in customers module or populate dropdown in create issue modal
function getCust(){   
        if(window.location.href.indexOf("customers") > -1 || window.location.href.indexOf("editCustomer") > -1 || window.location.href.indexOf("addCustomer") > -1){
        $('#loader').show();
        $.getJSON("/customers/allCustomers",
        function(data){
            if(data.length > 0 && typeof(data) != 'undefined'){                
                var table = "<table class='table table-striped table-hover' id='custTable'>\n\
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
                table += "<th>Yes</th>";                
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
                });                
                table += "</tbody>";
                table += "</table>";                                
                $('#custTableDiv').html(table);
                $('#custTable').DataTable();                
                $('#loader').hide();
           }
           
       });
    } 
    }
 
    


function editIssue(id){
    $.getJSON("issues/editIssue",{
       queryString: id 
    },
        function(data){
        if(data[0].completionDate != null)
        {
            var finished = data[0].completionDate
        }
        else
        {
            var finished = 'n/a';
        }
        var token = "{{ csrf_token() }}";
        var issueForm = "<button class='uk-modal-close' type='button' style='float: right' uk-close></button>\n\
                <form class='uk-grid-small uk-form-horizontal' method='post' uk-grid action='/editIssue' >\n\
                <div id='issueDrops'>\n\
                    <div class='uk-width-1-2@s' id='drops'>\n\
                    <input type='hidden' name='_token' value='" + token + "'>\n\
                    <input type='hidden' name='LogID' value='" + data[0].LogID + "'>\n\
                    </div>\n\
                    <div id='uk-width-1-2@s'>\n\
                        <label class='uk-form-label' for='form-horizontal-text'>Initial symptoms</label>\n\
                            <div class='uk-form-controls'>\n\
                                <textarea class='uk-textarea' rows='6' id='mytextarea' placeholder='" + data[0].Symptoms + "'  name='symptoms' >" + data[0].Symptoms + "</textarea>\n\
                            </div>\n\
                    </div>\n\
                <br>\n\
                <div id='uk-width-1-2@s'>\n\
                    <label class='uk-form-label' for='form-horizontal-text'>Resolution</label>\n\
                        <div class='uk-form-controls'>\n\
                            <textarea class='uk-textarea' rows='6' placeholder='" + data[0].Resolution + "'  name='resolution' >" + data[0].Resolution + "</textarea>\n\
                        </div>\n\
                </div>\n\
                <br>\n\
                <div class='uk-width-1-2@s'>\n\
                    <label class='uk-form-label' for='form-horizontal-text'>Completion date: </label>\n\
                    <div class='uk-form-controls'>\n\
                        <input class='uk-input' type='date' name='completionDate' value=''>\n\
                    </div>\n\
                </div>\n\
                <br>\n\
                <div id='inputGroup'>\n\
                    <input type='submit' class='btn btn-primary' value='save' >\n\
                </div>\n\
                </div>\n\
                </div>\n\
            </form>";

        UIkit.modal.alert("<div id='createIssue'><h3 style='text-align: center;'>Editing ticket # : " + data[0].LogID + "</h3><br><h4>Customer: " + data[0].CustName + "</h4>\n\
        <br><h4>Assigned to: " + data[0].firstName + " " + data[0].lastName +"</h4><h4>Product: " + data[0].product + "</h4><br>\n\
        <h4>Issue Date: " + data[0].DateofIssue + "</h4><br>" + issueForm + "</div>");
        $('.uk-modal-dialog').css('width','80%');
        $(".uk-modal-footer").hide();
        getUsers();
        getAllCusts();
        }            
    );
}

//get single supplier for edit supp modal
function editSupp(id){
    alert(id);
    $.getJSON("suppliers/singleSupplier",{
        queryString: id
    },
        function(data){
            if(data.length > 0 && typeof(data) != 'undefined'){
                var token = "{{ csrf_token }}";
                var suppForm = '<form class="uk-grid-small uk-form-horizontal" uk-grid action="/editSupplier" method="post">\n\
                \n\<div class="uk-width-1-2@s">\n\
                \n\<label class="uk-form-label" for="form-horizontal-text">Account Code</label>\n\
                \n\<div class="uk-form-controls">\n\
                \n\<input class="uk-input" type="text" placeholder="' + data[0].code + '" value="' + data[0].code + '" name="code" required>\n\
                \n\</div>\n\
                \n\</div>\n\
                \n\<br>\n\
                </form>';
                UIkit.modal.alert("<div id='editSuppForm'><h3 style='text-align: center;'>Editing Supplier : " + data[0].name + "</h3><br> " + suppForm + "</div>");
                console.log(data);
            } else
            {
                //handle errors
            }
        });
};


//get single customer to populate edit cust modal. (customerController.php/getSingleCustomer()).
function editCust(id){
    $.getJSON("customers/singleCustomer",{
        queryString: id
    }, 
        function(data){
        if(data.length > 0 && typeof(data) != 'undefined'){
            var token = "{{ csrf_token() }}";
            var custForm = "<button class='uk-modal-close' type='button' style='float: right' uk-close></button><br><div class='alert alert-danger' id='requiredFields' hidden>\n\
                            <p>The following fields are required before the account can be created.</p>\n\
                            </div>\n\
                            <div id='issueDrops'>\n\
                            <form class='uk-grid-small uk-form-horizontal' method='post' uk-grid action='/editCustomer' >\n\
                            <ul class='uk-subnav uk-subnav-pill' uk-switcher>\n\
                                <li><a href='#'>Customer Information</a></li>\n\
                                <li><a href='#'>System Information</a></li>\n\
                                <li><a href='#'>Accounts Information</a></li>\n\
                                <li><a href='#'>Wholesaler Link Information</a>\n\
                            </ul>\n\
                <ul class='uk-switcher uk-margin'   style='width: 100%'>\n\
                    <li>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Account Code</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].CustCode + "' +  +'' value='" + data[0].CustCode + "' name='code' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Company Name</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].CustName + "' name='companyName' value='" + data[0].CustName + "' required>\n\
                            </div>\n\
                        </div><br>\n\
                        \n\<input type='hidden' name='id' value='" + id + "'\n\
                        <br>\n\
                        <input type='hidden' name='_token' value='" + token + "'>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Street 1</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].Street1 + "' name='street1'  value='" + data[0].Street1 + "'required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Street 2</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].Street2 + "' name='street2' value='" + data[0].Street2 + "' >\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Town</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].Town + "' name='town' value='" + data[0].Town + "' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>County</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].County + "' value='" + data[0].County + "' name='county' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Postcode</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].Postcode + "' value='" + data[0].Postcode + "' name='postcode' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Main Phone</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].MainPhone + "' value='" + data[0].MainPhone + "' name='mainphone' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Fax</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].Fax + "' value='" + data[0].Fax + "' name='fax' >\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Main Email</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='email' placeholder='" + data[0].MainEmail + "' value='" + data[0].MainEmail + "' name='mainemail' required>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Comments</label>\n\
                            <div class='uk-form-controls'>\n\
                                <textarea class='uk-textarea' rows='6' placeholder='" + data[0].Comments + "' value='" + data[0].Comments + "' name='comments' ></textarea>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Install Date</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='date' placeholder='" + data[0].InstallDate + "' value='" + data[0].InstallDate + "' name='install' >\n\
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
                                <input class='uk-checkbox' type='checkbox' name='stock'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>PulseStore?</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-checkbox' type='checkbox' name='pulseStore'>\n\
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
                                <input class='uk-input' type='text' placeholder='" + data[0].PulseVersion + "'  value='" + data[0].PulseVersion + "' name='pulseVersion'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>OPXML PC</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].OPXMLPC + "' value='" + data[0].OPXMLPC + "' name='opxmlpc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Sage PC</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].SageLinkPC + "' value='" + data[0].SageLinkPC + "' name='sagepc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>PulseLink PC</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].PulseLinkPC + "' value='" + data[0].PulseLinkPC + "' name='pulselinkpc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Sage Version #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].SageVersion + "' value='" + data[0].SageVersion + "'  name='sagenum'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>PulseStore Shop #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].PulseStoreShopNumber + "' value='" + data[0].PulseStoreShopNumber + "'  name='pulsestorenumber'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>PulseStore Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].PulseStorePassword + "' value='" + data[0].PulseStorePassword + "'  name='pulsestorepassword'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Special Upgrade Requirements</label>\n\
                            <div class='uk-form-controls'>\n\
                                <textarea class='uk-textarea' rows='6' placeholder='" + data[0].SpecialUpgradeNotes + "' value='" + data[0].SpecialUpgradeNotes + "'  name='upgradeNotes' ></textarea>\n\
                            </div>\n\
                        </div>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Network Details</label>\n\
                            <div class='uk-form-controls'>\n\
                                <textarea class='uk-textarea' rows='6' placeholder='" + data[0].NetworkDetails + "' value='" + data[0].NetworkDetails + "'  name='network' ></textarea>\n\
                            </div>\n\
                        </div>\n\
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
                                <input class='uk-input' type='date' placeholder='" + data[0].DatePaidTo + "' value='" + data[0].DatePaidTo + "' name='paidto'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Licence Notes</label>\n\
                            <div class='uk-form-controls'>\n\
                                <textarea class='uk-textarea' rows='6' placeholder='" + data[0].LicenceNotes + "' value=''  name='licenceNotes' ></textarea>\n\
                            </div>\n\
                        </div>\n\
                    </li>\n\
                    <li>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Vow Account #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].VowAccNo + "' value='" + data[0].VowAccNo + "'  name='vowacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Vow Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].VowPasword + "' value='" + data[0].VowPassword + "'  name='vowpass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Vow Discount %</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='number' min='0' max='100' placeholder='" + data[0].VowDiscount + "' value='" + data[0].VowDiscount + "' name='vowdisc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Spicer Account #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].SpicerAccNo + "' value='" + data[0].SpicerAccNo + "' name='spicacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Spicers Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].SpicerPassword + "' " + data[0].SpicerPassword + "  name='spicpass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Antalis Account #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].AntalisAccNo + "' value='" + data[0].AntalisAccNo + "' name='antacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Antalis Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].AntalisPassword + "' value='" + data[0].AntalisPassword + "'  name='antpass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Truline Account #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].TrulineAccNo + "' value='" + data[0].TrulineAccNo + "' name='truacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Truline Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].TrulinePassword + "' value='" + data[0].TrulinePassword + "'  name='trupass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Beta Account</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].BeteAccNo + "' value='" + data[0].BetaAccNo + "'  name='betaacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Beta Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].BetaPassword + "' value='" + data[0].BetaPassword + "' name='betapass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Exertis Account #</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].ExertisAccNo + "' value='" + data[0].ExertisAccNo + "' name='exertacc'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Exertis Password</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].ExertisPassword + "' value='" + data[0].ExertisPassword + "'  name='exertpass'>\n\
                            </div>\n\
                        </div>\n\
                        <br>\n\
                        <div class='uk-width-1-2@s'>\n\
                            <label class='uk-form-label' for='form-horizontal-text'>Buying Group</label>\n\
                            <div class='uk-form-controls'>\n\
                                <input class='uk-input' type='text' placeholder='" + data[0].BuyingGroup + "' value='" + data[0].BuyingGroup + "' name='buyinggroup'>\n\
                            </div>\n\
                        </div>\n\
                    </li>\n\
                </ul>\n\
                <br>\n\
                <input type='submit' class='btn btn-primary' value='save' >\n\
            </form>\n\
            </div>\n\ ";            
            UIkit.modal.alert("<div id='editCustForm'><h3 style='text-align: center;'>Editing customer : " + data[0].CustName + "</h3><br> " + custForm + "</div>");
            $('.uk-modal-dialog').css('width','80%');
            if(data[0].PulseStore == 1){
                $("input[name='pulseStore']").prop('checked', true);
            }
            if(data[0].hosted == 1){
                $("input[name='hosted']").prop('checked', true);
            }
            if(data[0].StockControl == 0){
                $("input[name='stock']").prop('checked', true);
            }
            $('.uk-modal-footer').hide(); 
            if(data[0].TerminalServer == 1){
                $("input[name='terminalserver']").prop('checked', true);
            }
        } else {
           //made a whoops
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


