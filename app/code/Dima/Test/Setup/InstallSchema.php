<?php

namespace Dima\Test\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    const TABLE_AUTHORS   = 'aws_migration_static_content_authors';
    const TABLE_COMMIT    = 'aws_migration_static_content_commit';
    const TABLE_ENTITIES  = 'aws_migration_static_content_entities';
    const TABLE_ITEMS     = 'aws_migration_static_content_items';
    const TABLE_STATE     = 'aws_migration_static_content_state';

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $setup->startSetup();

        $table = $setup->getConnection()
            ->newTable($setup->getTable(self::TABLE_AUTHORS))
            ->addColumn(
                'author_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                "Author id"
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Author name'
            )->addColumn(
                'email',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Author email'
            )->addIndex(
                $setup->getIdxName(self::TABLE_AUTHORS, ['email']),
                ['email']
            )->setComment(
                'Migration static content authors table');
        $setup->getConnection()->createTable($table);

        $table = $setup->getConnection()
            ->newTable($setup->getTable(self::TABLE_COMMIT))
            ->addColumn(
                'author_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Author Id'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                'Created at'
            )->addColumn(
                'commit',
                Table::TYPE_TEXT,
                '64k',
                [],
                'Commit'
            )->addColumn(
                'commit_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Commit Id'
            )->addIndex(
                $setup->getIdxName(self::TABLE_COMMIT, ['author_id']),
                ['author_id']
            )->addForeignKey(
                $setup->getFkName(
                    self::TABLE_COMMIT,
                    'author_id',
                    self::TABLE_AUTHORS,
                    'author_id'
                ),
                'author_id',
                $setup->getTable(self::TABLE_AUTHORS),
                'author_id',
                Table::ACTION_CASCADE
            )->setComment('Static content commit');
        $setup->getConnection()->createTable($table);

        $table = $setup->getConnection()
            ->newTable($setup->getTable(self::TABLE_ENTITIES))
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity Id'
            )->addColumn(
                'code',
                Table::TYPE_TEXT,
                255,
                [],
                'Code'
            )->addColumn(
                'directory_hash',
                Table::TYPE_TEXT,
                '64k',
                [],
                'Directory hash'
            )->addColumn(
                'store_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Store Id'
            )->addColumn(
                'last_update',
                Table::TYPE_DATE,
                null,
                ['nullable' => false, /*'default' => Table::TIMESTAMP_INIT_UPDATE*/],
                'Last update'
            )->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => true, 'default' => null],
                'Title'
            )->addIndex(
                $setup->getIdxName(self::TABLE_ENTITIES, ['store_id']),
                ['store_id']
            )->addIndex(
                $setup->getIdxName(self::TABLE_ENTITIES, ['code']),
                ['code']
            )->setComment('Entities table');
        $setup->getConnection()->createTable($table);

        $table = $setup->getConnection()
            ->newTable($setup->getTable(self::TABLE_ITEMS))
            ->addColumn(
                'item_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Item Id'
            )->addColumn(
                'commit_id',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true],
                'Commit Id'
            )->addColumn(
                'hash',
                Table::TYPE_TEXT,
                64,
                [],
                'Hash'
            )->addColumn(
                'content',
                Table::TYPE_TEXT,
                '64k',
                [],
                'Item content'
            )->addColumn(
                'content_hash',
                Table::TYPE_TEXT,
                64,
                [],
                'Content Hash'
            )->addColumn(
                'version',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true],
                'Item version'
            )->addColumn(
                'depends_on',
                Table::TYPE_TEXT,
                64,
                ['nullable' => true, 'default' => null],
                'Depends on'
            )->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true],
                'Entity id'
            )->addIndex(
                $setup->getIdxName(self::TABLE_ITEMS, ['commit_id']),
                ['commit_id']
            )->addIndex(
                $setup->getIdxName(self::TABLE_ITEMS, ['hash']),
                ['hash']
            )->addIndex(
                $setup->getIdxName(self::TABLE_ITEMS, ['entity_id']),
                ['entity_id']
            )->addIndex(
                $setup->getIdxName(self::TABLE_ITEMS, ['version']),
                ['version']
            )->addIndex(
                $setup->getIdxName(self::TABLE_ITEMS, ['content_hash']),
                ['content_hash']
            )->addForeignKey(
                $setup->getFkName(
                    self::TABLE_ITEMS,
                    'commit_id',
                    self::TABLE_COMMIT,
                    'commit_id'
                ),
                'commit_id',
                $setup->getTable(self::TABLE_COMMIT),
                'commit_id',
                Table::ACTION_CASCADE
            )->addForeignKey(
                $setup->getFkName(
                    self::TABLE_ITEMS,
                    'entity_id',
                    self::TABLE_ENTITIES,
                    'entity_id'
                ),
                'entity_id',
                $setup->getTable(self::TABLE_ENTITIES),
                'entity_id',
                Table::ACTION_CASCADE
            )->setComment('Migration Static Content Items');
        $setup->getConnection()->createTable($table);

        $table = $setup->getConnection()
            ->newTable($setup->getTable(self::TABLE_STATE))
            ->addColumn(
                'state_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Static Content State Id'
            )->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Entity Id'
            )->addColumn(
                'version',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Version'
            )->addColumn(
                'status',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Status'
            )->addColumn(
                'item_hash',
                Table::TYPE_TEXT,
                64,
                [],
                'Item Hash'
            )->addColumn(
                'content_hash',
                Table::TYPE_TEXT,
                64,
                [],
                'Content Hash'
            )->addColumn(
                'relation_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => true, 'default' => null],
                'Relation Id'
            )->addColumn(
                'import_version',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true],
                'Import Version'
            )->addColumn(
                'removed',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => true, 'default' => null],
                'Removed'
            )->addIndex(
                $setup->getIdxName(self::TABLE_STATE, ['entity_id']),
                ['entity_id']
            )->addIndex(
                $setup->getIdxName(self::TABLE_STATE, ['content_hash']),
                ['content_hash']
            )->addIndex(
                $setup->getIdxName(self::TABLE_STATE, ['status']),
                ['status']
            )->addIndex(
                $setup->getIdxName(self::TABLE_STATE, ['version']),
                ['version']
            )
            ->addForeignKey(
                $setup->getFkName(
                    self::TABLE_STATE,
                    'entity_id',
                    self::TABLE_ENTITIES,
                    'entity_id'
                ),
                'entity_id',
                $setup->getTable(self::TABLE_ENTITIES),
                'entity_id',
                Table::ACTION_CASCADE
            )->setComment('Migration Static content State');
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}