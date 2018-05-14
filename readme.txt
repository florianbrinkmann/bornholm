=== Bornholm ===
Contributors: FlorianBrinkmann
Requires at least: 4.5
Tested up to: 4.9.6
Requires PHP: 5.3
Version 1.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Bornholm is great for your photoblog or portfolio website. The theme comes with two page templates. One template shows the last galleries from your categories and the other shows all your galleries on one page. Furthermore, it brings two widgets that allow you to display the last galleries and to display featured galleries. If you already have images on your blog, you should regenerate the thumbnails.

== Changelog ==

= 1.1.2 – 14.05.2018 =

**Fixed**

* Styling of new comment cookie checkbox.

= 1.1.1 – 17.04.2018 =

**Changed**

* Ship Roboto font files to load it locally instead of loading it from Google.
* Do not overwrite `$GLOBALS['comment']` in `functions.php`.

= 1.1.0 – 24.04.2017 =

**Added**

* Elements with `size-full` class can go beyond the content area if no sidebar is active.

**Changed**

* Set max width to 1334 px instead of 1600px.
* Doc improvements.
* Removed update of image sizes.
* Content is centered if no widgets in sidebar.
* Switched to florianbrinkmann.com URL in style.css and footer credits link.

= 1.0.13 – 30.05.2016 =

**Changed**

* removed deprecated theme tags from `style.css`.
* removed unnecessary defaults from `bornholm_customize_register()`.

= 1.0.12 – 13.12.2015 =

**Changed**

* removed `height: auto` for iframes and embeds.

= 1.0.11 – 19.11.2015 =

**Fixed**

* removed unnecessary function call.

= 1.0.10 – 19.11.2015 =

**Fixed**

* corrected wrong label in the customizer.

= 1.0.9 – 08.11.2015 =

**Changed**

* removed languages directory so all translations will be shipped from translate.WordPress.org.
* a few small enhancements.

= 1.0.8 – 08.10.2015 =

**Fixed**

* added missing blank after ”Trackback:“ in `functions.php`.

= 1.0.7 – 08.10.2015 =

**Changed**

* rename `bornholm_more_link` function to `bornholm_the_content`.
* moved a part from the functions in `functions.php` to external files in inc directory.
* replace screenshot.png with new one which shows images under CC0 Public Domain.

= 1.0.6 – 01.09.2015 =

**Changed**

* added effective functions for sanitizing radio buttons and checkboxes.

= 1.0.5 – 30.08.2015 =

**Changed**

* added escaping functions.

= 1.0.4 – 23.07.2015 =

**Changed**

* Removed unused parameter from two function calls in functions.php.

= 1.0.3 – 23.07.2015 =

**Fixed**

* Wrong home link if WordPress is installed in subdirectory.

= 1.0.2 – 17.06.2015 =

**Added**

* Added lightbox (ImageLightbox.js by Osvaldas Valutis).

= 1.0.1 – 14.06.2015 =

**Fixed**

* Small issue with floating element and the footer.

= 1.0 – 14.06.2015 =

**Fixed**

* initial release.
