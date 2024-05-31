<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Type extends Model
{
    use HasFactory;

    // il nome della function è il nome del model in relazione al plurale
    public function projects(){
        // ha molti Project
        return $this->hasMany(Project::class);
    }

    protected $fillable = ['name'];
}
