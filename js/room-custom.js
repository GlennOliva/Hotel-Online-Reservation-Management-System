$(document).ready(function(){



    $('.delete_roombtn').click(function (e){
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
                    'room_id': id,
                    'delete_roombtn': true
                },
                success: function(response)
                {
                    if(response == 400)
                    {
                        swal("Success!","Rooom Successfully delete" , "success");
                        $("#admin_table").load(location.href + " #admin_table");
                    }
                    else if (response == 800){
                        swal("Error!","Failed to delete" , "error");
                    }
                }
              });
            }
          });
    });








});