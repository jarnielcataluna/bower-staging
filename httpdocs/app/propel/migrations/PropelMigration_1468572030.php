<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1468572030.
 * Generated on 2016-07-15 16:40:30 by Propelrr-AJ
 */
class PropelMigration_1468572030
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

DROP INDEX `name` ON `accounts`;

DROP INDEX `contact_person` ON `accounts`;

DROP INDEX `best_from` ON `accounts`;

DROP INDEX `best_to` ON `accounts`;

ALTER TABLE `accounts` CHANGE `name` `name` VARCHAR(255);

ALTER TABLE `accounts` CHANGE `contact_person` `contact_person` VARCHAR(255);

ALTER TABLE `accounts` CHANGE `contact_number` `contact_number` VARCHAR(45);

ALTER TABLE `accounts` CHANGE `address` `address` VARCHAR(255);

ALTER TABLE `accounts` CHANGE `best_from` `best_from` VARCHAR(100);

ALTER TABLE `accounts` CHANGE `best_to` `best_to` VARCHAR(100);

ALTER TABLE `accounts` CHANGE `area_id` `area_id` INTEGER(11);

ALTER TABLE `accounts` CHANGE `city_id` `city_id` INTEGER(11);

ALTER TABLE `accounts` CHANGE `frequency` `frequency` VARCHAR(100);

ALTER TABLE `accounts` CHANGE `category_id` `category_id` INTEGER(11);

ALTER TABLE `accounts` CHANGE `channel` `channel` VARCHAR(255);

ALTER TABLE `accounts` CHANGE `bracket_number` `bracket_number` VARCHAR(255);

ALTER TABLE `accounts` CHANGE `status` `status` INTEGER(11);

CREATE INDEX `accounts_FI_1` ON `accounts` (`area_id`);

CREATE INDEX `accounts_FI_2` ON `accounts` (`city_id`);

CREATE INDEX `accounts_FI_3` ON `accounts` (`category_id`);

DROP INDEX `area` ON `area`;

ALTER TABLE `area` CHANGE `id` `id` INTEGER NOT NULL AUTO_INCREMENT;

ALTER TABLE `area` CHANGE `area` `area` VARCHAR(255);

ALTER TABLE `area` CHANGE `city_id` `city_id` INTEGER(11);

ALTER TABLE `area` CHANGE `status` `status` INTEGER(11);

CREATE INDEX `area_FI_1` ON `area` (`city_id`);

DROP INDEX `fname` ON `bower`;

DROP INDEX `lname` ON `bower`;

DROP INDEX `username` ON `bower`;

DROP INDEX `password` ON `bower`;

ALTER TABLE `bower` CHANGE `id` `id` INTEGER NOT NULL AUTO_INCREMENT;

ALTER TABLE `bower` CHANGE `fname` `fname` VARCHAR(255);

ALTER TABLE `bower` CHANGE `lname` `lname` VARCHAR(255);

ALTER TABLE `bower` CHANGE `contact_number` `contact_number` VARCHAR(255);

ALTER TABLE `bower` CHANGE `bdate` `bdate` VARCHAR(255);

ALTER TABLE `bower` CHANGE `username` `username` VARCHAR(255);

ALTER TABLE `bower` CHANGE `password` `password` VARCHAR(255);

ALTER TABLE `bower` CHANGE `area_id` `area_id` INTEGER(100);

ALTER TABLE `bower` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `bower`
    ADD `bower_id` VARCHAR(255) AFTER `status`;

CREATE INDEX `bower_FI_1` ON `bower` (`area_id`);

ALTER TABLE `bower_account` CHANGE `bower_id` `bower_id` INTEGER(11);

ALTER TABLE `bower_account` CHANGE `account_id` `account_id` INTEGER(11);

ALTER TABLE `bower_account` CHANGE `status` `status` INTEGER(11);

CREATE INDEX `bower_account_FI_1` ON `bower_account` (`bower_id`);

CREATE INDEX `bower_account_FI_2` ON `bower_account` (`account_id`);

DROP INDEX `brand` ON `brand`;

ALTER TABLE `brand` CHANGE `id` `id` INTEGER NOT NULL AUTO_INCREMENT;

ALTER TABLE `brand` CHANGE `brand` `brand` VARCHAR(255);

ALTER TABLE `brand` CHANGE `status` `status` INTEGER(100);

