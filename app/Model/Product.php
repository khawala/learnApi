<?php

namespace App\Model;
use App\Model\reviews;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
'name','price','stock','detail','discount'
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
