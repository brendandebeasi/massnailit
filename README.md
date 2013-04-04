massnailit
==========

MassNailIt WordPress Theme Instructions
==========

Dependencies
-------------------------
massnailit WP theme depends on the meta-box plugin. Upload the plugin into your plugins directory and enable the plugin.


Installation
-------------------------
Enable the theme in Appearance > Themes > Activate. 

Frontpage Carousel / Featured Posts
-------------------------
Posts and pages can be set as featured items on the frontpage carousel. Check the frontpage carousel option located on a post/page and then upload a featured image. 

The function for this custom setting is located in `functions.php` and called in `index.php`. Depends on the meta-box plugin.


MNI Settings
-------------------------

All text in MNI settings accepts _plain text only_ for security reasons.

**Email address** Enter the email address you want messages sent to via the contact form.

**Tagline** The tagline is displayed sitewide (`display_tagline()`) and located in the upper middle of the header.

**Home Promos** The 3 home promos appear on the frontpage (`display_home_promos()`) under the slider. Check out the frontpage for an example.

**Testimonials** Testimonials (`display_testimonials()`) appear on the frontpage. You can change the number of testimonails in the massnailit theme directory in the file `mni-options.php`, line `11`. Change the number of `$max_testimonials`.