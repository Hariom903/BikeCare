@extends('layout.app')
@section('main')
    <div class="container p-4 shadow bg-light rounded-4 ">

        <h3> User Manage Hare..! </h3>
        <div class="container p-4 shadow bg-body">
            <form action="{{ route('updateuser', $user->id) }}" method="POST">
                @csrf
                <h3>Edit User Info </h3>
                <div class="row">
                    <div class="col-sm-6 col-12 mb-2">
                        <label for="name" class="form-label"> Name: </label>
                        <input type="text" name='name' value="{{ $user->name }}" class="form-control">
                    </div>
                    <div class="col-sm-6 col-12 mb-2">
                        <label for="email" class="form-label"> Email: </label>
                        <input type="email" readonly value="{{ $user->email }}" class="form-control">
                    </div>
                    <div class="col-sm-6 col-12 mb-2">
                        <label for="role" class="form-label">Role: </label>
                        <select class="form-control" name="role" id="role">
                            <option selected value="{{ $user->role }}"> {{ ucfirst($user->role) }}</option>
                            @foreach ($roles as $role)
                                @if ($user->role == $role)
                                    @continue
                                @endif
                                <option value="{{ $role }}"> {{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6  mb-2 col-12">
                        <label for="franchises" class="form-label">Franchises :</label>
                        <select name="franchises" class="form-control" id="franchises">
                            
                            @foreach ($franchises as $franchise)
                                <option value="{{ $franchise->id }}"
                                    {{ $user->franchises_id == $franchise->id ? 'selected' : '' }}>
                                    {{ ucfirst($franchise->location) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-2 text-center">
                        <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-user-pen "> </i> Edit User
                        </button>
                        <a href="{{ route('deleteuser', $user->id) }}" class="btn btn-danger"> <i
                                class="fa-solid fa-trash"></i> Delete User </a>
                    </div>




                </div>
            </form>
        </div>

    </div>
@endsection
