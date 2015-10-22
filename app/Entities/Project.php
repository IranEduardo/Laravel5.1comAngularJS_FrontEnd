<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date'
    ];

    public function client()
    {
      return $this->belongsTo(Client::class);
    }
    public function user()
    {
      return $this->belongsTo(User::class,'owner_id');
    }
}
