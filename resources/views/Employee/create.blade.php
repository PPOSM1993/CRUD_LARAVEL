@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{ url('/employee') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('Employee.form', ['mode' => 'Create New Employee'])
    
    </form>
</div>

@endsection
