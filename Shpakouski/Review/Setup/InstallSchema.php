<?php

namespace Shpakouski\Review\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('shpakouski_review_review')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('shpakouski_review_review')
            )
                ->addColumn(
                    'review_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                    ],
                    'Review ID'
                )
                ->addColumn(
                    'review_content',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Review Content'
                )
                ->addColumn(
                    'rating_comfort',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [],
                    'Review Rating Comfort'
                )
                ->addColumn(
                    'rating_price_quality',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [],
                    'Review Rating Price Quality'
                )
                ->addColumn(
                    'review_user',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Review User'
                )
                ->addColumn(
                    'review_product',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Review Product'
                )
                ->setComment('Review Table');
            $installer->getConnection()->createTable($table);
            $installer->getConnection()->addIndex(
                $installer->getTable('shpakouski_review_review'),
                $setup->getIdxName(
                    $installer->getTable('shpakouski_review_review'),
                    ['review_content', 'review_user', 'review_product'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['review_content', 'review_user', 'review_product'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}
