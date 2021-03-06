<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version9 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('blog_post', 'token', 'string', '255', array(
             'notnull' => '1',
             ));
    }
    
    public function postUp() {
        $posts = Doctrine::getTable('BlogPost')
        	->createQuery('p')
        	->execute();
        foreach ($posts as $post) {
        	$post->setToken(BlogPostTable::generateToken());
        }
        $posts->save();
    	
    }

    public function down()
    {
        $this->removeColumn('blog_post', 'token');
    }
}