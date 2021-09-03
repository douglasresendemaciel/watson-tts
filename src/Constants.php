<?php

namespace Robtesch\WatsonTTS;

class Constants
{
    const FILE_EXTENSIONS = [
        'audio/basic' => '.au',
        'audio/flac' => '.flac',
        'audio/l16' => '.l16',
        'audio/ogg' => '.ogg',
        'audio/ogg;codecs=opus' => '.opus',
        'audio/ogg;codecs=vorbis' => '.ogg',
        'audio/mp3' => '.mp3',
        'audio/mpeg' => '.mpeg',
        'audio/mulaw' => '.ulaw',
        'audio/wav' => '.wav',
        'audio/webm' => '.webm',
        'audio/webm;codecs=opus' => '.webm',
        'audio/webm;codecs=vorbis' => '.webm',
    ];

    const VOICES = [
        'en-US_AllisonVoice',
        'en-US_LisaVoice',
        'en-US_MichaelVoice',
        'en-GB_KateVoice',
        'es-ES_EnriqueVoice',
        'es-ES_LauraVoice',
        'es-LA_SofiaVoice',
        'es-US_SofiaVoice',
        'de-DE_DieterVoice',
        'de-DE_BirgitVoice',
        'fr-FR_ReneeVoice',
        'it-IT_FrancescaVoice',
        'ja-JP_EmiVoice',
        'pt-BR_IsabelaVoice',
    ];

    const PRONUNCIATION_FORMATS = [
        'ipa',
        'ibm',
    ];

    const LANGUAGES = [
        'de-DE',
        'en-US',
        'en-GB',
        'es-ES',
        'es-LA',
        'es-US',
        'fr-FR',
        'it-IT',
        'ja-JP',
        'pt-BR',
    ];
}