ALTER TABLE `brand_product` CHANGE `id` `id` INTEGER NOT NULL AUTO_INCREMENT;

ALTER TABLE `brand_product` CHANGE `brand_id` `brand_id` INTEGER(100);

ALTER TABLE `brand_product` CHANGE `product_id` `product_id` INTEGER(100);

CREATE INDEX `brand_product_FI_1` ON `brand_product` (`brand_id`);

CREATE INDEX `brand_product_FI_2` ON `brand_product` (`product_id`);

DROP INDEX `category` ON `category`;

ALTER TABLE `category` CHANGE `category` `category` VARCHAR(255);

ALTER TABLE `category` CHANGE `status` `status` INTEGER(11);

DROP INDEX `city` ON `city`;

ALTER TABLE `city` CHANGE `id` `id` INTEGER NOT NULL AUTO_INCREMENT;

ALTER TABLE `city` CHANGE `city` `city` VARCHAR(255);

ALTER TABLE `city` CHANGE `province_id` `province_id` INTEGER(11);

ALTER TABLE `city` CHANGE `status` `status` INTEGER(11);

CREATE INDEX `city_FI_1` ON `city` (`province_id`);

DROP INDEX `day` ON `day`;

ALTER TABLE `day` CHANGE `day` `day` VARCHAR(255);

ALTER TABLE `day` CHANGE `bracket_number` `bracket_number` INTEGER(11);

ALTER TABLE `invoice_item` CHANGE `invoice_id` `invoice_id` INTEGER(11);

ALTER TABLE `invoice_item` CHANGE `product_id` `product_id` INTEGER(11);

ALTER TABLE `invoice_item` CHANGE `unit_price` `unit_price` FLOAT(100);

ALTER TABLE `invoice_item` CHANGE `qty` `qty` INTEGER(11);

ALTER TABLE `invoice_item` CHANGE `total_sales` `total_sales` FLOAT(100);

CREATE INDEX `invoice_item_FI_1` ON `invoice_item` (`invoice_id`);

CREATE INDEX `invoice_item_FI_2` ON `invoice_item` (`product_id`);

ALTER TABLE `invoices` CHANGE `receipt_id` `receipt_id` VARCHAR(255);

ALTER TABLE `invoices` CHANGE `invoice_date` `invoice_date` VARCHAR(255);

ALTER TABLE `invoices` CHANGE `account_id` `account_id` INTEGER(11);

ALTER TABLE `invoices` CHANGE `sold_to` `sold_to` VARCHAR(255);

ALTER TABLE `invoices` CHANGE `bower_id` `bower_id` INTEGER(11);

ALTER TABLE `invoices` CHANGE `sales` `sales` FLOAT(100);

ALTER TABLE `invoices` CHANGE `skus` `skus` INTEGER(11);

ALTER TABLE `invoices` CHANGE `status` `status` INTEGER(11);

CREATE INDEX `invoices_FI_1` ON `invoices` (`account_id`);

CREATE INDEX `invoices_FI_2` ON `invoices` (`bower_id`);

DROP INDEX `sku` ON `product`;

DROP INDEX `name` ON `product`;

ALTER TABLE `product` CHANGE `id` `id` INTEGER NOT NULL AUTO_INCREMENT;

ALTER TABLE `product` CHANGE `product_category_id` `product_category_id` INTEGER(100);

ALTER TABLE `product` CHANGE `sku` `sku` VARCHAR(255);

ALTER TABLE `product` CHANGE `name` `name` VARCHAR(255);

ALTER TABLE `product` CHANGE `background_color` `background_color` VARCHAR(255);

ALTER TABLE `product` CHANGE `font_color` `font_color` VARCHAR(255);

ALTER TABLE `product` CHANGE `image` `image` VARCHAR(255);

ALTER TABLE `product` CHANGE `thumbnail` `thumbnail` VARCHAR(255);

ALTER TABLE `product` CHANGE `base_price` `base_price` FLOAT;

ALTER TABLE `product` CHANGE `vat` `vat` FLOAT;

ALTER TABLE `product` CHANGE `date_added` `date_added` VARCHAR(255);

ALTER TABLE `product` CHANGE `status` `status` INTEGER(100);

ALTER TABLE `product` CHANGE `type` `type` INTEGER(11);

CREATE INDEX `product_FI_1` ON `product` (`product_category_id`);

DROP INDEX `product_category` ON `product_category`;

