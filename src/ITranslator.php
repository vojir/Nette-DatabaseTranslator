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
  public function getLang();

  /**
   * Method for selection of the actual language
   * @param string $language
   */
  public function setLang($language);

  /**
   * Method returning supported language
   * @param string $language
   * @return string
   */
  public function detectLang($language);

  /**
   * @param string $message
   * @param null|int $count
   * @param null|string $language
   * @return string
   */
  public function translate($message, $count = null, $language=null);

}