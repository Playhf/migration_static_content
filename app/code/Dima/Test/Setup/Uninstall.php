<?php

namespace Dima\Test\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
//        $configTable = $setup->getTable('core_config_data');

        $setup->getConnection()->dropTable(InstallSchema::TABLE_AUTHORS);
        $setup->getConnection()->dropTable(InstallSchema::TABLE_COMMIT);
        $setup->getConnection()->dropTable(InstallSchema::TABLE_ENTITIES);
        $setup->getConnection()->dropTable(InstallSchema::TABLE_ITEMS);
        $setup->getConnection()->dropTable(InstallSchema::TABLE_STATE);

        $setup->endSetup();
    }
}