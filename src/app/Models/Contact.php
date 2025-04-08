<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeNameSearch($query, $searchWord)
    {
        if ($searchWord) {
            return $query->where(function ($query) use ($searchWord) {
                $query->orWhere('last_name', 'like', "%{$searchWord}%")
                    ->orWhere('first_name', 'like', "%{$searchWord}%")
                    ->orWhere('email', 'like', "%{$searchWord}%");
            });
        }

        return $query;
    }

    // 数値だと一意にデータをデータを見つけられるため部分検索が不要である
    public function scopeGenderSearch($query, $gender)
    {
        if ($gender) {
            return $query->where('gender', $gender);
        }

        return $query;
    }

    public function scopeCategorySearch($query, $category)
    {
        if ($category) {
            return $query->where('category_id', (int) $category);
        }

        return $query;
    }

    public function scopeDateSearch($query, $date)
    {
        if ($date) {
            return $query->whereDate('created_at', $date);
        }

        return $query;
    }
}
