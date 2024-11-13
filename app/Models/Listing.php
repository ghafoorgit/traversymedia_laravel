<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['title','company','location','website','email','description','tags','logo','user_id'];

    public function scopeFilter($query, array $filters){
        if(isset($filters['tag']) ?? false){
            $query->where('tags','like','%'.request('tag').'%');
        }
        if(isset($filters['search']) ?? false){
            $query->whereTitle(request('search'));
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
