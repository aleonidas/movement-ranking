<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PersonalRecord extends Pivot
{
    use HasFactory;

    protected $table = 'personal_record';

    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'movement_id',
        'value',
        'date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['value', 'date']);
    }

    public function movements()
    {
        return $this->belongsToMany(Movement::class)
            ->withPivot(['value', 'date']);
    }
}
