<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use Kreait\Firebase\ServiceAccount;
use kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Firestore\FirestoreClient;


class CategoryWiseCollectionController extends Controller
{
    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
        $this->collection = 'collections';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = $this->firestore->database()->collection($this->collection)->documents();
        return view('collections.index',compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required',
            'quantity' => 'required',
        ]);

        // Create a key for a new post
        $collection = $this->firestore->database()->collection($this->collection)->add($validated);
        if($collection){
            toastr()->success('Collection added successfully');
            return redirect()->route('collections.index');
        }else{
            toastr()->error('Collection could not be added');
            return redirect()->route('collections.index');
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
        $collection= $snapshot->data();
        if($collection){
            return view('collections.view',compact('collection'));
        }else{
            toastr()->error('Resource not found.');
            return redirect()->route('collections.index');
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
        $collection= $snapshot;
        $collectionData = $snapshot->data();
        if($collection){
            return view('collections.edit',compact('collection','collectionData'));
        }else{
            toastr()->error('Resource not found.');
            return redirect()->route('collections.index');
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
        $validated = $request->validate([
            'category' => 'required',
            'quantity' => 'required',
        ]);

        $updatedCollection = $this->firestore->database()->collection($this->collection)->document($id)->set($validated);

        if($updatedCollection){
            toastr()->success('Collection updated successfully');
            return redirect()->route('collections.index');
        }else{
            toastr()->error('Collection could not be updated');
            return redirect()->route('collections.index');
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
        dd($id);
        $snapshot = $this->firestore->database()->collection($this->collection)->document($id)->delete();
        if($snapshot){
            toastr()->success('Collection deleted successfully');
            return redirect()->route('collections.index');
        }else{
            toastr()->error('Collection could not be deleted');
            return redirect()->route('collections.index');
        }
    }

    public function chart(){
        $collections = $this->firestore->database()->collection($this->collection)->documents();
        $datas = [];
        foreach ($collections as $key=>$value){
            $datas[$value['category']] = $value['quantity'];
        }
        return view('collections.chart',compact('datas'));
    }
}
