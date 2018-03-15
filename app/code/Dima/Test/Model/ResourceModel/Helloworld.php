<?php

namespace Dima\Test\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Helloworld extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('dima_test_table', 'some_id');
    }
}