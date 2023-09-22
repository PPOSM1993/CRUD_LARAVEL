<div class="container">
    <h1 class="text-center text-uppercase">{{ $mode }}</h1>


    @if (count($errors) > 0)

        <div class="alert alert-danger" role="alert">
            <ul>

                @foreach ($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach

            </ul>
        </div>

    @endif


    <div class="form-group">
        <label for="FirstName">First Name</label>
        <input type="text" name="FirstName" placeholder="First Name" id="FirstName" class="form-control form-control-sm"
            value="{{ isset($employee->FirstName) ? $employee->FirstName:old('FirstName') }}">
        <br>
    </div>

    <div class="form-group">
        <label for="LastName">Last Name</label>
        <input type="text" name="LastName" placeholder="Last Name" id="LastName"
            class="form-control form-control-sm" value="{{ isset($employee->LastName) ? $employee->LastName:old('LastName') }}">
        <br>
    </div>
    <div class="form-group">
        <label for="Email">Email</label>
        <input type="text" name="Email" placeholder="Email" id="Email" class="form-control form-control-sm"
            value="{{ isset($employee->Email) ? $employee->Email:old('Email') }}">
        <br>
    </div>

    <div class="form-group">
        <label for="Picture"></label>
        @if (isset($employee->Picture))
            <img src="{{ asset('storage') . '/' . $employee->Picture }}" alt="" width="100"
                class="img-thumbnail img-fluid">
            <br>
            <br>
        @endif
        <input type="file" name="Picture" id="Picture" value="" class="form-control form-control-sm">
        <br>
    </div>
    <input type="submit" value="{{ $mode }}" class="btn btn-success btn-sm">
    <a class="btn btn-primary btn-sm" href="{{ url('/employee') }}">Back List</a>
    <br>
</div>
