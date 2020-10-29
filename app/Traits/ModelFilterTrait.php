<?php
namespace App\Traits;

use EloquentFilter\Filterable;

trait ModelFilterTrait 
{
    use Filterable;

    public function scopeModelFilter($query, $filter = null, array $input = []) {
        return $query->filter($input, $filter);
    }
}