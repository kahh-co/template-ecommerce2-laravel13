<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'stock', 'image', 'status', 'is_best_seller',
    ];

    protected $casts = [
        'is_best_seller' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path('storage/'.$this->image))) {
            return asset('storage/'.$this->image);
        }
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return 'https://images.unsplash.com/photo-1541167760496-1628856ab772?w=600&q=80&auto=format&fit=crop';
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }
}
