<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Database;
use Session;

class StudentController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'students';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->database->getReference($this->tablename)->getValue();
        return view('students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postData = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
        ];

        // Create a key for a new post
        $newPostKey = $this->database->getReference($this->tablename)->push($postData);
        if($newPostKey){
            toastr()->success('Student added successfully');
            return redirect()->route('students.index');
        }else{
            toastr()->error('Student could not be added');
            return redirect()->route('students.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $key = $id;
        $student = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($student){
            return view('students.view',compact('student'));
        }else{
            toastr()->error('Resource not found.');
            return redirect()->route('students.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $key = $id;
        $student = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($student){
            return view('students.edit',compact('student','key'));
        }else{
            toastr()->error('Resource not found.');
            return redirect()->route('students.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $key = $id;
        $updateData = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
        ];

        $updatedStudent = $this->database->getReference($this->tablename.'/'.$key)->update($updateData);
        if($updatedStudent){
            toastr()->success('Student updated successfully');
            return redirect()->route('students.index');
        }else{
            toastr()->error('Student could not be updated');
            return redirect()->route('students.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $key = $id;
        $deletedStudent = $this->database->getReference($this->tablename.'/'.$key)->remove();
        if($deletedStudent){
            toastr()->success('Student deleted successfully');
            return redirect()->route('students.index');
        }else{
            toastr()->error('Student could not be deleted');
            return redirect()->route('students.index');
        }
    }
}
