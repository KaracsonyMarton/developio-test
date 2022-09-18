<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'message',
        'due_date',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
