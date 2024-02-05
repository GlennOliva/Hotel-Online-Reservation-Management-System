$(document).ready(function(){


    $('.delete_adminbtn').click(function (e){
        e.preventDefault();

     
        var id = $(this).val();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'admin_id': id,
                    'delete_adminbtn': true
                },
                success: function(response)
                {
                    if(response == 200)
                    {
                        swal("Success!","Admin Successfully delete" , "success");
                        $("#admin_table").load(location.href + " #admin_table");
                    }
                    else if (response == 500){
                        swal("Error!","Failed to delete" , "error");
                    }
                }
              });
            }
          });
    });


  
  

    
    
    





});





