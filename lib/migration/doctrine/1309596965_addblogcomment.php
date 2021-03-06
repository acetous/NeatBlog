<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addblogcomment extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('blog_comment', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => 8,
              'autoincrement' => true,
              'primary' => true,
             ),
             'author' => 
             array(
              'type' => 'string',
              'notnull' => false,
              'length' => 255,
             ),
             'content' => 
             array(
              'type' => 'string',
              'notnull' => true,
              'length' => NULL,
             ),
             'blog_post_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 8,
             ),
             'created_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             'updated_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             ), array(
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('blog_comment');
    }
}