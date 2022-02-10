<?php

namespace App\Http\Controllers;

use App\Models\EventData;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use Kreait\Firebase\ServiceAccount;
use kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Firestore\FirestoreClient;

class EventDataController extends Controller
{
    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
        $this->collection = 'event_data';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event_datas = $this->firestore->database()->collection($this->collection)->documents();
        dd($event_datas);
        // return view('tests.index',compact("students"));
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
     * @param  \App\Models\EventData  $eventData
     * @return \Illuminate\Http\Response
     */
    public function show(EventData $eventData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventData  $eventData
     * @return \Illuminate\Http\Response
     */
    public function edit(EventData $eventData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventData  $eventData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventData $eventData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventData  $eventData
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventData $eventData)
    {
        //
    }
}
