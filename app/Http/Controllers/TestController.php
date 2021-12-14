<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use Kreait\Firebase\ServiceAccount;
use kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Firestore\FirestoreClient;

class TestController extends Controller
{
    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
        $this->collection = 'students';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->firestore->database()->collection($this->collection)->documents();
        return view('tests.index',compact("students"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
        ];

        // Create a key for a new post
        $student = $this->firestore->database()->collection($this->collection)->add($data);
        if($student){
            toastr()->success('Student added successfully');
            return redirect()->route('test.index');
        }else{
            toastr()->error('Student could not be added');
            return redirect()->route('test.index');
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
        $snapshot = $this->firestore->database()->collection($this->collection)->document($id)->snapshot();
        $student= $snapshot->data();
        if($student){
            return view('tests.view',compact('student'));
        }else{
            toastr()->error('Resource not found.');
            return redirect()->route('test.index');
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
        $snapshot = $this->firestore->database()->collection($this->collection)->document($id)->snapshot();
        $student= $snapshot;
        $studentData = $snapshot->data();
        if($student){
            return view('tests.edit',compact('student','studentData'));
        }else{
            toastr()->error('Resource not found.');
            return redirect()->route('test.index');
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
        $updateData = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
        ];

        $updatedStudent = $this->firestore->database()->collection($this->collection)->document($id)->set($updateData);

        if($updatedStudent){
            toastr()->success('Student updated successfully');
            return redirect()->route('test.index');
        }else{
            toastr()->error('Student could not be updated');
            return redirect()->route('test.index');
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
        $snapshot = $this->firestore->database()->collection($this->collection)->document($id)->delete();
        if($snapshot){
            toastr()->success('Student deleted successfully');
            return redirect()->route('test.index');
        }else{
            toastr()->error('Student could not be deleted');
            return redirect()->route('test.index');
        }
    }
}
