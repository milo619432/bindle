$(document).ready( function () {
    $('#maintables').DataTable();
});

function editUser(){  
  var modal = document.getElementById("#usersRow");
  var firstname = modal.dataset.firstname;
  console.log(firstname);
};


