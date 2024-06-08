<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // il nome della function è il nome del model in relazione  --One to Many--
    public function type(){
        // appartiene a Type
        return $this->belongsTo(Type::class);
    }


    // --Many to Many--
    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }


    protected $fillable = ['title', 'link', 'slug', 'type_id', 'description'];
}
