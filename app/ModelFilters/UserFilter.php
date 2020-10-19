<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    public $relations = [];
    
    public function name($name)
    {
        return $this->where(function($q) use ($name) {
            return $q->where('name', 'LIKE', "%$name%");
        });
    }
    
    public function q($keyword)
    {
        return $this->where(function($q) use ($keyword) {
            return $q->where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%");
        });
    }
}
