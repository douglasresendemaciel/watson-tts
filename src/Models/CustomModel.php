<?php

namespace Robtesch\WatsonTTS\Models;

/**
 * Class CustomModel
 * @package Robtesch\WatsonTTS\Models
 */
class CustomModel
{
    /**
     * @var mixed|null
     */
    protected $customizationId;
    /**
     * @var mixed|null
     */
    protected $name;
    /**
     * @var mixed|null
     */
    protected $language;
    /**
     * @var mixed|null
     */
    protected $owner;
    /**
     * @var mixed|null
     */
    protected $created;
    /**
     * @var mixed|null
     */
    protected $lastModified;
    /**
     * @var mixed|null
     */
    protected $description;
    /**
     * @var array|mixed
     */
    protected $words;

    /**
     * CustomModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        $this->customizationId = $data['customizationId'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->language = $data['language'] ?? null;
        $this->owner = $data['owner'] ?? null;
        $this->created = $data['created'] ?? null;
        $this->lastModified = $data['lastModified'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->words = $data['words'] ?? [];
    }
}
