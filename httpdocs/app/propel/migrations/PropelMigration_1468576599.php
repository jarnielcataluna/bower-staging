<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1468576599.
 * Generated on 2016-07-15 17:56:39 by Propelrr-AJ
 */
class PropelMigration_1468576599
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `accounts` CHANGE `area_id` `area_id` INTEGER(11);

ALTER TABLE `accounts` CHANGE `city_id` `city_id` INTEGER(11);

ALTER TABLE `accounts` CHANGE `category_id` `category_id` INTEGER(11);

ALTER TABLE `accounts` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `area` CHANGE `city_id` `city_id` INTEGER(11);

ALTER TABLE `area` CHANGE `status` `status` INTEGER(11);

DROP INDEX `bower_FI_1` ON `bower`;

ALTER TABLE `bower` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `bower`
    ADD `distributor_id` INTEGER(11) AFTER `bower_id`;

CREATE INDEX `bower_FI_1` ON `bower` (`distributor_id`);

CREATE INDEX `bower_FI_2` ON `bower` (`area_id`);

ALTER TABLE `bower_account` CHANGE `bower_id` `bower_id` INTEGER(11);

ALTER TABLE `bower_account` CHANGE `account_id` `account_id` INTEGER(11);

ALTER TABLE `bower_account` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `category` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `city` CHANGE `province_id` `province_id` INTEGER(11);

ALTER TABLE `city` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `day` CHANGE `bracket_number` `bracket_number` INTEGER(11);

ALTER TABLE `invoice_item` CHANGE `invoice_id` `invoice_id` INTEGER(11);

ALTER TABLE `invoice_item` CHANGE `product_id` `product_id` INTEGER(11);

ALTER TABLE `invoice_item` CHANGE `unit_price` `unit_price` FLOAT(100);

ALTER TABLE `invoice_item` CHANGE `qty` `qty` INTEGER(11);

ALTER TABLE `invoice_item` CHANGE `total_sales` `total_sales` FLOAT(100);

ALTER TABLE `invoices` CHANGE `account_id` `account_id` INTEGER(11);

ALTER TABLE `invoices` CHANGE `bower_id` `bower_id` INTEGER(11);

ALTER TABLE `invoices` CHANGE `sales` `sales` FLOAT(100);

ALTER TABLE `invoices` CHANGE `skus` `skus` INTEGER(11);

ALTER TABLE `invoices` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `nestle_regions` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `product` CHANGE `type` `type` INTEGER(11);

ALTER TABLE `promos` CHANGE `rule_id` `rule_id` INTEGER(11);

ALTER TABLE `promos` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `province` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `region` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `rules` CHANGE `product_id` `product_id` INTEGER(11);

ALTER TABLE `rules` CHANGE `qty_to_qualify` `qty_to_qualify` INTEGER(11);

ALTER TABLE `rules` CHANGE `qty_free` `qty_free` INTEGER(11);

ALTER TABLE `rules` CHANGE `promo_product_id` `promo_product_id` INTEGER(11);

ALTER TABLE `rules` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `sales_report` CHANGE `bower_id` `bower_id` INTEGER(11);

ALTER TABLE `sales_report` CHANGE `total_sales` `total_sales` FLOAT(100);

ALTER TABLE `sales_report` CHANGE `total_skus` `total_skus` INTEGER(11);

ALTER TABLE `sales_report` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `sales_report_invoice` CHANGE `sales_report_id` `sales_report_id` INTEGER(11);

ALTER TABLE `sales_report_invoice` CHANGE `invoice_id` `invoice_id` INTEGER(11);

ALTER TABLE `sales_report_invoice` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `users` CHANGE `status` `status` INTEGER(11);

CREATE TABLE `nestle_distributors`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `distributor_id` VARCHAR(15),
    `distributor` VARCHAR(255),
    `status` INTEGER(11),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `nestle_distributors`;

ALTER TABLE `accounts` CHANGE `area_id` `area_id` INTEGER;

