<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs';

    protected $primaryKey = 'id';

    // protected $with = ['applications'];

    protected $fillable = ['reference', 'title', 'type', 'description', 'employer', 'location', 'salary', 'post_date'];

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}
