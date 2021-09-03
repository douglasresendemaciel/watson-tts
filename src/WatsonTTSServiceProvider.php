<?php /** @noinspection PhpUndefinedFunctionInspection */

namespace Robtesch\WatsonTTS;

use Illuminate\Support\ServiceProvider;

/**
 * Class WatsonTTSServiceProvider
 * @package Robtesch\WatsonTTS
 */
class WatsonTTSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $configPath = __DIR__ . '/../config/watson-tts.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('watson-tts.php');
        } else {
            $publishPath = base_path('config/watson-tts.php');
        }
        $this->publishes([$configPath => $publishPath], 'config');
    }
    
    public function register()
    {
        $configPath = __DIR__ . '/../config/watson-tts.php';
        $this->mergeConfigFrom($configPath, 'watson-tts');
        $this->app->bind('WatsonTTS', static function () {
            return new WatsonTTS;
        });
        $this->app->alias(WatsonTTS::class, 'WatsonTTS');
    }
}
