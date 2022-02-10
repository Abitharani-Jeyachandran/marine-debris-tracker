<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use Kreait\Firebase\ServiceAccount;
use kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Firestore\FirestoreClient;

class UserController extends Controller
{
    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
        $this->collection = 'users';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  $this->firestore->database()->collection($this->collection)->documents();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'is_notification_available' => 'FALSE',
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'profile_picture_ref_path' => $request->profile_picture_ref_path ?  $request->profile_picture_ref_path : null,
            'profile_picture_url' => $request->profile_picture_url ?  $request->profile_picture_url : null,
        ];

        // Create a key for a new post
        $user = $this->firestore->database()->collection($this->collection)->add($postData);
        if($user){
            toastr()->success('User added successfully');
            return redirect()->route('users.index');
        }else{
            toastr()->error('User could not be added');
            return redirect()->route('users.index');
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
        $user= $snapshot->data();

        $collections = $this->firestore->database()->collection('event_data')->where('host', 'array-contains',$id)->documents();
        $datas = array("Bags"=>0 , "Bottles"=>0 , "Containers"=>0 , "Others" => 0);

        foreach($collections as $key => $value){
            $dataOfValue = $value->data();
            $datas['Bags'] = $datas['Bags'] + ((int)$dataOfValue['bag_count']);
            $datas['Bottles'] = $datas['Bottles'] + ((int)$dataOfValue['bottle_count']);
            $datas['Containers'] = $datas['Containers'] + ((int)$dataOfValue['container_count']);
            $datas['Others'] = $datas['Others'] + ((int)$dataOfValue['other_count']);
        }

        if($user){
            return view('users.view',compact('user','datas'));
        }else{
            toastr()->error('Resource not found.');
            return redirect()->route('users.index');
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
        $user= $snapshot;
        $userData = $snapshot->data();
        if($user){
            return view('users.edit',compact('user','userData'));
        }else{
            toastr()->error('Resource not found.');
            return redirect()->route('users.index');
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
        $postData = [
            'is_notification_available' => 'FALSE',
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'profile_picture_ref_path' => $request->profile_picture_ref_path ?  $request->profile_picture_ref_path : null,
            'profile_picture_url' => $request->profile_picture_url ?  $request->profile_picture_url : null,
        ];

        $updatedUser = $this->firestore->database()->collection($this->collection)->document($id)->set($postData);

        if($updatedUser){
            toastr()->success('User updated successfully');
            return redirect()->route('users.index');
        }else{
            toastr()->error('User could not be updated');
            return redirect()->route('users.index');
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
            toastr()->success('User deleted successfully');
            return redirect()->route('users.index');
        }else{
            toastr()->error('User could not be deleted');
            return redirect()->route('users.index');
        }
    }
}
