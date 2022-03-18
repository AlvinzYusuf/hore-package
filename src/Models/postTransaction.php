<?php

namespace Hore\HorePackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['title','amount','time','type'];
}
