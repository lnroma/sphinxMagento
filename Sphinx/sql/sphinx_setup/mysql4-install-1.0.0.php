<?php
$installer = $this;
$installer->startSetup();

$installer->run("
CREATE TABLE {$this->getTable('sphinx/sphinx')} (
  `entity_id` int(10) unsigned NOT NULL auto_increment,
  `product_id` int(10) NOT NULL,
  `name_index` TEXT NOT NULL,
  `description_index` TEXT NOT NULL,
   PRIMARY KEY  (`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ");

$installer->endSetup();
