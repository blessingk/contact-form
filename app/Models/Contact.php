<?php
namespace AppModels;
use Illuminate Database Equelent Factories HasFactory;
use Illuminate Database EqULent Model;
class Contact is model
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