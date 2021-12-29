<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['transaction_id', 'goods_id', 'qty', 'status'];

    /**
     * Get the goods that owns the TransactionDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

    /**
     * Get the transaction that owns the TransactionDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public static function checkStatus($id)
    {
        return TransactionDetail::select('status')
                ->with('goods.user')
                ->whereRelation('transaction', 'transaction_id', '=', $id)
                ->whereRelation('goods', 'user_id', '=', auth()->id())
                ->first();
    }

    public static function checkStatusByBuyer($id)
    {
        return TransactionDetail::select('status')
                ->with('goods.user')
                ->whereRelation('transaction', 'transaction_id', '=', $id)
                ->whereRelation('transaction', 'buyer_id', '=', auth()->id())
                ->first(); 
    }
}
