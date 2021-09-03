<?php

namespace Robtesch\WatsonTTS;

use Exception;
use Robtesch\WatsonTTS\Exceptions\FileSystemException;
use Robtesch\WatsonTTS\Exceptions\ValidationException;
use Robtesch\WatsonTTS\Models\Voice;

/**
 * Class Validator
 * @package Robtesch\WatsonTTS
 */
class Validator
{
    /**
     * @param string $path
     * @return string
     * @throws FileSystemException
     */
    public function validatePath(string $path): string
    {
        if (file_exists($path)) {
            throw new FileSystemException('File "' . $path . '" already exists. Please use a different file name.', 422);
        }
        if (!is_writable(dirname($path))) {
            throw new FileSystemException('Path "' . $path . '" is not writable!', 422);
        }

        return $path;
    }

    /**
     * @param $voice
     * @return string
     * @throws ValidationException
     */
    public function validateVoiceName($voice): string
    {
        if ($voice instanceof Voice) {
            $voiceName = $voice->getName();
        } elseif (is_string($voice)) {
            $voiceName = $voice;
        } else {
            throw new \RuntimeException('variable $voice must be of type string or Voice');
        }
        if (!in_array($voiceName, Constants::VOICES, false)) {
            throw new ValidationException('Voice "' . $voiceName . '" is not in allowed list of values. See https://cloud.ibm.com/apidocs/text-to-speech#get-a-voice for a list of allowed values.', 422);
        }

        return $voiceName;
    }

    /**
     * @param string $method
     * @return string
     * @throws ValidationException
     */
    public function validateMethod(string $method): string
    {
        $ucMethod = strtoupper($method);
        if (!in_array($ucMethod, ['GET', 'POST'])) {
            throw new ValidationException('Specified method "' . $method . '" not allowed, you must use either GET or POST');
        }

        return $ucMethod;
    }

    /**
     * @param string $savePath
     * @param string $accept
     * @param false $validate
     * @return string
     * @throws ValidationException
     */
    public function getFileExtension(string $savePath, string $accept, $validate = false): string
    {
        if ($validate) {
            $accept = $this->validateAcceptTypes($savePath, $accept);
        }
        foreach (Constants::FILE_EXTENSIONS as $key => $extension) {
            if ($this->stringEndsWith($savePath, $extension)) {
                if ($key === $accept) {
                    return '';
                }
                throw new ValidationException('The provided file extension and the "Accept" type do not match!');
            }
        }

        return Constants::FILE_EXTENSIONS[$accept];
    }

    /**
     * @param string $savePath
     * @param string $accept
     * @return string
     * @throws ValidationException
     */
    public function validateAcceptTypes(string $savePath, string $accept): string
    {
        if ($accept === null) {
            foreach (Constants::FILE_EXTENSIONS as $key => $extension) {
                if ($this->stringEndsWith($savePath, $extension)) {
                    return $key;
                }
            }
        }
        if (!array_key_exists($accept, Constants::FILE_EXTENSIONS)) {
            throw new ValidationException('Accept type "' . $accept . '" is not in allowed list of values. See https://cloud.ibm.com/docs/services/text-to-speech/http.html#format for a list of allowed values.', 422);
        }

        return $accept;
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public function stringEndsWith(string $haystack, string $needle): bool
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, $length * -1) === $needle);
    }

    /**
     * @param string|null $format
     * @return string
     * @throws ValidationException
     */
    public function validateFormat(string $format = null): string
    {
        if ($format === null) {
            return 'ipa';
        }
        if (!in_array($format, Constants::PRONUNCIATION_FORMATS, false)) {
            throw new ValidationException('Format "' . $format . '" not allowed, you must use either "ipa" or "ibm"');
        }

        return $format;
    }

    /**
     * @param string|null $language
     * @return string
     * @throws ValidationException
     */
    public function validateLanguage(string $language = null): string
    {
        if ($language === null) {
            return 'en-US';
        }
        if (!in_array($language, Constants::LANGUAGES, false)) {
            throw new ValidationException('Language "' . $language . '" not allowed, visit https://cloud.ibm.com/apidocs/text-to-speech#create-a-custom-model to find out which languages are acceptable');
        }

        return $language;
    }
}
