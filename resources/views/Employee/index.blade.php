@extends('layouts.app')

@section('content')
    <div class="container">


        @if (Session::has('message'))
            <div class="container">
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif




        <h1 class="text-uppercase text-center">Employee's List</h1>
        <table class="table table-striped table-inverse table-responsive text-uppercase">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Picture</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>



                <a class="btn btn-success btn-sm" href="{{ url('/employee/create') }}">Create New Employee</a>
                <hr>
                @foreach ($employees as $employee)
                    <tr>
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->FirstName }}</td>
                        <td>{{ $employee->LastName }}</td>
                        <td>{{ $employee->Email }}</td>
                        <td>
                            <img src="{{ asset('storage') . '/' . $employee->Picture }}" alt="" width="100"
                                class="img-thumbnail img-fluid">
                        </td>

                        <td>
                            <a href="{{ url('/employee/' . $employee->id . '/edit') }}"
                                class="btn btn-warning btn-sm">Update</a>

                            <form action="{{ url('/employee/' . $employee->id) }}" method="post" class="d-inline">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="submit" value="Delete" onclick="return('¿Delete this item?')"
                                    class="btn btn-danger btn-sm">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {!! $employees->links() !!}
    </div>
@endsection
