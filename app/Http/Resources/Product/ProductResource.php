<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $this->stock ==0 ?'Out of Stock':$this->stock,
            'totalPrice' =>round(( 1 - ($this->discount/100))* $this->price,2),
//             25/100=.25
//             1-.25=.75
// .75*583=437.25
            'discount' => $this->discount,
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) :'No rating',
            'href'=>[
                'review' => route('reviews.index',$this->id)

            ]
        ];
    }
}
