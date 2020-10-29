<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class CommentFilter extends ModelFilter
{
    public $relations = [];

    public function q($keyword)
    {
        return $this->where(function($q) use ($keyword) {
            return $q->where('content', 'LIKE', "%$keyword%");
        });
    }
}
