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

class ZoneController extends Controller
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

        foreach($datas as $key => $values){
            $result3 = array('total' => 0);
            $result3['total'] = ((int)$values['Bags']) + ((int)$values['Bottles']) + ((int)$values['Containers']) + ((int)$values['Others']);
            $tdatas[$key] = $result3; //location based total collection
        }

        foreach($result1 as $key => $values){
            $tdatas[$key]['count'] = count($values); //moment counts
        }

        $remove = array_shift($tdatas);
        foreach($tdatas as $key => $value){
            $final[$key]= $value['total'] / ($value['count'] * 100);
        }

        $reds = array();
        $blues = array();
        foreach($final as $key => $value){
            if($value < 60){
                $blues[] = $key . ' - ' .$value.' %';
            }else{
                $reds[] = $key . ' - ' .$value.' %';
            }
        }
        return view('zones.index',compact('reds','blues'));
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
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        //
    }
}
