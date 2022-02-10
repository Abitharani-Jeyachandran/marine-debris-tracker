<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use Session;

class AdminController extends Controller
{
    use RegistersUsers;
    protected $auth;


    public function __construct(FirebaseAuth $auth) {
        $this->auth = $auth;
    }

    protected function validator(array $data) {
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed']
    ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);
        return view('admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validator($request->all())->validate();
            $userProperties = [
               'email' => $request->input('email'),
               'emailVerified' => false,
               'password' => $request->input('password'),
               'displayName' => $request->input('name'),
               'disabled' => false,
            ];
            $createdUser = $this->auth->createUser($userProperties);
            toastr()->success('Admin added successfully');
            return redirect()->route('admin.index');
        } catch (FirebaseException $e) {
            toastr()->error('Admin could not be added');
            return redirect()->route('admin.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $uid = $id;
        $admin = $this->auth->getUser($uid);
        return view('admin.view',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $snapshot = $this->firestore->database()->collection($this->collection)->document($id)->delete();
        // if($snapshot){
        //     toastr()->success('Admin deleted successfully');
        //     return redirect()->route('users.index');
        // }else{
        //     toastr()->error('Admin could not be deleted');
        //     return redirect()->route('users.index');
        // }

        try {
            $uid = $id;
            $this->auth->deleteUser($uid);
            toastr()->success('Admin deleted successfully');
            return redirect()->route('admin.index');
        } catch (FirebaseException $e) {
            toastr()->error('Admin could not be deleted');
            return redirect()->route('admin.index');
        }
    }
}
