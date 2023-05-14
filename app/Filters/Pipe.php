<?php

namespace App\Filters;
use Closure;
interface Pipe
{
    public function apply($content, Closure $next);
}
