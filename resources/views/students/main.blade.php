<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <title>DataTables</title>
</head>
<body>

<!-- Modal EDIT-->
<div class="modal fade" id="editModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editModal">
            @csrf
            <input type="text" id="id" name="fname" class="form-control" hidden>
              <div class="form-group">
                  <label for="">First Name</label>
                  <input type="text" id="editfname" name="fname" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" id="editlname" name="lname" class="form-control">
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="btnUpdateStudent" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div> 
  {{-- modal --}}

  <!-- Modal ADD-->
<div class="modal fade" id="addModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formAdd">
            {{ csrf_field() }}
              <div class="form-group">
                  <label for="">First Name</label>
                  <input type="text" id="fname" name="fname" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" id="lname" name="lname" class="form-control">
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" id="btnAddStudent" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  {{-- modal --}}

    <div class="container py-3 pb-5">

        <div class="text-right py-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                Add Record
            </button>
        </div>
        <div class="card w-75 m-auto border-0 shadow-lg">
            <div class="card-header">
                <h5>Students</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
<script>
$(document).ready(function(){
    //show DataTables
    $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('get.users') }}"
        },
        columns: [
            { data: 'id', name: 'id'},
            { data: 'fname', name: 'fname'},
            { data: 'lname', name: 'lname'},
            { data: 'action', name: 'action'}
        ]
    });
});
</script>
</body>
</html>