$(document).ready(function(){

    function refreshTable() {
        $('.dataTable').each(function() {
            dt = $(this).dataTable();
            dt.fnDraw();
        })
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })


    // insert a record 

    $('#btnAddStudent').click(function(e){
        e.preventDefault();
        var formData = {
            fname: $('#fname').val(),
            lname: $('#lname').val()
        };
        var url = "/students/add";
    
        $.ajax({
            method:'POST',
            data: formData,
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response){
            $('#addModal').modal('hide');
            Toast.fire({
                icon: 'success',
                title: response.success
            })
            $('#formAdd').trigger("reset");
            refreshTable();
            },
            error: function(error){
            console.log('error');
            }
        })
    });

    // fire a modal with fields

    $('body').on('click', '.editbtn', function () {
        $('#editModal').modal('show');

        var user_id = $(this).data('id');
        
        $.get('students/' + user_id + '/edit', function(data){
            $('#id').val(data.id);
            $('#editfname').val(data.fname);
            $('#editlname').val(data.lname);
        })
    });

    // delete a record

    $('body').on('click', '.deletebtn', function(){
        var stud_id = $(this).data('id');
        
        $.ajax({
          method: 'DELETE',
          url: '/students/delete/'+stud_id,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function(response){
            Toast.fire({
              icon: 'success',
              title: response.success
            })
            refreshTable();
          },
          error: function(error){
            console.log('null');
          }
        })
    })



    //update record

    $('body').on('click','#btnUpdateStudent', function(e){
        e.preventDefault();
  
        var formData = {
          fname: $('#editfname').val(),
          lname: $('#editlname').val()
        }
        var user_id = $('#id').val();
        // console.log(user_id,formData);
  
        var url = '/students/update/'+user_id;
  
        // console.log(url);
  
        $.ajax({
          type: 'put',
          url: url,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: formData,
          success: function(response){
            $('#editModal').modal('hide');
            Toast.fire({
              icon: 'success',
              title: response.success
            })
            refreshTable();
          },
          error: function(response){
            console.log(error)
          }
        })
    })
})