<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','excerpt','body'];  // This is used protect user to manupulate the entry in database. So everything expect this columns will ignore


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class , );
    }
    protected $guarded=[];
    protected $with = ['category','author'];
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query) {
            return $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orwhere('body', 'like', '%' . request('search') . '%');
        });

    }
}

