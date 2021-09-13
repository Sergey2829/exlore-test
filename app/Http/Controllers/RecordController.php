<?php

namespace App\Http\Controllers;

use App\Http\Services\RecordService;
use App\Models\Record;
use Illuminate\Http\Request;


class RecordController extends Controller
{

    protected $service;

    public function __construct(RecordService $recordService)
    {
        $this->middleware('auth');
        $this->service = $recordService;
    }


    public function index()
    {
        $records = $this->service->getRecords();

        return view('dashboard', compact('records'));
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
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Record $record)
    {

        if (!$this->checkAccess('edit', $record)) {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }


    public function destroy(Record $record)
    {
        if (!$this->checkAccess('delete', $record)) {
             return redirect()->back()->with('error', 'not accessible');
        }

        $record->delete();
        return redirect()->back()->with('success', 'record has been deleted');
    }
}
