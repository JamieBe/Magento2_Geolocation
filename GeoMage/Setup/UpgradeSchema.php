<?php

namespace Phoenix\GeoMage\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('store'),
                'country_code',
                [
                    'type' => Table::TYPE_TEXT,
                    'length' => 2,
                    'default' => null,
                    'nullable' => true,
                    'comment' => 'Country Code'
                ]
            );
        }

        $setup->endSetup();
    }
}