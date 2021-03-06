<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Config\Repository as Config;
use Illuminate\Translation\Translator;

abstract class FormRequest extends BaseFormRequest
{
    /**
     * The config repository instance
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * The translator instance
     *
     * @var \Illuminate\Translation\Translator
     */
    protected $lang;

    /**
     * Create the default validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Factory  $validationFactory
     * @param  \Illuminate\Config\Repository  $config
     * @param  \Illuminate\Translation\Translator  $lang
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(ValidationFactory $validationFactory, Config $config, Translator $lang) : Validator
    {
        $this->config = $config;
        $this->lang = $lang;

        return $this->createDefaultValidator($validationFactory);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages() : array
    {
        if ($this->messagesTranslationKey && $this->lang->has($this->messagesTranslationKey)) {
            return $this->lang->get($this->messagesTranslationKey);
        }

        return [];
    }
}
