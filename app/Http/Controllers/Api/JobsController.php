<?php

namespace App\Http\Controllers\Api;

use App\Job;
use Illuminate\Http\Request;

class JobsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs= Job::all();

        return $jobs;

    }

    /**
     * Display the specified Job.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Job::findOrFail($id);

    }

    /**
     * Store a newly created Job in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = new Job($request->all());
        $job->save();
        return $job;
    }


    /**
     * Update the job.
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
        $job = Job::findOrFail($id);

        $job->fill($request->only(['reference', 'employer', 'title', 'location', 'salary', 'post_date', 'type', 'description']));

        $job->save();

        return $job;
    }

    /**
     * Delete the job
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return \Response::json(['success' => true]);
    }
}