ALTER TABLE `product_category` CHANGE `id` `id` INTEGER NOT NULL AUTO_INCREMENT;

ALTER TABLE `product_category` CHANGE `product_category` `product_category` VARCHAR(255);

ALTER TABLE `product_category` CHANGE `status` `status` INTEGER(100);

ALTER TABLE `promos` CHANGE `rule_id` `rule_id` INTEGER(11);

ALTER TABLE `promos` CHANGE `name` `name` VARCHAR(255);

ALTER TABLE `promos` CHANGE `description` `description` VARCHAR(255);

ALTER TABLE `promos` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `promos`
    ADD `region_id` INTEGER(1) AFTER `status`;

CREATE INDEX `promos_FI_1` ON `promos` (`rule_id`);

CREATE INDEX `promos_FI_2` ON `promos` (`region_id`);

DROP INDEX `province` ON `province`;

ALTER TABLE `province` CHANGE `province` `province` VARCHAR(255);

ALTER TABLE `province` CHANGE `region_id` `region_id` INTEGER(100);

ALTER TABLE `province` CHANGE `status` `status` INTEGER(11);

CREATE INDEX `province_FI_1` ON `province` (`region_id`);

ALTER TABLE `region` CHANGE `region` `region` VARCHAR(255);

ALTER TABLE `region` CHANGE `status` `status` INTEGER(11);

ALTER TABLE `rules` CHANGE `product_id` `product_id` INTEGER(11);

ALTER TABLE `rules` CHANGE `qty_to_qualify` `qty_to_qualify` INTEGER(11);

ALTER TABLE `rules` CHANGE `qty_free` `qty_free` INTEGER(11);

ALTER TABLE `rules` CHANGE `promo_product_id` `promo_product_id` INTEGER(11);

ALTER TABLE `rules` CHANGE `start_date` `start_date` VARCHAR(255);

ALTER TABLE `rules` CHANGE `end_date` `end_date` VARCHAR(255);

ALTER TABLE `rules` CHANGE `status` `status` INTEGER(11);

CREATE INDEX `rules_FI_1` ON `rules` (`product_id`);

CREATE INDEX `rules_FI_2` ON `rules` (`promo_product_id`);

ALTER TABLE `sales_report` CHANGE `bower_id` `bower_id` INTEGER(11);

ALTER TABLE `sales_report` CHANGE `total_sales` `total_sales` FLOAT(100);

ALTER TABLE `sales_report` CHANGE `total_skus` `total_skus` INTEGER(11);

ALTER TABLE `sales_report` CHANGE `date` `date` VARCHAR(255);

ALTER TABLE `sales_report` CHANGE `status` `status` INTEGER(11);

CREATE INDEX `sales_report_FI_1` ON `sales_report` (`bower_id`);

ALTER TABLE `sales_report_invoice` CHANGE `sales_report_id` `sales_report_id` INTEGER(11);

ALTER TABLE `sales_report_invoice` CHANGE `invoice_id` `invoice_id` INTEGER(11);

ALTER TABLE `sales_report_invoice` CHANGE `status` `status` INTEGER(11);

CREATE INDEX `sales_report_invoice_FI_1` ON `sales_report_invoice` (`sales_report_id`);

CREATE INDEX `sales_report_invoice_FI_2` ON `sales_report_invoice` (`invoice_id`);

ALTER TABLE `users` CHANGE `fname` `fname` VARCHAR(255);

ALTER TABLE `users` CHANGE `lname` `lname` VARCHAR(255);

ALTER TABLE `users` CHANGE `username` `username` VARCHAR(255);

ALTER TABLE `users` CHANGE `password` `password` VARCHAR(255);

ALTER TABLE `users` CHANGE `level` `level` VARCHAR(255);

ALTER TABLE `users` CHANGE `department` `department` VARCHAR(255);

ALTER TABLE `users` CHANGE `last_login` `last_login` VARCHAR(255);

ALTER TABLE `users` CHANGE `token` `token` VARCHAR(255);

ALTER TABLE `users` CHANGE `status` `status` INTEGER(11);

CREATE TABLE `nestle_regions`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `region_code` VARCHAR(255),
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

DROP TABLE IF EXISTS `nestle_regions`;

DROP INDEX `accounts_FI_1` ON `accounts`;

DROP INDEX `accounts_FI_2` ON `accounts`;

DROP INDEX `accounts_FI_3` ON `accounts`;

