<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $dates['employees'] = Employee::paginate(2); 
        return view('Employee.index', $dates);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('Employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //

        $campos = [
            'FirstName'=>'required|string|max:100',
            'LastName'=>'required|string|max:100',
            'Email'=>'required|email',
            'Picture'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];


        $message = [
            'required' => 'The :attribute is required',
            'Picture.required' => 'Picture is required'
        ];

        $this ->validate($request, $campos, $message);

        $employeeDate = request()->except('_token');

        if($request->hasFile('Picture')) {
            $employeeDate['Picture'] = $request->file('Picture')->store('uploads', 'public');
        }
        
        Employee::insert($employeeDate);

        return redirect('employee')->with('message', 'Employee Adding success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        //
        $employee = Employee::findOrFail($id);
        return view('Employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {

        $campos = [
            'FirstName'=>'required|string|max:100',
            'LastName'=>'required|string|max:100',
            'Email'=>'required|email',
        ];

        $message = [
            'required' => 'The :attribute is required',
        ];

        if($request->hasFile('Picture')) {
            $campos = ['Picture'=>'required|max:10000 |mimes:jpeg,png,jpg'];
            $message = ['Picture.required' => 'Picture is required'];
        }

        $this ->validate($request, $campos, $message);

        $employeeDate = request()->except(['_token', '_method']);

        if($request->hasFile('Picture')) {
            $employee = Employee::findOrFail($id);
            Storage::delete('public/'.$employee->Picture);
            $employeeDate['Picture'] = $request->file('Picture')->store('uploads', 'public');
        }


        Employee::where('id','=',$id) -> update($employeeDate);
        $employee = Employee::findOrFail($id);

        return redirect('employee')->with('message', 'Employee Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {

        $employee = Employee::findOrFail($id);

        if(Storage::delete('public/'.$employee->Picture)) {
            Employee::destroy($id); 
        }

        return redirect('employee')->with('message', 'Employee Deleted Success');
    }
}
