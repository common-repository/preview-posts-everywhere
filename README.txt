=== Plugin Name ===
Contributors: Pawel Wawrzyniak
Donate link: http://wpsamurai.pl/preview-posts-everywhere
Tags: draft, preview draft, preview posts, preview post, preview
Requires at least: 3.5.1
Tested up to: 4.0
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to preview your drafts on home, category, archive and search pages (and in many other places).

== Description ==

Without that plugin you could preview every post in draft status just by clicking Preview button on post edit page. Unfortunately, that preview is available only for single page template. If you open home or category page you won’t see any drafts there.

Preview Posts Everywhere plugin will allow you to preview your drafts on home, category, archive and search pages. Now you can check your draft’s featured images, dates, titles on every page, before you publish the post.

Plugin works out of the box and after activation just go to home page to see your drafts on posts list. You do not need to click any preview button! Just go to your site and check list of posts. Remember that by default drafts will be visible only for logged in users with assigned Administrator role.

If you want to see your drafts also in widgets (for example on widget with latest posts list) just go to settings page (Settings->Preview Posts Everywhere) and check “Add drafts to all queries” option.

To be more strict, when option “Add drafts to all queries” is checked, drafts will be added in all places where WP_Query and The Loop are used.

== Installation ==

= Using The WordPress Dashboard =
 
1. Upload 'preview-posts-everywhere' to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Done :)
1. You can find a few settings under Settings->Preview Posts Everywhere (in most cases you do not need to change here anything)
    
    
== Frequently Asked Questions ==

= Will visitors be able to see my drafts? =

No, drafts will be visible only for logged in users that have assigned proper role (administrator by default)

= Why I don't see drafts in sidebar widget? =

By default drafts will be added only to main queries (for example query that select posts to display on home or category page).
To display drafts everywhere, go to settings page (Settings->Preview Posts Everywhere) and check "Add drafts to all queries"
    
= After install I do not see any drafts on frontpage =    

Troubleshooting

1. Make sure that you have at least one draft  :)
1. You have to be logged in to see drafts
1. By default drafts are visible only for users with Administrator role.
   To check role assigned to your user, go to Users menu, find user on list and click Edit. Assigned role will be visible on list.
   You can select all roles that should see drafts in Settings->Preview Posts Everywhere. 
1. Sometimes plugin do not use main query to get data. You can try to check “Add drafts to all queries” option in Settings->Preview Posts Everywhere to add drafts to all queries.
1. Some cache plugins (like WP Super Cache) by default are caching pages for logged in users. If you do not see drafts, disable that option or just refresh cache.
1. If you cache plugin do not differentiate cache for logged in and normal users then be aware that it is possible that normal users will see your drafts
   that was cached during your admin session!         
    
== Screenshots ==

1. Settings page

== Changelog ==

= 1.0.1 =
* Fixed problems with native galleries
  http://wordpress.org/support/topic/breaks-wp-native-galleries
= 1.0 =
* Initial release
