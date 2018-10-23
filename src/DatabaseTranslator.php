<?php

namespace Vojir\DatabaseTranslator;

/**
 * Class BlankTranslator - simple, database-based translator class
 * @package Vojir\BlankTranslator
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class DatabaseTranslator implements ITranslator{

  private $lang = 'en';

  /**
   * Translates the given string.
   * @param  string   $message
   * @param  int      $count plural
   * @return string
   */
  function translate($message, $count = null) {
    return $message;
  }

  /**
   * Method returning the actual language
   * @return string
   */
  public function getLang() {
    return $this->lang;
  }

  /**
   * Method for selection of the actual language
   * @param string $language
   */
  public function setLang($language){
    $this->lang=$language;
  }
}