<?php

namespace App\Http\Controllers\Api;

use App\Application;
use Illuminate\Http\Request;
use App\Http\Requests\ApplicationRequest;

class ApplicationsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applications = Application::all();

        if ($request->has('query')) {
            $applications->where('name', 'like', '%' . $request->input('query') . '%');
        }

        return $applications;

    }

    /**
     * Display the specified Job.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $app = Application::with('job')->findOrFail($id);

        $app->resume;

        return $app;
    }

    /**
     * Store a newly created Job in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationRequest $request)
    {
        $application = new Application($request->all());

        $application->ip_address = $request->ip();

        $application->save();

        return $application;
        // return response(['success' => true], 200);
    }

    /**
     * Store a newly created Job in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function rating($id, Request $request)
    {
        $application = Application::findOrFail($id);

        $application->fill($request->only(['rating']));

        $application->save();

        return $application;
    }
}
