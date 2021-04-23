<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history_work extends Model
{
    use HasFactory;
    protected $fillable = ['unique_id','title', 'image', 'collaborator', 'deadline', 'workdone','note'];
}
