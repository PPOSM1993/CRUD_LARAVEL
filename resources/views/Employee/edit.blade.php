@extends('layouts.app')

@section('content')
<form action="{{ url('/employee/' . $employee->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    @include('Employee.form', ['mode'=>'Update Data'])
</form>
@endsection
