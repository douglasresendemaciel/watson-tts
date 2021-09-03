<?php

namespace Robtesch\WatsonTTS\Models;

/**
 * Class VoiceFeatures
 * @package Robtesch\WatsonTTS\Models
 */
class VoiceFeatures
{
    /**
     * @var false
     */
    protected $voiceTransformation;
    /**
     * @var false
     */
    protected $customPronunciation;

    /**
     * VoiceFeatures constructor.
     * @param null $properties
     */
    public function __construct($properties = null)
    {
        $this->voiceTransformation = $properties->voice_transformation ?? false;
        $this->customPronunciation = $properties->custom_pronunciation ?? false;
    }
}
