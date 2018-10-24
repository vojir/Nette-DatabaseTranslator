<?php

namespace Vojir\DatabaseTranslator\DI;

/**
 * Class DatabaseTranslatorExtension
 * @package Vojir\DatabaseTranslator\DI
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class DatabaseTranslatorExtension extends \Nette\DI\CompilerExtension{

  private $defaults = [
    'defaultLang' => 'en',
    'domains' => [],
    'saveNew' => false
  ];

  public function loadConfiguration(){
    $config=$this->validateConfig($this->defaults);
    $container = $this->getContainerBuilder();
    $serviceDefinition=$container->addDefinition($this->prefix('translator'));
    $serviceDefinition->setType('Vojir\\DatabaseTranslator\\DatabaseTranslator');
    $serviceDefinition->addSetup('setLang',[$config['defaultLang']]);
    $serviceDefinition->addSetup('setSaveNewStringsForLanguages',[$config['saveNew']]);
    if (!empty($config['domains'])){
      $serviceDefinition->addSetup('setDomains',[$config['domains']]);
      $serviceDefinition->addSetup('detectLangByDomain');
    }
  }

}