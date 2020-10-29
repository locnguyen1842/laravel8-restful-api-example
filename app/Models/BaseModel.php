<?php

namespace App\Models;

use App\Traits\ModelFilterTrait;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use ModelFilterTrait;
}
