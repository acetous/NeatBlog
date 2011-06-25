<?php

/**
 * BaseBlogPostVisitor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $token
 * @property integer $post
 * @property integer $views
 * 
 * @method string          getToken() Returns the current record's "token" value
 * @method integer         getPost()  Returns the current record's "post" value
 * @method integer         getViews() Returns the current record's "views" value
 * @method BlogPostVisitor setToken() Sets the current record's "token" value
 * @method BlogPostVisitor setPost()  Sets the current record's "post" value
 * @method BlogPostVisitor setViews() Sets the current record's "views" value
 * 
 * @package    blog
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBlogPostVisitor extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('blog_post_visitor');
        $this->hasColumn('token', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('post', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('views', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}