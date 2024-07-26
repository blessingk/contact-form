<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    protected $fillable = [
        'name',
        'email',
        'gender',
        'content'
    ];
}