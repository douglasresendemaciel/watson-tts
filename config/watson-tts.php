<?php
return [
    /*
    |--------------------------------------------------------------------------
    | IBM Watson API Endpoint
    |--------------------------------------------------------------------------
    |
    | Options:
    | Dallas: https://stream.watsonplatform.net/text-to-speech/api
    | Washington DC: https://gateway-wdc.watsonplatform.net/text-to-speech/api
    | Frankfurt: https://stream-fra.watsonplatform.net/text-to-speech/api
    | Sydney: https://gateway-syd.watsonplatform.net/text-to-speech/api
    | Tokyo: https://gateway-tok.watsonplatform.net/text-to-speech/api
    | London: https://gateway-lon.watsonplatform.net/text-to-speech/api
    |
    */
    'endpoint' => env('WATSON_ENDPOINT', 'https://stream.watsonplatform.net/text-to-speech/api'),
    /*
    |--------------------------------------------------------------------------
    | IBM Watson API Version
    |--------------------------------------------------------------------------
    |
    | Currently only support "v1"
    |
    */
    'api_version' => env('WATSON_API_VERSION', 'v1'),
    /*
    |--------------------------------------------------------------------------
    | IBM Watson API Credentials
    |--------------------------------------------------------------------------
    |
    | Currently only the old username and password authentication method is supported.
    | You will need to get your username and password from an IBM. See
    | https://cloud.ibm.com/apidocs/text-to-speech#authentication
    | for more details.
    |
    */
    'username' => env('WATSON_USERNAME', ''),
    'password' => env('WATSON_PASSWORD', ''),

    /*
    |--------------------------------------------------------------------------
    | FileSystem
    |--------------------------------------------------------------------------
    |
    | This package requires access to a Laravel filesystem in order to save
    | the generated audio files. Default is "local" but you can use
    | any filesystem in your config.filesystems.disks that has a
    | "root" path.
    |
    */

    'filesystem' => env('WATSON_FILESYSTEM_DISK', 'local'),
];
