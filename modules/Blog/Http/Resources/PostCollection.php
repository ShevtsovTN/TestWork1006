<?php

namespace Modules\Blog\Http\Resources;

use App\Http\Resources\BaseCollection;

class PostCollection extends BaseCollection
{
    public $collects = PostResource::class;
}
