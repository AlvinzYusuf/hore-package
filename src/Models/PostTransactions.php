<?php

namespace Hore\HorePackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTransactions extends Model
{
    use HasFactory;
    protected $fillable = ['title','amount','type'];
}
