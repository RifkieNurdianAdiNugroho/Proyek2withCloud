<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Goods extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'description', 'category', 'price', 'status'];

    /**
     * Get the user that owns the Goods
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the goodsImages for the Goods
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsImages()
    {
        return $this->hasMany(GoodsImages::class);
    }

    /**
     * Get all of the transactionDetails for the Goods
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'goods_id', 'id');
    }

    /**
      * The "booted" method of the model.
      *
      * @return void
      */
    protected static function booted()
    {
        if (isset(Auth::user()->role) && Auth::user()->role == 'penjual') {
            static::addGlobalScope('by_user', function (Builder $builder) {
                $builder->where('user_id', auth()->id());
            });
        }
    }
}
