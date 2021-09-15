<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecord;
use App\Http\Services\RecordService;
use App\Models\Category;
use App\Models\Record;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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


    public function create()
    {
        if (!$this->checkAccess('create', Record::class)) {
            return redirect()->back();
        }

        $categories = Category::all();
        return view('record.create', compact('categories'));
    }


    public function store(CreateRecord $request)
    {
        $this->service->storeRecord($request);

        return redirect()->to(RouteServiceProvider::HOME)
            ->with('success', 'record has been created');

    }


    public function show(Record $record)
    {
        return view('record.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Record $record)
    {
        if (!$this->checkAccess('update', $record)) {
            return redirect()->back();
        }
        dd('you can edit');
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

    public function getByCategory($categoryId)
    {
        $category = Category::find($categoryId);
        $records = $this->service->getRecordsByCategory($categoryId);
        return view('dashboard', compact('records', 'category'));
    }

    public function getByUser(User $user)
    {
        $records = $this->service->getRecordsByUser($user->id);
        return view('dashboard', compact('records'));
    }

}
