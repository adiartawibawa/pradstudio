<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Tags\Tag as ModelTag;

class Tag extends ModelTag
{
    use HasUuids;
}
