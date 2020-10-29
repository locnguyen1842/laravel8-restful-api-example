<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PostFilter extends ModelFilter
{
    public $relations = ['user'];
    
    public function title($title)
    {
        return $this->where(function($q) use ($title) {
            return $q->where('title', 'LIKE', "%$title%");
        });
    }
    
    public function q($keyword)
    {
        return $this->where(function($q) use ($keyword) {
            return $q->where('title', 'LIKE', "%$keyword%")
                ->orWhere('summary', 'LIKE', "%$keyword%");
        });
    }

    public function user($id)
    {
        return $this->where('user_id', $id);
    }

    public function userFullName($userFullName)
    {
        /** @phpstan-ignore-next-line */
        return $this->related('user', 'name', '=', $userFullName);
    }
}
