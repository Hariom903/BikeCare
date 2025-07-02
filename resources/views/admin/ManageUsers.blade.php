@extends('layout.app')
@section('main')
    <div class="container pt-4">

        <div class="container pt-4 pb-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddUserModal">
                Add User
            </button>

            <!-- Modal -->
            <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="AddUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="AddUserModalLabel"> Add User </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <label for="name" class="form-lable"> Name </label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter User Name">
                                            <div class="error" id="nameerror" >
                                            </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <label for="email" class="form-lable"> Email </label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter User Name">
                                            <div class="error" id="emailerror"> </div>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <label for="role" class="form-lable"> Role </label>
                                        <select class="form-control" name="role" id="role">
                                            <option disabled selected >-select User Role-</option>


                                            <option value=" serviceManager">  serviceManager</option>
                                            <option value=" technician">  technician</option>
                                            <option value=" receptionist">  receptionist</option>
                                            <option value=" inventoryManager">  inventoryManager</option>
                                            <option value=" picupAgent">  picupAgent</option>
                                            <option value=" accountant">  accountant</option>

                                        </select>
                                        <div class="error"  id="roleerror" > </div>
                                    </div>
                                    <div class="pt-3 text-center pb-3">
                                        <button class="btn btn-primary" id="addUser" type="button"> Add User </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <table class="table display" id="UserTable">

            <thead>
                <tr>
                    <th> Name </th>
                    <th> Email </th>
                    <th> Role </th>
                    <th> Oprations </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td> {{ $user->name }} </td>
                        <td> {{ $user->email }} </td>
                        <td> {{ $user->role }} </td>
                        <td>
                            <a href="" class="btn btn-info"><i class="fa-solid fa-eye"></i> Manage User  </a>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>


        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#UserTable').DataTable();
        });

        $('#addUser').click(()=>{

            var name=  document.getElementById('name').value;
            var email=  document.getElementById('email').value;
            var role=  document.getElementById('role').value;

            $.ajax({
                  url:"{{route('adduser')}}",
                  type:"POST",
                  data:{
                    'name':name,
                    'email':email,
                    'role':role,
                    '_token':'{{ csrf_token()  }}'
                  },
                  success: (res)=>{
                   if(res.success){

                      $('#AddUserModal').hide();
                      window.location.reload();


                   }

                  },
                  error:(xhr, status, error)=>{
                   var errors =  xhr.responseJSON.errors;
                   if(errors.name)
                   var nameerror = document.getElementById('nameerror').innerHTML = errors.name[0];
                   if(errors.email)
                   document.getElementById('emailerror').innerHTML = errors.email[0];
                    if(errors.role)
                   document.getElementById('roleerror').innerHTML = errors.role[0];

                  },

            });

        });

    </script>
@endsection
