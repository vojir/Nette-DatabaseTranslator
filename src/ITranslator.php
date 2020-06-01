<?php

namespace Vojir\DatabaseTranslator;


/**
 * Interface ITranslator
 * @package Vojir\DatabaseTranslator
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
interface ITranslator extends \Nette\Localization\ITranslator{

  /**
   * Method returning the actual language
   * @return string
   */
  public function getLang(): string;

  /**
   * Method for selection of the actual language
   * @param string $language
   */
  public function setLang(string $language);

  /**
   * Method returning supported language
   * @param string $language
   * @return string
   */
  public function detectLang(string $language): string;

  /**
   * Method returning array of supported languages
   * @return array
   */
  public function getSupportedLanguages(): array;

  /**
   * Translates the given string.
   * @param mixed $message
   * @param string|null $language
   * @param mixed ...$parameters
   * @return string
   */
  function translate($message, $language=null, ...$parameters): string;
}