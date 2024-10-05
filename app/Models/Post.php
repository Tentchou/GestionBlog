<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    // gerer les donnes fillables ou modifiables
    protected $fillable = ['title', 'content', 'image']; 
    
    //gerer l'enregistrement des posts avec leurs categories et l'utilisateur
    public static function boot(){
        parent::boot();
        
        self::creating(function($post){
           $post->users()->associate(auth()->user()->id) ;
           $post->categorie()->associate(request()->categorie);
        });

        self::updating(function($post){
            $post->categorie()->associate(request()->categorie);
        });
    }
    //associer les posts au users ou utilisateur
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    //associer les post a chaque categorie
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    //recuperer les articles graces aux titles
    public function getTitleAttribute($attribute){
        return Str::title($attribute);
    }
}
