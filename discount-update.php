<?php
if(!Admin::is()) return;
function Discount_update_core() {
    if(Admin::is() && Auth::check() ) {
        $version = Option::get('discount_version');
        $version = (empty($version)) ? '2.1.0' : $version;
        if (version_compare(DISCOUNT_VERSION, $version) === 1) {
            $update = new Discount_Update_Version();
            $update->runUpdate($version);
        }
    }
}
add_action('admin_init', 'Discount_update_core');
Class Discount_Update_Version {
    public function runUpdate($DiscountVersion) {
        $listVersion    = ['2.2.0'];
        $model          = get_model();
        foreach ($listVersion as $version ) {
            if(version_compare( $version, $DiscountVersion ) == 1) {
                $function = 'update_Version_'.str_replace('.','_',$version);
                if(method_exists($this, $function)) $this->$function($model);
            }
        }
        Option::update('discount_version', SHIP_VERSION );
    }
    public function update_Version_2_2_0($model) {
        Discount_Update_Files::Version_2_2_0($model);
    }
}
Class Discount_Update_Database {}
Class Discount_Update_Files {
    public static function Version_2_2_0($model) {
        $path = FCPATH.VIEWPATH.'plugins/'.CART_NAME;
        $Files = [
            'discount-database.php',
            'admin/discounts-navigation.php',
            'admin/discounts-action-bar.php'
        ];

        foreach ($Files as $file) {
            if(file_exists($path.$file)) {
                unlink($path.$file);
            }
        }
    }
}