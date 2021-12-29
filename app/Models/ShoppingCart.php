<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['buyer_id', 'goods_id', 'seller_id', 'qty'];

    /**
     * Get the buyer that owns the ShoppingCart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    /**
     * Get the seller that owns the ShoppingCart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    /**
     * Get the goods that owns the ShoppingCart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

    public static function count()
    {
        return ShoppingCart::where('buyer_id', auth()->id())->count();
    }

    public static function getDataById()
    {
        return ShoppingCart::with('goods')->where('buyer_id', auth()->id())->get();
    }
}
