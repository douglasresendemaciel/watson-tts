<?php

namespace Robtesch\WatsonTTS\Facades;

use Illuminate\Support\Facades\Facade;
use RuntimeException;

/**
 * Class WatsonTTS
 * @package Robtesch\WatsonTTS\Facades
 */
class WatsonTTS extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'WatsonTTS';
    }
}
