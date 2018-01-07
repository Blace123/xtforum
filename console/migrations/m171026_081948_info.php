<?php

use yii\db\Migration;

class m171026_081948_info extends Migration
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
        $this -> createTable('info',
        [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'image' => $this->string(255),
            'create_at' => $this->string(32),
            'user_id' => $this->string(32)
        ]

            );
        "CONSTRAINT  `info` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE cascade)";
    }

    public function down()
    {
        //echo "m171026_081948_info cannot be reverted.\n";
        $this->dropTable('info');

        return false;
    }
}
