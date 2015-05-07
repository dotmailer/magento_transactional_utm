<?php

$installer = $this;

$installer->startSetup();


$emailTemplate = $this->getTable('core_email_template');


$installer->getConnection()->addColumn($emailTemplate, 'utm_source', array(
	'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
	'length' => 256,
	'nullable' => true,
	'default' => null,
	'comment' => 'UTM source'
));

$installer->getConnection()->addColumn($emailTemplate, 'utm_medium', array(
	'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
	'length' => 256,
	'nullable' => true,
	'default' => null,
	'comment' => 'UTM medium'
));

$installer->getConnection()->addColumn($emailTemplate, 'utm_campaign', array(
	'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
	'length' => 256,
	'nullable' => true,
	'default' => null,
	'comment' => 'UTM campaign'
));


$installer->endSetup();