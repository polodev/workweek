<?php

namespace App\Http\Controllers;

use App\Work;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $start = '';
        $end = '';
        if (request('start')) {
            $start = Carbon::parse(request('start'))->toDateString();
        }
        if (request('end')) {
            $end = Carbon::parse(request('end'))->toDateString();
        }
        $paginate = request('paginate') ?? 30;
        // return request('start');
        $works = Work::filter(request(['topic', 'start', 'end']))->where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate($paginate);
        $hour_array = $works->pluck('hour')->toArray();
        $total_hours = array_sum($hour_array);
        return view('works.index', compact('works', 'total_hours', 'start', 'end'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'topic' => 'required',
            'hour' => 'required|numeric',
            'created_at' => 'required'
        ]);
        Work::create([
            'topic' => $request->topic,
            'hour' => $request->hour,
            'created_at' =>  \Carbon\Carbon::parse($request->created_at)->format('Y-m-d H:i:s'),
            'user_id' => auth()->id()
        ]);
        Session::flash('message', 'Work added successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        return view('works.edit', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        //
        $this->validate($request, [
            'topic' => 'required',
            'hour' => 'required|numeric',
            'created_at' => 'required'
        ]);
        $work->topic = $request->topic;
        $work->hour = $request->hour;
        $work->created_at = $request->created_at;
        $work->save();
        Session::flash('message', 'Work updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return redirect()->back();
    }
}