ALTER TABLE `accounts` CHANGE `name` `name` VARCHAR(255) NOT NULL;

ALTER TABLE `accounts` CHANGE `contact_person` `contact_person` VARCHAR(255) NOT NULL;

ALTER TABLE `accounts` CHANGE `contact_number` `contact_number` VARCHAR(45) NOT NULL;

ALTER TABLE `accounts` CHANGE `address` `address` VARCHAR(255) NOT NULL;

ALTER TABLE `accounts` CHANGE `best_from` `best_from` VARCHAR(100) NOT NULL;

ALTER TABLE `accounts` CHANGE `best_to` `best_to` VARCHAR(100) NOT NULL;

ALTER TABLE `accounts` CHANGE `area_id` `area_id` INTEGER NOT NULL;

ALTER TABLE `accounts` CHANGE `city_id` `city_id` INTEGER NOT NULL;

ALTER TABLE `accounts` CHANGE `frequency` `frequency` VARCHAR(100) NOT NULL;

ALTER TABLE `accounts` CHANGE `category_id` `category_id` INTEGER NOT NULL;

ALTER TABLE `accounts` CHANGE `channel` `channel` VARCHAR(255) NOT NULL;

ALTER TABLE `accounts` CHANGE `bracket_number` `bracket_number` INTEGER NOT NULL;

ALTER TABLE `accounts` CHANGE `status` `status` INTEGER NOT NULL;

CREATE INDEX `name` ON `accounts` (`name`);

CREATE INDEX `contact_person` ON `accounts` (`contact_person`);

CREATE INDEX `best_from` ON `accounts` (`best_from`);

CREATE INDEX `best_to` ON `accounts` (`best_to`);

DROP INDEX `area_FI_1` ON `area`;

