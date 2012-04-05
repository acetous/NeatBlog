# &lt;NeatBlog&gt;

is a simple but flexible blogging software.<br />
It aims for making fast blogging possible without the overhead of WYSIWYG editors and post management. Just write your content and publish it!

## Features

* Write posts using [Markdown syntax][markdown]. Or just mix in some HTML.
* No usermanagement, no WYSIWYG, no categories, no tags - just write!
* Style your posts your way! The only thing on post-pages is the post, nothing else.
* Oh, there are comments, too.

## Installation

* Download a package from the &lt;NeatBlog&gt; [Project Page][neatblog]
* Unpack it on your server and point your domain to the `web` directory
* Let the webserver write into `log`, `cache`, `data` and `web/uploads`
* Put your database configuration into `config/databases.yml` (see `databases.yml.example`)
* Put your blog configuration into `config/app.yml` (see `app.yml.example`)<br />
  If your ever change your config, clear the `cache` directory or run `./symfony cc`
* Run `./symfony doctrine:migrate` to build your database
* Secure the `backend` directory somehow (e.g. HTTP Auth via .htaccess)

If you got the source from github, make sure to remove the `dev` directory from your installation. The development controller offer in depth information about your configuration.

### Security Warning!

**Do ONLY let the `web` folder be accessible through the web.**<br />
Otherwise everyone will be able to read your database configuration by just calling `http://your-domain.com/config/databases.yml` from the web.

## You're done!

View `http://your-domain.com` for your new blog or `http://your-domain.com/backend` for writing new content.

Check our [wiki][wiki] for a FAQ and available console commands.


## Updating

* Get the latest code via download or update via Git. Remember to keep your config files and `web/uploads` directory.
* Check the `config/app.yml` for any new config values.
* Run `./symfony doctrine:migrate` to update your database.
* Clear your cache.

## Feel free to contribute!

Fork my project and add your own features! Or just report your ideas (and - if you find any - bugs)!

# Attributions

* for the PHP framework: [Symfony][symfony]
* for the CSS/JS-framework: [Bootstrap][bootstrap] and [jQuery][jquery], including [LESS][less] for easier CSS
* for the code highlightning: [google-code-prettify][prettify]
* for HTMl5 feature detection: [Modernizr][modernizr]
* the jQuery-Plugins: [autoResize][jquery-autoresize]


[neatblog]: http://github.com/acetous/NeatBlog
[wiki]: https://github.com/acetous/NeatBlog/wiki
[symfony]: http://www.symfony-project.org/
[markdown]: http://daringfireball.net/projects/markdown/syntax
[silkicons]: http://www.famfamfam.com/lab/icons/silk/
[prettify]: http://code.google.com/p/google-code-prettify/
[bootstrap]: http://twitter.github.com/bootstrap/
[jquery]: http://jquery.com/
[modernizr]: http://modernizr.com/
[less]: http://lesscss.org/
[jquery-autoresize]: http://james.padolsey.com/javascript/jquery-plugin-autoresize/
