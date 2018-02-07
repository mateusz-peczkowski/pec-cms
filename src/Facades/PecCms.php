<?php

namespace peczis\pecCms\Facades;

use Illuminate\Support\Facades\Facade;

class PecCms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pecCms';
    }
}
