<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 01.03.18
 * Time: 17:14
 */

namespace Dima\Test\Model\ResourceModel\Helloworld;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Dima\Test\Model\Helloworld',
               'Dima\Test\Model\ResourceModel\Helloworld');
    }
}