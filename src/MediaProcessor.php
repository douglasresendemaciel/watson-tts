<?php

namespace Robtesch\WatsonTTS;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Robtesch\WatsonTTS\Exceptions\ValidationException;
use Robtesch\WatsonTTS\Models\Synthesis;
use wapmorgan\MediaFile\AudioAdapter;
use wapmorgan\MediaFile\Exceptions\FileAccessException;
use wapmorgan\MediaFile\MediaFile;

/**
 * Class MediaProcessor
 * @package Robtesch\WatsonTTS
 */
class MediaProcessor
{
    /**
     * @param string $path
     * @param string $extension
     * @param string $text
     * @param string $voice
     * @param string|null $customisationId
     * @return Synthesis
     * @throws FileAccessException
     * @throws ValidationException
     */
    public function processFile(string $path, string $extension, string $text, string $voice, string $customisationId = null): Synthesis
    {
        $media = MediaFile::open($path);
        if ($media->isAudio()) {
            $audio = $media->getAudio();
            $length = $audio->getLength();
            $bitRate = $audio->getBitRate();
            $sampleRate = $audio->getSampleRate();
            $channels = $audio->getChannels();
        } else {
            throw new ValidationException('File is not a supported audio format', 422);
        }
        $pathRoot = Config::get('filesystems.disks.' . Config::get('watson-tts.filesystem', 'local') . '.root');
        $relativePath = substr($path, strlen($pathRoot));
        $size = Storage::size($relativePath);

        return new Synthesis([
            'extension' => $extension,
            'size' => $size,
            'length' => $length,
            'bitRate' => $bitRate,
            'sampleRate' => $sampleRate,
            'channels' => $channels,
            'text' => $text,
            'voice' => $voice,
            'customisationId' => $customisationId,
            'fullPath' => $path,
            'relativePath' => $relativePath,
        ]);
    }
}
