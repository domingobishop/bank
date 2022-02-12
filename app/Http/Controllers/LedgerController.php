<?php

namespace App\Http\Controllers;

use App\Http\Requests\LedgerPostRequest;
use App\Ledger;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data['all'] = Ledger::orderBy('id', 'desc')->paginate(12);
        $data['new'] = session()->get('new');
        $data['deleted'] = session()->get('deleted');
        session()->forget('new');
        session()->forget('deleted');

        return view('welcome', compact('data'));
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
     * @param LedgerPostRequest $request
     * @return RedirectResponse
     */
    public function store(LedgerPostRequest $request)
    {
        $record = $request->validated();

        $previous = Ledger::latest()->first();

        if ($record['type'] == 'Credit')
        {
            $record['current_balance'] = $previous['current_balance'] + $record['amount'];
        }
        else
        {
            $record['current_balance'] = $previous['current_balance'] - $record['amount'];
        }

        $data['new'] = Ledger::create($record);

        session()->put('new', $data['new']);

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function show(Ledger $ledger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function edit(Ledger $ledger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ledger $ledger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $record = Ledger::find($id);
        session()->put('deleted', $record);
        $record->delete();

        return redirect()->route('index');
    }
}
