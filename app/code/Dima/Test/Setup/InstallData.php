<?php

namespace Dima\Test\Setup;

use Magento\Analytics\Model\Config\Backend\Enabled\SubscriptionHandler;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->getConnection()->insertMultiple(
            $setup->getTable(InstallSchema::TABLE_ENTITIES),
            [
                [
                    'code' => 'some_code',
                    'directory_hash' => 'dasj5j43j34j5jdf',
                    'last_update' => '10.03.20180',
                    'title' => 'Hello World!'
                ],
                [
                    'code' => 'new_code',
                    'directory_hash' => 'dadasd31432da',
                    'last_update' => '10.03.20180',
                    'title' => 'Hello World12!'
                ]
            ]
        );
    }
}