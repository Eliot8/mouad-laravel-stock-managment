<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Asset extends Model
{
    use HasFactory;

    public $table = 'assets';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'danger_level',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'asset_id');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'asset_id');
    }

    public function delete()
    {
        $this->stocks->each(function ($stock) {
            $stock->delete();
        });

        $this->transactions->each(function ($transaction) {
            $transaction->delete();
        });

        return parent::delete();
    }
}
