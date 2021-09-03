<?php

namespace Robtesch\WatsonTTS\Models;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class Synthesis
 * @package Robtesch\WatsonTTS\Models
 */
class Synthesis
{
    /**
     * @var mixed
     */
    protected $extension;
    /**
     * @var mixed
     */
    protected $size;
    /**
     * @var mixed
     */
    protected $length;
    /**
     * @var mixed
     */
    protected $bitRate;
    /**
     * @var mixed
     */
    protected $sampleRate;
    /**
     * @var mixed
     */
    protected $channels;
    /**
     * @var mixed
     */
    protected $text;
    /**
     * @var mixed
     */
    protected $voice;
    /**
     * @var mixed
     */
    protected $customisationId;
    /**
     * @var mixed
     */
    protected $fullPath;
    /**
     * @var mixed
     */
    protected $relativePath;

    /**
     * Synthesis constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->extension = $data['extension'];
        $this->size = $data['size'];
        $this->length = $data['length'];
        $this->bitRate = $data['bitRate'];
        $this->sampleRate = $data['sampleRate'];
        $this->channels = $data['channels'];
        $this->text = $data['text'];
        $this->voice = $data['voice'];
        $this->customisationId = $data['customisationId'];
        $this->fullPath = $data['fullPath'];
        $this->relativePath = $data['relativePath'];
    }

    /**
     * @return BinaryFileResponse
     */
    public function download(): BinaryFileResponse
    {
        return response()->download($this->fullPath);
    }

    /**
     * @return BinaryFileResponse
     */
    public function file(): BinaryFileResponse
    {
        return response()->file($this->fullPath);
    }
}
