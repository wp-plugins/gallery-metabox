=== Gallery Metabox ===
Contributors: billerickson
Tags: gallery, image, images, metabox
Requires at least: 3.0
Tested up to: 3.1.3
Stable tag: 1.0

Displays all the post's attached images on the Edit screen.

== Description ==

I use the WordPress Gallery a lot on websites I build. It's a wonderful tool, but it's hard to find. Instead of telling clients "Click the first icon next to Upload/Insert, then click the gallery tab", I created this simple plugin to display all the attached images in a metabox.

If you're a developer, there's a ton of filters in here to customize it specifically to your needs:

`be_gallery_metabox_post_types` 
is an array of post types the metabox should be visible on. Default: array( 'post', 'page' )

`be_gallery_metabox_limit` 
allows you to further refine your metabox by limiting it to specific pages or page templates ( [example](https://gist.github.com/1320990) ). Default: true

`be_gallery_metabox_context` 
whether to display it in the main area or sidebar. Default: normal

`be_gallery_metabox_priority` 
priority of metabox. Default: high

`be_gallery_metabox_args` 
query args for image listing. Useful if you're [adding custom fields to media library](http://www.billerickson.net/wordpress-add-custom-fields-media-gallery/) ( [example](https://gist.github.com/1321001) )

`be_gallery_metabox_intro` 
Text displayed above image listing. Default: Upload Image | Manage Gallery

`be_gallery_metabox_image_size` 
The image size displayed in the metabox. Default: thumbnail

== Changelog ==

= 1.0 =
* Release of plugin
* Added italian translation (thanks mad_max)

