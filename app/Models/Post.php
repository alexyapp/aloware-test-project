<?php

namespace App\Models;

use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasComments;

    /**
     * Append attributes.
     */
    protected $appends = ['commentable_type'];
}
