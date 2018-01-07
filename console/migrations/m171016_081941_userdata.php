<?php

use yii\db\Migration;

class m171016_081941_userdata extends Migration
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
        $this -> createTable('userdata',
        [
            'id' => $this->primaryKey(),
            'qq' => $this->string(255),
            'phone' => $this->string(255),
            'email' => $this->string(255),
            'name' => $this->string(255),
            'sex' => $this->string(255),
            'birthday' => $this->string(255),
            'address' => $this->string(255),
            'hobby' => $this->string(255),
            'image' => $this->string(255),
            'motto' => $this->string(255),
            'update_at' => $this->string(32),
            'user_id' => $this->string(32)
        ]

            );
        "CONSTRAINT  `info` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE cascade)";
    }

    public function down()
    {
        //echo "m171026_081948_info cannot be reverted.\n";
        $this->dropTable('userdata');

        return false;
    }
}
