<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circulation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['collection', 'member'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('kode_transaksi', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%'); 
        });
    }

    public function collection() {
        return $this->belongsTo(Collection::class);
    }

    public function member() {
        return $this->belongsTo(Member::class);
    }
}