ALTER TABLE `area` CHANGE `id` `id` INTEGER(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `area` CHANGE `area` `area` VARCHAR(255) NOT NULL;

ALTER TABLE `area` CHANGE `city_id` `city_id` INTEGER NOT NULL;

ALTER TABLE `area` CHANGE `status` `status` INTEGER NOT NULL;

CREATE INDEX `area` ON `area` (`area`);

DROP INDEX `bower_FI_1` ON `bower`;

ALTER TABLE `bower` CHANGE `id` `id` INTEGER(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bower` CHANGE `fname` `fname` VARCHAR(255) NOT NULL;

ALTER TABLE `bower` CHANGE `lname` `lname` VARCHAR(255) NOT NULL;

ALTER TABLE `bower` CHANGE `contact_number` `contact_number` VARCHAR(255) NOT NULL;

ALTER TABLE `bower` CHANGE `bdate` `bdate` VARCHAR(255) NOT NULL;

ALTER TABLE `bower` CHANGE `username` `username` VARCHAR(255) NOT NULL;

ALTER TABLE `bower` CHANGE `password` `password` VARCHAR(255) NOT NULL;

ALTER TABLE `bower` CHANGE `area_id` `area_id` INTEGER(100) NOT NULL;

ALTER TABLE `bower` CHANGE `status` `status` INTEGER DEFAULT 1 NOT NULL;

ALTER TABLE `bower` DROP `bower_id`;

CREATE INDEX `fname` ON `bower` (`fname`);

CREATE INDEX `lname` ON `bower` (`lname`);

CREATE INDEX `username` ON `bower` (`username`);

CREATE INDEX `password` ON `bower` (`password`);

DROP INDEX `bower_account_FI_1` ON `bower_account`;

DROP INDEX `bower_account_FI_2` ON `bower_account`;

ALTER TABLE `bower_account` CHANGE `bower_id` `bower_id` INTEGER NOT NULL;

ALTER TABLE `bower_account` CHANGE `account_id` `account_id` INTEGER NOT NULL;

ALTER TABLE `bower_account` CHANGE `status` `status` INTEGER NOT NULL;

ALTER TABLE `brand` CHANGE `id` `id` INTEGER(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `brand` CHANGE `brand` `brand` VARCHAR(255) NOT NULL;

ALTER TABLE `brand` CHANGE `status` `status` INTEGER(100) NOT NULL;

CREATE INDEX `brand` ON `brand` (`brand`);

DROP INDEX `brand_product_FI_1` ON `brand_product`;

DROP INDEX `brand_product_FI_2` ON `brand_product`;

ALTER TABLE `brand_product` CHANGE `id` `id` INTEGER(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `brand_product` CHANGE `brand_id` `brand_id` INTEGER(100) NOT NULL;

ALTER TABLE `brand_product` CHANGE `product_id` `product_id` INTEGER(100) NOT NULL;

ALTER TABLE `category` CHANGE `category` `category` VARCHAR(255) NOT NULL;

ALTER TABLE `category` CHANGE `status` `status` INTEGER NOT NULL;

CREATE INDEX `category` ON `category` (`category`);

DROP INDEX `city_FI_1` ON `city`;

ALTER TABLE `city` CHANGE `id` `id` INTEGER(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `city` CHANGE `city` `city` VARCHAR(255) NOT NULL;

ALTER TABLE `city` CHANGE `province_id` `province_id` INTEGER(100) NOT NULL;

ALTER TABLE `city` CHANGE `status` `status` INTEGER NOT NULL;

CREATE INDEX `city` ON `city` (`city`);

ALTER TABLE `day` CHANGE `day` `day` VARCHAR(45) NOT NULL;

ALTER TABLE `day` CHANGE `bracket_number` `bracket_number` INTEGER NOT NULL;

CREATE UNIQUE INDEX `day` ON `day` (`day`);

DROP INDEX `invoice_item_FI_1` ON `invoice_item`;

DROP INDEX `invoice_item_FI_2` ON `invoice_item`;

ALTER TABLE `invoice_item` CHANGE `invoice_id` `invoice_id` INTEGER NOT NULL;

ALTER TABLE `invoice_item` CHANGE `product_id` `product_id` INTEGER NOT NULL;

ALTER TABLE `invoice_item` CHANGE `unit_price` `unit_price` FLOAT NOT NULL;

ALTER TABLE `invoice_item` CHANGE `qty` `qty` INTEGER NOT NULL;

ALTER TABLE `invoice_item` CHANGE `total_sales` `total_sales` FLOAT NOT NULL;

DROP INDEX `invoices_FI_1` ON `invoices`;

DROP INDEX `invoices_FI_2` ON `invoices`;

ALTER TABLE `invoices` CHANGE `receipt_id` `receipt_id` VARCHAR(255) NOT NULL;

ALTER TABLE `invoices` CHANGE `invoice_date` `invoice_date` VARCHAR(255) NOT NULL;

ALTER TABLE `invoices` CHANGE `account_id` `account_id` INTEGER NOT NULL;

ALTER TABLE `invoices` CHANGE `sold_to` `sold_to` VARCHAR(255) NOT NULL;

ALTER TABLE `invoices` CHANGE `bower_id` `bower_id` INTEGER NOT NULL;

ALTER TABLE `invoices` CHANGE `sales` `sales` FLOAT NOT NULL;

ALTER TABLE `invoices` CHANGE `skus` `skus` INTEGER NOT NULL;

ALTER TABLE `invoices` CHANGE `status` `status` INTEGER NOT NULL;

DROP INDEX `product_FI_1` ON `product`;

ALTER TABLE `product` CHANGE `id` `id` INTEGER(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `product` CHANGE `product_category_id` `product_category_id` INTEGER(100) NOT NULL;

ALTER TABLE `product` CHANGE `sku` `sku` VARCHAR(255) NOT NULL;

ALTER TABLE `product` CHANGE `name` `name` VARCHAR(255) NOT NULL;

ALTER TABLE `product` CHANGE `background_color` `background_color` VARCHAR(255) NOT NULL;

ALTER TABLE `product` CHANGE `font_color` `font_color` VARCHAR(255) NOT NULL;

ALTER TABLE `product` CHANGE `image` `image` VARCHAR(255) NOT NULL;

ALTER TABLE `product` CHANGE `thumbnail` `thumbnail` VARCHAR(255) NOT NULL;

ALTER TABLE `product` CHANGE `base_price` `base_price` FLOAT NOT NULL;

ALTER TABLE `product` CHANGE `vat` `vat` FLOAT NOT NULL;

ALTER TABLE `product` CHANGE `date_added` `date_added` VARCHAR(100) NOT NULL;

ALTER TABLE `product` CHANGE `status` `status` INTEGER(100) NOT NULL;

ALTER TABLE `product` CHANGE `type` `type` INTEGER NOT NULL;

CREATE INDEX `sku` ON `product` (`sku`);

CREATE INDEX `name` ON `product` (`name`);

ALTER TABLE `product_category` CHANGE `id` `id` INTEGER(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `product_category` CHANGE `product_category` `product_category` VARCHAR(255) NOT NULL;

ALTER TABLE `product_category` CHANGE `status` `status` INTEGER(100) NOT NULL;

CREATE INDEX `product_category` ON `product_category` (`product_category`);

DROP INDEX `promos_FI_1` ON `promos`;

DROP INDEX `promos_FI_2` ON `promos`;

ALTER TABLE `promos` CHANGE `rule_id` `rule_id` INTEGER NOT NULL;

ALTER TABLE `promos` CHANGE `name` `name` VARCHAR(255) NOT NULL;

ALTER TABLE `promos` CHANGE `description` `description` VARCHAR(255) NOT NULL;

ALTER TABLE `promos` CHANGE `status` `status` INTEGER NOT NULL;

ALTER TABLE `promos` DROP `region_id`;

DROP INDEX `province_FI_1` ON `province`;

ALTER TABLE `province` CHANGE `province` `province` VARCHAR(255) NOT NULL;

ALTER TABLE `province` CHANGE `region_id` `region_id` INTEGER NOT NULL;

ALTER TABLE `province` CHANGE `status` `status` INTEGER NOT NULL;

CREATE INDEX `province` ON `province` (`province`);

ALTER TABLE `region` CHANGE `region` `region` VARCHAR(100) NOT NULL;

ALTER TABLE `region` CHANGE `status` `status` INTEGER NOT NULL;

DROP INDEX `rules_FI_1` ON `rules`;

DROP INDEX `rules_FI_2` ON `rules`;

ALTER TABLE `rules` CHANGE `product_id` `product_id` INTEGER NOT NULL;

ALTER TABLE `rules` CHANGE `qty_to_qualify` `qty_to_qualify` INTEGER NOT NULL;

ALTER TABLE `rules` CHANGE `qty_free` `qty_free` INTEGER NOT NULL;

ALTER TABLE `rules` CHANGE `promo_product_id` `promo_product_id` INTEGER NOT NULL;

ALTER TABLE `rules` CHANGE `start_date` `start_date` VARCHAR(255) NOT NULL;

ALTER TABLE `rules` CHANGE `end_date` `end_date` VARCHAR(255) NOT NULL;

ALTER TABLE `rules` CHANGE `status` `status` INTEGER NOT NULL;

DROP INDEX `sales_report_FI_1` ON `sales_report`;

ALTER TABLE `sales_report` CHANGE `bower_id` `bower_id` INTEGER NOT NULL;

ALTER TABLE `sales_report` CHANGE `total_sales` `total_sales` FLOAT NOT NULL;

ALTER TABLE `sales_report` CHANGE `total_skus` `total_skus` INTEGER NOT NULL;

ALTER TABLE `sales_report` CHANGE `date` `date` VARCHAR(255) NOT NULL;

ALTER TABLE `sales_report` CHANGE `status` `status` INTEGER NOT NULL;

DROP INDEX `sales_report_invoice_FI_1` ON `sales_report_invoice`;

DROP INDEX `sales_report_invoice_FI_2` ON `sales_report_invoice`;

ALTER TABLE `sales_report_invoice` CHANGE `sales_report_id` `sales_report_id` INTEGER NOT NULL;

ALTER TABLE `sales_report_invoice` CHANGE `invoice_id` `invoice_id` INTEGER NOT NULL;

ALTER TABLE `sales_report_invoice` CHANGE `status` `status` INTEGER NOT NULL;

ALTER TABLE `users` CHANGE `fname` `fname` VARCHAR(255) NOT NULL;

ALTER TABLE `users` CHANGE `lname` `lname` VARCHAR(255) NOT NULL;

ALTER TABLE `users` CHANGE `username` `username` VARCHAR(255) NOT NULL;

ALTER TABLE `users` CHANGE `password` `password` VARCHAR(255) NOT NULL;

ALTER TABLE `users` CHANGE `level` `level` VARCHAR(255) NOT NULL;

ALTER TABLE `users` CHANGE `department` `department` VARCHAR(255) NOT NULL;

ALTER TABLE `users` CHANGE `last_login` `last_login` VARCHAR(255) NOT NULL;

ALTER TABLE `users` CHANGE `token` `token` VARCHAR(255) NOT NULL;

ALTER TABLE `users` CHANGE `status` `status` INTEGER NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}