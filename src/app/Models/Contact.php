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
        return $this->belongsToMany(Category::class);
    }

    public function scopeNameSearch($query, $searchword)
    {
        if ($searchword) {
            return $query->where(function ($query) use ($searchword) {
                $query->orWhere('last_name', 'like', "%{$searchword}%")
                ->orWhere('first_name', 'like', "%{$searchword}%")
                ->orWhere('email', 'like', "%{$searchword}%");
            });
        }
        return $query;
    }

    //数値だと一意にデータをデータを見つけられるため部分検索が不要である
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
            return $query->where('category_id', $category);
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
