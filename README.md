Animal is a static website/blog generator written in PHP. It lives on the server and has an interface similar to most database backed blog engines use.

Animal was written as a workaround to a problem I had at work. We had a tightly locked down server, not allowed access to a database, and my task was to bolt on a blog to an already existing site. So I wrote Animal. It writes static files to the server, updates existing files, and uses Apache htaccess and htpasswd for administration. It's a fun tool to use if you want a fast, static site, want to play with some PHP, or have a situation where you can't use a traditional blogging or CMS engine.

Be warned! Animal is half baked and does have quirks:

* Recent Posts list has no limit - you'll need to manually trim it if it gets too long
* Markdown has been known to sneak into the post excerpts unformatted so be careful with what you want to use as an excerpt

There are a few more. I do plan to fix all of these and use this on a production site just to prove it can work. Hey, it's already being use [here](http://asapquotes.com/blog)
