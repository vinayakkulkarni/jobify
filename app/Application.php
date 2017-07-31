<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'applications';

    protected $primaryKey = 'id';

	protected $fillable = ['job_id', 'name', 'email', 'web_address', 'cover', 'rating', 'resume', 'ip_address', 'like_working'];

	protected $casts = ['like_working' => 'boolean', 'rating' => 'integer'];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
