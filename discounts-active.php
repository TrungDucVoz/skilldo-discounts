<?php
Class Discount_Activator {
    public static function activate() {
        self::createTable();
        self::addRole();
    }
    public static function createTable() {
        $model = get_model();
        if(!$model->db_table_exists('discounts')) {
            $model->query("CREATE TABLE IF NOT EXISTS `".CLE_PREFIX."discounts` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `excerpt` text COLLATE utf8mb4_unicode_ci,
                `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `time_status` int(11) DEFAULT '0',
                `time_start` int(11) DEFAULT '0',
                `time_end` int(11) DEFAULT '0',
                `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'wait',
                `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `discount_value` int(11) DEFAULT '0',
                `discount_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `discount_condition_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `discount_count_infinity` int(11) NOT NULL DEFAULT '0',
                `discount_count` int(11) DEFAULT '0',
                `discount_use` int(11) DEFAULT '0',
                `discount_type_maximum` int(11) NOT NULL DEFAULT '0',
                `discount_value_maximum` int(11) NOT NULL DEFAULT '0',
                `discount_type_minimize` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
                `discount_value_minimize` int(11) NOT NULL DEFAULT '0',
                `discount_customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `discount_customer_value` text COLLATE utf8mb4_unicode_ci,
                `discount_customer_use` text COLLATE utf8mb4_unicode_ci,
                `discount_customer_count` int(11) NOT NULL DEFAULT '0',
                `created` datetime DEFAULT NULL,
                `updated` datetime DEFAULT NULL,
                `order` int(11) DEFAULT '0'
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
        }
    }
    public static function addRole() {
        $role = Role::get('root');
        $role->add_cap('discount_role');
        $role->add_cap('delete_discount_role');

        $role = Role::get('administrator');
        $role->add_cap('discount_role');
        $role->add_cap('delete_discount_role');
    }
}

Class Discount_Deactivator {
    public static function uninstall() {
        self::cropTable();
    }
    public static function cropTable() {
        $model = get_model('plugins', 'backend');
        $model->query("DROP TABLE IF EXISTS `".CLE_PREFIX."discounts`");
    }
}