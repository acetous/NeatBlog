# &lt;NeatBlog&gt;

is a simple but flexible blogging software.<br />
It aims for making fast blogging possible without the overhead of WYSIWYG editors and post-management tasks. Just write what you want to write and publish it!

## Features

* Write posts using [Markdown syntax][markdown].
* No usermanagement, no WYSIWYG, no categories, no tags - just write!
* Style your posts your way! The only thing on post-pages is the post, nothing else.

## Installation

* Download a package from the &lt;NeatBlog&gt; [Project Page][neatblog]
* Unpack it on your server and poit your domain to the `web` directory
* Let the webserver write into `log`, `cache` and `web/uploads`
* Put your database configuration into `config/databases.yml` (see `databases.yml.example`)
* Make your changes to `/config/app.yml` <br/>
  If your ever change your cofig, clear the `cache` directory or run `./symfony cc`
* Import `data/sql/schema.sql` into your database OR run `./symfony doctrine:insert-sql`
* Secure the `backend` directory somehow (e.g. HTTP Auth via .htaccess)

If you got the source from github, make sure to remove the `dev` directory from your installation. The development controller offer in depth information about your configuration.

### Security Warning!

**Do ONLY let the `web` folder be accessible through the web.**<br />
Otherwise everyone will be able to read your database configuration by just calling `http://your-domain.com/config/databases.yml` from the web.

## You're done!

View `http://your-domain.com` for your new blog or `http://your-domain.com/backend` for writing new content.


## Feel free to contribute!

Fork my project and add your own features! Or just report your ideas (and - if you find any - bugs)!



[neatblog]: http://github.com/acetous/NeatBlog
[markdown]: http://daringfireball.net/projects/markdown/syntax