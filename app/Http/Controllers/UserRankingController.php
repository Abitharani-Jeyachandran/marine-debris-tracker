<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\UserRanking;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use Kreait\Firebase\ServiceAccount;
use Google\Cloud\Firestore\FirestoreClient;
use kreait\Laravel\Firebase\Facades\Firebase;

class UserRankingController extends Controller
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
        foreach($users as $key => $value){
            $data = array('user'=> $value['name'], 'count' => 0 );
            $userHostedevents = $this->firestore->database()->collection('event_data')->where('host', 'array-contains',$value->id())->documents();
            foreach ($userHostedevents as $doc) {
                $data['count'] =  $data['count'] + 1;
            }

            $datas[] = $data;
        }
        $count = array_column($datas, 'count');
        array_multisort($count, SORT_DESC, $datas);
        return view('user-rankings.index',compact('datas'));
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
     * @param  \App\Models\UserRanking  $userRanking
     * @return \Illuminate\Http\Response
     */
    public function show(UserRanking $userRanking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserRanking  $userRanking
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRanking $userRanking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserRanking  $userRanking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRanking $userRanking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRanking  $userRanking
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRanking $userRanking)
    {
        //
    }
}
