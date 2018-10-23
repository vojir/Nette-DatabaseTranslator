<?php

namespace Vojir\DatabaseTranslator\DI;

/**
 * Class DatabaseTranslatorExtension
 * @package Vojir\DatabaseTranslator\DI
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class DatabaseTranslatorExtension extends \Nette\DI\CompilerExtension{

  public function loadConfiguration(){
    $container = $this->getContainerBuilder();
    $container->addDefinition($this->prefix('translator'))
      ->setType('Vojir\\DatabaseTranslator\\DatabaseTranslator');
  }

}