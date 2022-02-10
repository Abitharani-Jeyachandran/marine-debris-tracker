<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use Kreait\Firebase\ServiceAccount;
use kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Firestore\FirestoreClient;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use Kreait\Firebase\Auth\CreateSessionCookie\FailedToCreateSessionCookie;
use Auth;
use Session;
use Validator;

class ProfileController extends Controller
{
    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    protected function otherValidator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
        ]);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $data = $this->auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);
        $uid = Session::get('uid');
        $user = $this->auth->getUser($uid);
        return view('users.profile',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();
        $user = $this->auth->getUser($id);
        $newPassword = $request->password;

        $updatedUser = $this->auth->changeUserPassword($id, $newPassword);
        if($updatedUser){
            toastr()->success('User Profile Updated successfully');
            return redirect()->route('profile.index');
        }else{
            toastr()->error('User Profile could not be Updated');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {

    }

    public function updateDetails(Request $request,$id){
        $this->otherValidator($request->all())->validate();
        $user = $this->auth->getUser($id);
        $data = [
            'displayName' => $request->name
        ];
        $updatedUser = $this->auth->updateUser($id, $data);
        if($updatedUser){
            toastr()->success('User Profile Updated successfully');
            return redirect()->route('profile.index');
        }else{
            toastr()->error('User Profile could not be Updated');
            return back();
        }
    }
}
