<?php

use yii\db\Migration;

class m171126_081918_comment extends Migration
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
        $this -> createTable('comment',
        [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull(),
            'image' => $this->string(255),
            'create_at' => $this->string(32),
            'user_id' => $this->string(32),
            'info_id' => $this->string(32),
            'user_id' => $this->string(32),
            'pid' =>$this->string(32)
        ]

            );
    }

    public function down()
    {
        //echo "m171026_081948_info cannot be reverted.\n";
        $this->dropTable('comment');

        return false;
    }
}
