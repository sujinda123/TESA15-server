<?php

namespace App\Http\Controllers;

use App\Models\Lemon;
use Illuminate\Http\Request;

use App\Models\SocketIO;


class LemonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Lemon::get();
    }

    public function getLast()
    {
        return Lemon::latest()->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $lemons = new Lemon();

        $lemons->good_lemon = $req->input('good_lemon');
        $lemons->bad_lemon = $req->input('bad_lemon');
        $lemons->small_lemon = $req->input('small_lemon');
        $lemons->medium_lemon = $req->input('medium_lemon');
        $lemons->big_lemon = $req->input('big_lemon');

        $lemons->save();
        
        return response()->json($lemons);
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
     * @param  \App\Models\Lemon  $lemon
     * @return \Illuminate\Http\Response
     */
    public function show($lemon)
    {
        return Lemon::where('ID', $lemon)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lemon  $lemon
     * @return \Illuminate\Http\Response
     */
    public function edit(Lemon $lemon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lemon  $lemon
     * @return \Illuminate\Http\Response
     */

    

    public function update(Request $request)
    {
        // require_once 'SocketIO.php';
        $client = new SocketIO(env('HOST_SOCKET_IO'), 3001);
        $client->setQueryParams([
            'token' => 'edihsudshuz',
            'id' => '8780',
            'cid' => '344',
            'cmp' => 2339
        ]);
        
        $lemons_last = Lemon::latest()->first();
        $lemons = Lemon::find($lemons_last['id']);

        if($request->good_lemon == 1){
            $lemons->good_lemon = $lemons_last['good_lemon'] + $request->good_lemon;
            $client->emit('msgUpdate_good_lemon', $lemons->good_lemon);
        }
        if($request->bad_lemon == 1){
            $lemons->bad_lemon = $lemons_last['bad_lemon'] + $request->bad_lemon;
            $client->emit('msgUpdate_bad_lemon', $lemons->bad_lemon);
        }
        if($request->small_lemon == 1){
            $lemons->small_lemon = $lemons_last['small_lemon'] + $request->small_lemon;
            $client->emit('msgUpdate_small_lemon', $lemons->small_lemon);
        }
        if($request->medium_lemon == 1){
            $lemons->medium_lemon = $lemons_last['medium_lemon'] + $request->medium_lemon;
            $client->emit('msgUpdate_medium_lemon', $lemons->medium_lemon);
        }
        if($request->big_lemon == 1){
            $lemons->big_lemon = $lemons_last['big_lemon'] + $request->big_lemon;
            $client->emit('msgUpdate_big_lemon', $lemons->big_lemon);
        }
        
        $lemons->save();

        $client->emit('msgUpdate_updated_at', date("Y-m-d H:i:s",strtotime($lemons_last['updated_at'])));

        $total_month = Lemon::whereMonth('created_at', date("m"))->sum(Lemon::raw('small_lemon + medium_lemon + big_lemon'));
        $total_day = Lemon::whereDay('created_at', date("d"))->sum(Lemon::raw('small_lemon + medium_lemon + big_lemon'));
        $total_good = Lemon::whereDay('created_at', date("d"))->sum(Lemon::raw('good_lemon'));
        $total_bad = Lemon::whereDay('created_at', date("d"))->sum(Lemon::raw('bad_lemon'));

        $client->emit('msgUpdate_total_month', $total_month);
        $client->emit('msgUpdate_total_day', $total_day);
        $client->emit('msgUpdate_total_good', $total_good);
        $client->emit('msgUpdate_total_bad', $total_bad);

        return response()->json($lemons);
    }
    public function checkUpdate()
    {
        $lemons_last = isset(Lemon::latest()->first('created_at')['created_at']) ? Lemon::latest()->first('created_at')['created_at'] : null;
        if(date("Y-m-d",strtotime($lemons_last)) == date("Y-m-d"))
            return 1;
        else
            return 0;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lemon  $lemon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lemon $lemon)
    {
        //
    }
}
