<?php

namespace Joelwmale\LaravelEncryption\Builders;

use Illuminate\Database\Eloquent\Builder;

class EloquentBuilder extends Builder
{
    use OrderByEncrypted;
    use WhereEncrypted;
    use WhereInEncrypted;
}
