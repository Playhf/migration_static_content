<?php

namespace Dima\Test\Model;

use Magento\Framework\Model\AbstractModel;

class Helloworld extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Dima\Test\Model\ResourceModel\Helloworld');
    }
}