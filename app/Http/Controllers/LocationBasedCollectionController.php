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

class LocationBasedCollectionController extends Controller
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
        $events = $this->firestore->database()->collection($this->collection)->documents();
        $locationBasedDatas = array("Bags"=>0 , "Bottles"=>0 , "Containers"=>0 , "Others" => 0);
        $docDatas = [];
        $count = 0;
        foreach($events as $event){
            $dataOfEvent = $event->data();
            $locationBasedDatas = array("Location" => $dataOfEvent['location'], "Bags"=>0 , "Bottles"=>0 , "Containers"=>0 , "Others" => 0);
            $locationBasedDatas['Bags'] = $locationBasedDatas['Bags'] + ((int)$dataOfEvent['bag_count']);
            $locationBasedDatas['Bottles'] = $locationBasedDatas['Bottles'] + ((int)$dataOfEvent['bottle_count']);
            $locationBasedDatas['Containers'] = $locationBasedDatas['Containers'] + ((int)$dataOfEvent['container_count']);
            $locationBasedDatas['Others'] = $locationBasedDatas['Others'] + ((int)$dataOfEvent['other_count']);

            $docDatas[] = $locationBasedDatas;
            $count++;
        }
        $result1 = array();
        foreach ($docDatas as $element) {
            $result1[$element['Location']][] = $element;
        }

        $result2 = array();
        foreach($result1 as $key => $values){
            $result2 = array("Bags"=>0 , "Bottles"=>0 , "Containers"=>0 , "Others" => 0);
            foreach($values as $value){
                $result2['Bags'] = $result2['Bags'] + ((int)$value['Bags']);
                $result2['Bottles'] = $result2['Bottles'] + ((int)$value['Bottles']);
                $result2['Containers'] = $result2['Containers'] + ((int)$value['Containers']);
                $result2['Others'] = $result2['Others'] + ((int)$value['Others']);
            }
            $datas[$key] = $result2;
        }
        // dd($datas);
        // dd('doc-count - ',$count, 'docdata-', $docDatas, 'L1-sorted-',$result1, 'L2-sorted',$datas);
        return view('location-collections.index',compact('datas'));
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
     * @param  \App\Models\LocationBasedCollection  $locationBasedCollection
     * @return \Illuminate\Http\Response
     */
    public function show(LocationBasedCollection $locationBasedCollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationBasedCollection  $locationBasedCollection
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationBasedCollection $locationBasedCollection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LocationBasedCollection  $locationBasedCollection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LocationBasedCollection $locationBasedCollection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationBasedCollection  $locationBasedCollection
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationBasedCollection $locationBasedCollection)
    {
        //
    }
}
