<?php

namespace Robtesch\WatsonTTS\Models;

use Exception;
use Robtesch\WatsonTTS\Exceptions\ValidationException;

/**
 * Class Voice
 * @package Robtesch\WatsonTTS\Models
 */
class Voice
{
    /**
     * @var null
     */
    protected $name;
    /**
     * @var null
     */
    protected $language;
    /**
     * @var false
     */
    protected $customizable;
    /**
     * @var string
     */
    protected $gender;
    /**
     * @var null
     */
    protected $url;
    /**
     * @var VoiceFeatures
     */
    protected $supportedFeatures;
    /**
     * @var null
     */
    protected $description;

    /**
     * Voice constructor.
     * @param $properties
     */
    public function __construct($properties)
    {
        $this->name = $properties->name ?? null;
        $this->language = $properties->language ?? null;
        $this->customizable = $properties->customizable ?? false;
        $this->gender = $properties->gender ?? 'female';
        $this->url = $properties->url ?? null;
        $this->supportedFeatures = property_exists($properties, 'supported_features') ? new VoiceFeatures($properties->supported_features) : new VoiceFeatures();
        $this->description = $properties->description ?? null;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @param bool $customisable
     * @return $this
     */
    public function setCustomisable(bool $customisable): self
    {
        $this->customizable = $customisable;

        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return $this
     */
    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return VoiceFeatures
     */
    public function getSupportedFeatures(): VoiceFeatures
    {
        return $this->supportedFeatures;
    }

    /**
     * @param $supportedFeatures
     * @return $this
     * @throws ValidationException
     */
    public function setSupportedFeatures($supportedFeatures): self
    {
        if (is_array($supportedFeatures)) {
            $supportedFeatures = json_decode(json_encode($supportedFeatures));
        }
        if (is_object($supportedFeatures)) {
            $this->supportedFeatures = new VoiceFeatures($supportedFeatures);

            return $this;
        }
        throw new ValidationException('Supported Features must be either an array or object');
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
