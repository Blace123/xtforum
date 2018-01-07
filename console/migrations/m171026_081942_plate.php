<?php

use yii\db\Migration;

class m171026_081942_plate extends Migration
{
   /* public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171026_081948_info cannot be reverted.\n";

        return false;
    }
*/
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this -> createTable('plate',
        [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'owner' => $this->string(32)->notNull(),//所有者id
            'create_at' => $this->string(32),
        ]

            );
        "CONSTRAINT  `info` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE cascade)";
    }

    public function down()
    {
        //echo "m171026_081948_info cannot be reverted.\n";
        $this->dropTable('plate');

        return false;
    }
}
