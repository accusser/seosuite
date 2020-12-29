# SEO Suite
![SEO Suite version](https://img.shields.io/badge/version-2.0.0-brightgreen.svg)
![MODX Extra by Sterc](https://img.shields.io/badge/extra%20by-sterc-ff69b4.svg)
![MODX version requirements](https://img.shields.io/badge/modx%20version%20requirement-2.5%2B-blue.svg)

[SEO Suite][1] was introduced by [Sterc][3] as a MODX Extra that automatically redirects your 404 URLs to relevant pages on your website. 404 errors are a fairly common issue for anyone who’s transitioning from an old website to a new website. SEO Suite makes sure your visitors are redirected to a relevant page when they’re looking for an old URL.

## SEO Suite v2.0
SEO Suite 2.0 combines the power of three extras, SEO Pro, SEO Tab and SEO Suite v1 into one powerful SEO extra. Not only have these three extra's been combined into one, but the codebase has gone through a large refactor and some great new features have been added. 

A custom panel dedicated to your focus keywords, meta title and description has been added, where you can view and switch between Google/Yandex previews or viewing the desktop or mobile preview. All search engine related properties have been gathered in a separate Search engine tab. A new tab "Social" has been added where you can manage the metadata used by Facebook and Twitter.

**Note:** A migration is required when you're upgrading from SEO Suite v1.0 to v2.0.

### Key features
* Preview Google/Yandex search results on desktop and mobile
* Manage search engine visibility (noindex, nofollow)
* Manage internal search engine behavior
* Manage your Google XML Sitemap(s)
* Manage social media previews for Facebook using the Open Graph protocol and Twitter Cards markup 
* Manage 301 redirects
* Automatically generates 301 redirects when changing a resource URL
* When someone visits a non-existent page (404) on your website, the URL will be automatically added to SEO Suite so you can redirect it to an existing page.
* SEO Suite comes with a Dashboard widget, showing the 10 newest SEO Suite URL's
* It is possible to import a .csv file containing 404 URL's and then search for redirects inside only one (related) context. This comes in handy for multilingual websites.
* To get more specific redirect suggestions, you can exclude words from the matching system. **Pay attention:** when you add words to exclude **after** a .csv import, you might need to refresh the suggestions by clicking your right mouse button on the relevant 404 URL and choose 'Find suggestions'. After doing this, it will be refreshed.

## Bulk import 404 URLs
Through simply uploading a single column .csv file containing your 404 URLs, SEO Suite will look for similar pages on your website and redirect them automatically. This matching process is based on the URL information after the last slash (example.com/**this-information**).

1. Gather your 404 URLs in a single column .csv file by exporting them or adding them manually. Make sure you’ve entered full URLs, including the domain. Example: https://modx.org instead of modx.org.
2. Import the .csv file into SEO Suite.
3. SEO Suite will look for similarities between your 404 URLs and the pages on your website (make sure the pages are published):
   *  When there is one match, it will be automatically converted into a 301 redirect and stored in SEO Tab.
   *  When there are several matches, you can choose the desired redirect manually (by choosing from suggestions).
   *  When there are no matches, you can pick a redirect yourself (SEO Suite offers a search function so you can find a relevant redirect easily).

## Plugin
The SEO Suite plugin handles all events where SEO Suite has to act upon. It also sets placeholders (when enabled) onLoadWebDocument so you can easily retrieve SEO metadata and include it in your code. You can read more about this in the `SeoSuiteMeta` section.

## Snippets
SeoSuite comes with a few handy snippets for you to use.

### SeoSuiteMeta
This snippet retrieves all metadata for you to include in the head of your web page. These placeholders are also available by default when the setting `seosuite.placeholder_plugin_enabled` is enabled. 
Then the snippet is called from a plugin which sets these placeholders for you. If you rather take control in your own hands, you can disable the plugin using the system setting and call the snippet yourself.

Here's an example of all available placeholders of the SeoSuiteMeta snippet when toPlaceholders is turned on. 
```
<!-- Set by plugin. -->
[[!+ss_meta.meta_title]]
[[!+ss_meta.meta_description]]
[[!+ss_meta.robots]]
[[!+ss_meta.canonical]]
[[!+ss_meta.alternates]]
[[!+ss_meta.og_title]]
[[!+ss_meta.og_description]]
[[!+ss_meta.og_image]]
[[!+ss_meta.og_image_alt]]
[[!+ss_meta.og_type]]
[[!+ss_meta.twitter_site]]
[[!+ss_meta.twitter_title]]
[[!+ss_meta.twitter_description]]
[[!+ss_meta.twitter_image]]
[[!+ss_meta.twitter_image_alt]]
[[!+ss_meta.twitter_card]]
```

### SeoSuiteSitemap
Create sitemaps with the help of this snippet, by specifying a type, you can create different kinds of sitemaps:
* Page sitemap (default)
* Sitemap index containing child sitemaps, example structure:
  * Sitemap index: [[!SeoSuiteSitemap? &type=`index`]]
    * Page index: [[!SeoSuiteSitemap]]
    * Image index:  [[!SeoSuiteSitemap? &type=`images`]]
* Sitemap containing images.

Example usage:
```
[[!SeoSuiteSitemap]]
[[!SeoSuiteSitemap? &type=`index`]]
[[!SeoSuiteSitemap? &type=`images`]]
```

## Cronjobs
Inside the `core/components/seosuite/elements/cronjobs/` directory you can find the SeoSuite cronjobs.

### Redirect cleanup ###
Removes unresolved redirects which are older then 1 month and have been triggered just once.
   
Example usage:  

```php redirect-cleanup.php --till=2018-11-23 --triggered=2```

File: redirect-cleanup.php

| Property  | Description                                                                 | Default value          |
|-----------|-----------------------------------------------------------------------------|------------------------|
| till      | Till date for unresolved redirects to remove.                               | Current date - 1 month |
| triggered | Maximum amount of triggers for the unresolved redirects you want to remove. | 1                      |

## Future features
* 301 redirect statistics: SEO Suite will feature a custom manager page containing 301 redirects statistics.
A dashboard widget will be provided which shows the 10 redirects with the most hits.
* Automatically import 404's from Google Search Console.

## Bugs and feature requests
We greatly value your feedback, feature requests and bug reports. Please issue them on [Github][4].

[1]: https://www.sterc.nl/en/modx-extras/seosuite
[2]: https://modx.com/download
[3]: https://www.sterc.nl/en/
[4]: https://github.com/Sterc/seosuite/issues/new