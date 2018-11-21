<?php

namespace Vojir\DatabaseTranslator;

use Dibi\Connection;
use Nette\Http\IRequest;

/**
 * Class DatabaseTranslator - simple, database-based translator class
 * @package Vojir\DatabaseTranslator
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class DatabaseTranslator implements ITranslator{

  private $lang;
  private $domains=[];
  private $connection;
  private $saveNewStringsForLanguages=[];

  /**
   * DatabaseTranslator constructor.
   * @param Connection $dibiConnection
   */
  public function __construct(Connection $dibiConnection){
    $this->connection = $dibiConnection;
  }

  /**
   * Translates the given string.
   * @param  string   $message
   * @param  int      $count plural
   * @return string
   */
  public function translate($message, $count = null) {
    $lang=$this->getLang();
    try{
      $dbResult=$this->connection->query('SELECT [translated] FROM [lang] WHERE [language]=? AND [text]=? LIMIT 1;',$lang,$message);
      $translated=$dbResult->fetchSingle();
    }catch (\Exception $e){
      $translated='';
    }
    if ($translated){
      return $translated;
    }elseif ($translated===false && isset($this->saveNewStringsForLanguages[$lang])){
      $this->connection->query('INSERT INTO [lang] ([text],[language]) VALUES (?,?);',$message,$lang);
    }
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

  #region language detection by web domain
  /**
   * Method for auto-detection of language using the list of domains
   * @param IRequest $request
   */
  public function detectLangByDomain(IRequest $request){
    $domain=$request->getUrl()->getHost();
    if (isset($this->domains[$domain])){
      $this->setLang($this->domains[$domain]);
    }
  }

  /**
   * Method for setting of array of domains organized in form domain=>lang
   * @param array $domains
   */
  public function setDomains(array $domains){
    $this->domains=$domains;
  }

  /**
   * @return array
   */
  public function getDomains(){
    return $this->domains;
  }

  /**
   * Method returning domain attached to language
   * @param string $lang=''
   * @return string
   */
  public function getDomainByLang($lang=''){
    if ($lang==''){
      $lang=$this->getLang();
    }
    if (!empty($domains)){
      foreach ($domains as $domain=>$domainLang){
        if ($domainLang==$lang){
          return $domain;
        }
      }
    }
    return '';
  }
  #endregion language detection by web domain

  /**
   * @param string|array $languages
   */
  public function setSaveNewStringsForLanguages($languages){
    $this->saveNewStringsForLanguages=[];
    if (is_array($languages)){
      foreach ($languages as $language){
        $this->saveNewStringsForLanguages[$language]=$language;
      }
    }elseif(is_string($languages)){
      $this->saveNewStringsForLanguages[$languages]=$languages;
    }
  }
}