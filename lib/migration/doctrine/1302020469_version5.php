<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version5 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('blog_comment', 'blog_post_id', 'integer', '8', array(
             'notnull' => '1',
             ));
    }

    public function down()
    {
		$this->changeColumn('blog_comment', 'blog_post_id', 'integer', '8', array(
             'notnull' => '0',
             ));
    }
}