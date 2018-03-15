<?php

namespace Dima\Test\Block;

class Dima extends \Magento\Framework\View\Element\Template
{
    public function getDimaText()
    {
        return 'Hello World!';
    }

    public function getModel()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $model = $objectManager->create('\Dima\Test\Model\Helloworld');
        return $model;
    }
}