ALTER TABLE `accounts` CHANGE `city_id` `city_id` INTEGER;

ALTER TABLE `accounts` CHANGE `category_id` `category_id` INTEGER;

ALTER TABLE `accounts` CHANGE `status` `status` INTEGER;

ALTER TABLE `area` CHANGE `city_id` `city_id` INTEGER;

ALTER TABLE `area` CHANGE `status` `status` INTEGER;

DROP INDEX `bower_FI_2` ON `bower`;

DROP INDEX `bower_FI_1` ON `bower`;

ALTER TABLE `bower` CHANGE `status` `status` INTEGER;

ALTER TABLE `bower` DROP `distributor_id`;

CREATE INDEX `bower_FI_1` ON `bower` (`area_id`);

ALTER TABLE `bower_account` CHANGE `bower_id` `bower_id` INTEGER;

ALTER TABLE `bower_account` CHANGE `account_id` `account_id` INTEGER;

ALTER TABLE `bower_account` CHANGE `status` `status` INTEGER;

ALTER TABLE `category` CHANGE `status` `status` INTEGER;

ALTER TABLE `city` CHANGE `province_id` `province_id` INTEGER;

ALTER TABLE `city` CHANGE `status` `status` INTEGER;

ALTER TABLE `day` CHANGE `bracket_number` `bracket_number` INTEGER;

ALTER TABLE `invoice_item` CHANGE `invoice_id` `invoice_id` INTEGER;

ALTER TABLE `invoice_item` CHANGE `product_id` `product_id` INTEGER;

ALTER TABLE `invoice_item` CHANGE `unit_price` `unit_price` FLOAT NOT NULL;

ALTER TABLE `invoice_item` CHANGE `qty` `qty` INTEGER;

ALTER TABLE `invoice_item` CHANGE `total_sales` `total_sales` FLOAT NOT NULL;

ALTER TABLE `invoices` CHANGE `account_id` `account_id` INTEGER;

ALTER TABLE `invoices` CHANGE `bower_id` `bower_id` INTEGER;

ALTER TABLE `invoices` CHANGE `sales` `sales` FLOAT NOT NULL;

ALTER TABLE `invoices` CHANGE `skus` `skus` INTEGER;

ALTER TABLE `invoices` CHANGE `status` `status` INTEGER;

ALTER TABLE `nestle_regions` CHANGE `status` `status` INTEGER;

ALTER TABLE `product` CHANGE `type` `type` INTEGER;

ALTER TABLE `promos` CHANGE `rule_id` `rule_id` INTEGER;

ALTER TABLE `promos` CHANGE `status` `status` INTEGER;

ALTER TABLE `province` CHANGE `status` `status` INTEGER;

ALTER TABLE `region` CHANGE `status` `status` INTEGER;

ALTER TABLE `rules` CHANGE `product_id` `product_id` INTEGER;

ALTER TABLE `rules` CHANGE `qty_to_qualify` `qty_to_qualify` INTEGER;

ALTER TABLE `rules` CHANGE `qty_free` `qty_free` INTEGER;

ALTER TABLE `rules` CHANGE `promo_product_id` `promo_product_id` INTEGER;

ALTER TABLE `rules` CHANGE `status` `status` INTEGER;

ALTER TABLE `sales_report` CHANGE `bower_id` `bower_id` INTEGER;

ALTER TABLE `sales_report` CHANGE `total_sales` `total_sales` FLOAT NOT NULL;

ALTER TABLE `sales_report` CHANGE `total_skus` `total_skus` INTEGER;

ALTER TABLE `sales_report` CHANGE `status` `status` INTEGER;

ALTER TABLE `sales_report_invoice` CHANGE `sales_report_id` `sales_report_id` INTEGER;

ALTER TABLE `sales_report_invoice` CHANGE `invoice_id` `invoice_id` INTEGER;

ALTER TABLE `sales_report_invoice` CHANGE `status` `status` INTEGER;

ALTER TABLE `users` CHANGE `status` `status` INTEGER;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}