<?php

namespace Dima\Test\Setup;

use Magento\Framework\Setup\ExternalFKSetup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Catalog\Api\Data\ProductInterface;

class Recurring implements InstallSchemaInterface
{
    protected $_array = [

    ];
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        echo 'gg';

    }
}