<?php

namespace Robtesch\WatsonTTS;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Robtesch\WatsonTTS\Exceptions\ValidationException;
use Robtesch\WatsonTTS\Models\CustomModel;
use Robtesch\WatsonTTS\Models\Synthesis;
use Robtesch\WatsonTTS\Models\Voice;
use RuntimeException;
use wapmorgan\MediaFile\Exceptions\FileAccessException;

/**
 * Class WatsonTTS
 * @package Robtesch\WatsonTTS
 */
class WatsonTTS
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Validator
     */
    protected $validator;

    /**
     * WatsonTTS constructor.
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
        $this->validator = new Validator();
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getVoices(): array
    {
        $response = $this->client->request('GET', 'voices');
        $voices = [];
        foreach ($response->voices as $voiceData) {
            $voices[] = new Voice($voiceData);
        }

        return $voices;
    }

    /**
     * @param string $voice
     * @return Voice
     * @throws GuzzleException
     * @throws ValidationException
     */
    public function getVoice(string $voice): Voice
    {
        $voice = $this->validator->validateVoiceName($voice);
        $response = $this->client->request('GET', 'voices/' . $voice);

        return new Voice($response);
    }

    /**
     * @param string $method
     * @param string $text
     * @param $voice
     * @param string $savePath
     * @param string|null $accept
     * @param string|null $customisationId
     * @return Synthesis
     * @throws Exceptions\FileSystemException
     * @throws FileAccessException
     * @throws GuzzleException
     * @throws ValidationException
     */
    public function synthesizeAudio(string $method, string $text, $voice, string $savePath, string $accept = null, string $customisationId = null): Synthesis
    {
        $method = $this->validator->validateMethod($method);
        $voiceName = $this->validator->validateVoiceName($voice);
        $acceptString = $this->validator->validateAcceptTypes($savePath, $accept);
        $extension = $this->validator->getFileExtension($savePath, $acceptString);
        $sink = $savePath . $extension;
        $savePath = $this->validator->validatePath($sink);
        $queryData = [
            'accept' => $acceptString,
            'voice' => $voiceName,
        ];
        if ($customisationId !== null) {
            $queryData['customization_id'] = $customisationId;
        }
        if ($method === 'GET') {
            $queryData['text'] = $text;
            $this->client->request('GET', 'synthesize', ['query' => $queryData, 'sink' => $savePath, 'headers' => ['Accept' => $accept]]);
        } else {
            $this->client->request('POST', 'synthesize', ['json' => ['text' => $text], 'query' => $queryData, 'sink' => $savePath, 'headers' => ['Accept' => $accept]]);
        }
        $mediaProcessor = new MediaProcessor();

        return $mediaProcessor->processFile($sink, $extension, $text, $voice, $customisationId);
    }

    /**
     * @param string $text
     * @param $voice
     * @param string|null $format
     * @param string|null $customisationId
     * @return string
     * @throws GuzzleException
     * @throws ValidationException
     */
    public function getPronunciation(string $text, $voice, string $format = null, string $customisationId = null): string
    {
        $voice = $this->validator->validateVoiceName($voice);
        $format = $this->validator->validateFormat($format);
        $queryData = [
            'text' => $text,
            'voice' => $voice,
            'format' => $format,
        ];
        if ($customisationId !== null) {
            $queryData['customization_id'] = $customisationId;
        }
        $response = $this->client->request('GET', 'pronunciation', ['query' => $queryData]);
        if (property_exists($response, 'pronunciation')) {
            return $response->pronunciation;
        }
        throw new RuntimeException('Response from Watson malformed', 501);
    }

    /**
     * @param string $name
     * @param string|null $description
     * @param string|null $language
     * @return string
     * @throws GuzzleException
     * @throws ValidationException
     */
    public function createCustomModel(string $name, string $description = null, string $language = null): string
    {
        $jsonArray = [
            'name' => $name,
        ];
        if ($language !== null) {
            $language = $this->validator->validateLanguage($language);
            $jsonArray['language'] = $language;
        }
        if ($description !== null) {
            $jsonArray['description'] = $description;
        }
        $response = $this->client->request('POST', 'customizations', ['json' => $jsonArray]);

        return new CustomModel($response);
    }
}
