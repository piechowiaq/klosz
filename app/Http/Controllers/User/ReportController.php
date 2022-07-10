<?php

namespace App\Http\Controllers\User;

use App\Domains\Company\Models\Company;
use App\Domains\Company\Models\Registry;
use App\Domains\Company\Models\Report;
use App\Domains\Company\Requests\StoreReportRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Company $company, Registry $registry)
    {
        return Inertia::render('User/Pages/Registries/Create', [
            'company' => $company,
            'registry' => $registry,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReportRequest $request
     * @return RedirectResponse
     */
    public function store(StoreReportRequest $request, Company $company, Registry $registry)
    {
        $report = new Report();
        $report->report_date = $request->report_date;
        $report->notes = $request->notes;
        $report->company_id = $request->company_id;
        $report->registry_id = $request->registry_id;
        $report->save();

        return Redirect::route('user.registries.show', ['company' => $company, 'registry'=> $registry])->with('success', 'Role created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
