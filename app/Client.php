<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    public $table = 'clients';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const GENDER_SELECT = [
        'male'   => 'Male',
        'female' => 'Female',
    ];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'gender',
        'vehicle',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function appiontments()
    {
        return $this->belongsToMany(Appiontment::class);
    }
}
