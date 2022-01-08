<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Country;
use GuzzleHttp\Client;
use DB;
//$tests = DB::select('SELECT * from tests');

class TestsController extends Controller
{
    public function index(){
        $tests = Test::orderBy('title', 'asc')->paginate(10);
        return view('tests.index')->with('tests', $tests);
    }
    public function create(){
        return view('tests.create');
    }
    public function store(Request $request){

    }
    public function edit($id){

    }
    public function update(Request $request, $id){

    }
    public function destroy($id){

    }
    public function show($id){
        $test = Test::find($id);
        return view('tests.show')->with('test', $test);
    }

    public function getCountries(){
        $headers = [
            'X-CSCAPI-KEY' => 'WFQ5VnRZQ1NtM3FzcmxlRmlpY1RTbzFVdTNxbVE5ZkRTSzNHTWFNOA==',
        ];
        $client = new Client([
            'headers'=> $headers
        ]
        );
        $r = $client->request('GET', 'https://api.countrystatecity.in/v1/countries');
        $response = $r->getBody()->getContents();
        return $response;
     
    }

    public function flagsMultiple(){
        $countries = DB::table('countries')->get();
        $data = array();
        $data['countries'] =  $countries;

        // $countryId = rand(0, count($countries)-1);
        // $countryIso = strtolower($countries[$countryId]->code);
        // $data['iso'] = $countryIso;
        return view('tests.flags')->with('data',$data);
    }
    public function capitals(){
        $countries = DB::table('countries')->get();
        $data = array();
        $data['countries'] =  $countries;

        return view('tests.capitals')->with('data',$data);
    }
    public function countries(){
        $countries = DB::table('countries')->get();
        $data = array();
        $data['countries'] =  $countries;

        return view('tests.countries')->with('data',$data);
    }
    public function flagsUpdate(Request $request){
        $nonGuessedCountryIso = json_decode($request->nonGuessedCountries, false);
        if($nonGuessedCountryIso == 0){
            $countriesInfo = array();
            return view('tests.flagsResults')->with('countries',$countriesInfo);
        }
        else{
            $countriesInfo = array();
            foreach($nonGuessedCountryIso as $iso){
                $countries = DB::table('countries')->where('code', $iso)->get();
                $countriesInfo[strtolower($iso)] = $countries[0]->name;
            }
            return view('tests.flagsResults')->with('countries',$countriesInfo);
        }
        
    }
    public function capitalsGuess(){
        
    }
}
