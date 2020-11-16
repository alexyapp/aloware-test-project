<?php

namespace App\Models;

use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasComments;

    /**
     * Append attributes.
     */
    protected $appends = ['commentable_type'];

    /**
     * Define the level attribute.
     *
     * @return int
     */
    public function getLevelAttribute()
    {
        $count = 0;
        $parent = $this->commentable;

        while (!is_null($parent)) {
            ++$count;
            $parent = $parent->commentable;
        }

        return $count;
    }
}
