<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mentors';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    static public $validation = [
        'phone' => 'required',
        'visibility' => 'in:0,1',
    ];

    public function littleBros() {
        return Student::where('mentor_id', $this->user_id)->get();
    }
}
