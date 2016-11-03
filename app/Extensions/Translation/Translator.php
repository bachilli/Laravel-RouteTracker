<?php

namespace App\Extensions\Translation;

use Illuminate\Translation\Translator as LaravelTranslator;

class Translator extends LaravelTranslator
{
    /**
     * Get the translation for a given key.
     *
     * @param  string  $id
     * @param  array   $parameters
     * @param  string  $domain
     * @param  string  $locale
     * @return string|array|null
     */
    public function trans($id, array $parameters = [], $domain = 'messages', $locale = null)
    {
        foreach ($parameters as $key => $value) {
            $wrappedValue = sprintf('<span class="alert-marker">%s</span>', $value);

            $parameters = [ $key =>  $wrappedValue ];
        }

        return $this->get($id, $parameters, $locale);
    }
}