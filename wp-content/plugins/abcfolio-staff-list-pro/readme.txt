=== Staff List Pro ===
Author URI: http://www.abcfolio.com
Plugin URI: http://abcfolio.com/wordpress-plugin-staff-list/
Contributors: abcFolio
Tags:  employees, faculty, staff, staff directory, team members, grid gallery
Requires at least: 4.5
Tested up to: 4.8.0
Stable tag: 2.0.1

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl.html

== Description ==

**Staff List Pro**

== Changelog ==

= 2.0.1 20171002 =
* Update: Static text - added check for text editor content.
* Fix: Static text - now shows up on staff member data entry forms.

= 2.0.0 20170920 =
* Fix: Shortcode tab empty.

= 1.9.9 20170917 =
* New: Added Form Action field. Allows scrolling to anchor after form submit.

= 1.9.8 20170907 =
* Update: PHP 7.1 compatibility.
* Update: Added page title support for custom permlinks plugin

= 1.9.7 20170903 =
* Update: Added support for custom permlinks plugin (abcfslcp_is_single_pretty).
* Fix:  Missing BR tag added to abcfl_mbsave_save_allowed_tags

= 1.9.6 20170829 =
* Fix: Fixed PHP 7.1 error "[] operator not supported for strings"

= 1.9.4 20170827 =
* New: Added option to copy field content into Sort Text field.
* New: Shortcode option - top numer of records.
* Update: Added ID multi filter containers abcfslMFilterCntr
* Update: Category slugs won't show errors if there are no records linked to it.

= 1.9.3 20170821 =
* New: Added Static Label field.
* Update: Text fields will accept most of the HTML tags (library).
* Update: Redesigned Image ID handling.
* Update: Added Alt field.
* Fix: Palceholder custom images - fixed image select.

= 1.9.2 20170816 =
* Update: Plugin-updates library to version 4.2.

= 1.9.0 20170812 =
* Update: Added icon: phone.
* Update: Updated plugin-updates section to the new version.
* Fix: Field values SP, NT and tel: converted to Structured Data.

= 1.8.9 20170811 =
* New: Now you can add Structured Data to both list and single pages.
* New: Canonical URLs can be customized with our free plugin: No Canonical.
* Update: Improved quering of hidden records. Moved all checks to DB section.
* Fix: Modified function add_filter 'parse_query' to avoid conflict with Yoast SEO.

= 1.8.8 20170719 =
* New: Shortcode filter sort: ASC/DESC
* Update: Redesigned SQL to better handle mutifilters and menus.
* Update: Redesigned sort order update to better handle a large number of records.

= 1.8.6 20170715 =
* Update: Redesigned data entry for images to better handle image IDs.
* Update: Added option to get image alt even if there is no image ID.
* Update: Redesigned data entry for image placeholders to better handle image IDs.
* Update: Changed image selection JS script.
* Update: Redesigned SQL to better handle categories and AZ menus.
* Update: Hidden records are now exluded from paging counts.
* Update: Shordcode category parameter can have multiple categories.

= 1.8.4 20170712 =
* Fix: Hidden records included in total for paging control.

= 1.8.3 20170711 =
* Fix: Hidden records removed from paging count.

= 1.8.2 20170622 =
* Update: Added option No Records message to individual menus.
* Update: Grid A, text container. Updated code to handle image placeholders.

= 1.8.1 20170621 =
* Fix: AZ filter now saves filter parameters.

= 1.8.0 20170620 =
* New: Image placeholders.
* Update: Updated category section to handle multiple instances of the same filter type.
* Update: Paragraph text now accepts hyperlinks.
* Update: Removed add_role_caps from admin_init. Custom caps are added on activation hook.
* Update: Moved menu tab. Added deprecated warning.
* Fix: Fixed link to Pagination help page.

= 1.7.9 20170611 =
* New: Circular Image option.
* New: Custom social icons: Marker and Pinterest.
* Update: Input library. Added function to handle checkbox help links.

= 1.7.7 20170606 =
* Update: Added Custom Dropdown filter option to sync with Staff Search options.
* Fix: AZ dropdown. Keys to lowercase.

= 1.7.6 20170602 =
* Fix: Removed Text Search from list of filters.

= 1.7.5 20170531 =
* Update: Improved data formating and sanitizations for filter inputs.

= 1.7.4 20170528 =
* Tweak: Integrated search features with Staff Search add-on.

= 1.7.3 20170510 =
* Fix: Misspeled parameter name itemID.

= 1.7.1 20170507 =
* New: Menu shortcode parameter.
* Fix: HTML library misspelled function name.
* Fix: Hide Record doesn't leave blank space anymore.

= 1.7.0 20170506 =
* New: Multi Filter.

= 1.6.6 20170505 =
* New: Image hover effects.
* Update: Removed discontinued CSS.
* Update: Changed pagination sizes from rem to px for better compability with themes having base font != 16px;
* Fix: Handle no AZ list in AZ menu. Used to generate an error.
* Update: Changed single page $pgLayout to 100.
* Update: Removed duplicate class abcfslImgCenter. $imgCenterCls ?????? _imgCenter
* Update: Changed image container rendering to accomodate hover effects and single page.

= 1.6.5 20170502 =
* Fix: Handle no AZ list in AZ menu. Used to generate an error.

= 1.6.4 20170405 =
* Fix: Shortcode random option.

= 1.6.3 20170404 =
* New: Custom message to show when cataegories or AZ menu item has no data.
* New: Admin filters: Templates and Categories
* Fix: AZ Menu, field ID. Added new fields 21-40.

= 1.6.2 20170328 =
* New: Pagination.
* New: Shortcode parameter to show a single staff member, grid or a single page.
* Fix: Removed query parameter slpcat (replaced with staff-category).

= 1.6.1 20170314 =
* Fix: Removed a few lines of CSS. Should be used for testing only.

= 1.6.0 20170313 =
* Fix: Added missing nonce to the script items manual sort.
* Update: Restored Quick Edit for Staff Members

= 1.5.9 20170311 =
* Fix: Items sort table. Fixed rendering issues in Chrome.

= 1.5.8 20170308 =
* Fix: Added missing legacy code to autil library.

= 1.5.7 20170308 =
* Update: Single page can only show published posts. Status = publish.
* Fix: Static label & text. Custom CSS page type prefixes.

= 1.5.6 20170303 =
* Update: Default template fields displayed on add new.
* Update: Permissions for options and license pages.
* Update: Removed tabs.js, show-advanced.js
* Fix: Added missing icon.

= 1.5.5 20170303 =
* New: Default template option.
* New: Quick Start option.

= 1.5.4 20170226 =
* New: Option to convert one template layout to another layout.
* Fix: Fixed field names for static label custom style.

= 1.5.3 20170206 =
* Update: Custom roles can be created for staff member editors.

= 1.5.2 20170206 =
* Update: Custom caps testing version.

= 1.5.1 20170204 =
* Update: Added custom caps for staff members, taxonomy and menu.

= 1.5.0 20170124 =
* New: Added tab Single Page to template options.
* Update: Added field Single Page Text Link to template options.
* Update: Removed option to add field: 'SH' Single Page Hyperlink
* Update: Added discontinued field notice to SH fields.

= 1.4.0 20170118 =
* New: Increased field number from 20 to 40.
* Update: Added span containers to each of the parts of multipart field.
* Update: Library files to better acomodate direct links to documentation.
* Update: Added Segoe Semibold to library CSS to fix 600 font rendering in Firefox.
* Update: Changed font name for some labels to fix 600 font rendering in Firefox. .
* Update: Removed SH field from staff member screen.

= 1.3.2 20170114 =
* New: Direct links to Documentation sections.
* Update: Removed legacy menu code: catPgTxt, catPgURL.
* Update: Changed admin font stack to system fonts (as per WP 4.6).
* Update: Added 'p' tag to paragraph $allowedTags.
* Fix: Multipart field description.

= 1.3.1 20161229 =
* Fix: Order by Sort Text.

= 1.3.0 20161228 =
* New: Added field "Single Page Link" SH.
* Update: Demo records.
* Fix: Order by Sort Text.

= 1.2.4 20161226 =
* Update: Moved all require_once to main file
* Update: Added option 'NT SP'
* Fix: Link "Why Single Page is blank" points to the right help section.

= 1.2.3 20161217 =
* New: Shortcode parameter "random".
* Update: Menu Category. ALL can be set as a last menu item.

= 1.2.2 20161210 =
* New: Pretty permalinks single page names: profil, perfil, profilo.

= 1.2.1 20161208 =
* New: Option to show All Categories as a last item.

= 1.2.0 20161127 =
* New: Single page pretty permalinks.
* New: Single page custom title.
* Fix: Moved template tabs includes to the main file, admin section.

= 1.1.4 20161115 =
* Fix: Hide Record update (hideSMember).

= 1.1.2 20161114 =
* Fix: Twitter spelling error in mbox_item_social.
* Update: abcfsl_util_get_target
* New: abcfsl_util_imgs_folder_url

= 1.1.1 20161105 =
* New: Icon Home.

= 1.1.0 20161102 =
* Update: Added the_content filter to execute shortcodes from HTML field.
* New: Added field type Shortcode.

= 1.0.3 20161025 =
* New: Added option to hide Staff Member record.
* New: NT hyperlink prefix to open link in a new tab.
* Fix: YouTube icon to lowercase.

= 1.0.2 20160908 =
* Fix: Minor bugs fixed: Visual Assistance.
* Update: Changed image ID section.
* Update: abcfl-admin to 1.2.3

= 1.0.1 20160807 =
* Fix: Minor bugs fixed.

= 1.0.0 20160804 =
* New: Vertical tabs script and CSS.
* Enhancement: Interface update. Replaced horizontal tabs with vertical ones.
* Enhancement: Template screen. Added field label to field IDs.
* Enhancement: Added links to the documentation pages.

= 0.9.0 20160802 =
* New: Calendar and Link icons
* Update: Redesigned Single Page layout. Added top and bottom sections.

= 0.8.4 20160719 =
* Update: Changed menus rendering code.
* Update: Menus can be selected from a template or added directly to a page as a shortcode.

= 0.8.3 2010712 =
* Fix: Minor bug: Missing Undefined index: menu-az.

= 0.8.1 20160711 =
* Update: Added select menu option to all templates.
* Update: Added vAid option to Grid A and List tempaltes.
* Update: Changed shortcodes to better match template names.

= 0.8.0 20160710 =
* New: A-Z filter and Menu builder.
* New: 4 parts text field (Name Field).
* Update: Now menu can be added by selecting it from a template.
* Update: Discontinued menu shortcode option. Menu can be selected directly from a template.
* Fix: Changed code to make sure legacy menu shortcodes will work.

= 0.7.4 20160622 =
* New: Optional shortcode parameter 'staff-id' to display single staff member.

= 0.7.3 20160622 =
* Fix: Grid layout. Missing row closing DIV tag when row was not full.

= 0.7.2 20160619 =
* New: Viadeo icon
* New: Shortcode parameter: master.

= 0.7.1 20160619 =
* New: Grid B layout.
* Update: CSS.
* Update: Menus can use qry parameter or shortcode category.
* Fix: abcfslLstCol { -moz-box-sizing: border-box; box-sizing: border-box;
* Fix: Text editor, Hyperlink, Static Text + Hyperlink: don't render if URL empty
* Fix: Changed label Template Locked to Field Locked.
* Fix: Social links top margin.


= 0.6.1 20160528 =
* New: Categories Menu section.
* New: Added social icons: GraduationCap, GoogleScholar.
* Update: Removed option show advanced fields .js and showAll.
* Fix: Added missing icon names to icon basename function.

= 0.5.4 20160526 =
* Final version before Categories menu.

= 0.5.3 20160521 =
* New: Added URL query parameter 'slpcat'. It can be used to filter content by category.
* Update: Static Label & Text template interface. Removed dividers.
* Fix: Input Field tabs 11-20 now open on click.

= 0.5.1 20160517 =
* Update: Changed min permissions to Editor.

= 0.5.0 20160516 =
* Update: Updated library, updated a few labels.

= 0.4.9 20160514 =
* Update: Paragraph Text  filed now accepts limited HTML tags: b, br, em, i, strong.
* Update: Library functions in: abcfl-mbox-save, abcfl-input. Added code to handle HTML tags.

= 0.4.8 20160422 =
* New: Text field top margin can be selected from the dropdown.
* New: Text font can be selected from the dropdown.
* New: Image borders and center options can be selected from the dropdown.
* Update: Modified templates interface for better user experience
* Update: Moved page layout options to page layout tabs.
* Update: Deleted layout: List Image Top, Text Bottom. Grid with a sigle column is a better option.
* Update: Deleted custom class inputs for: Grid item left + right margins. Replaced with dropdown.
* Update: Deleted custom class inputs for: Grid item bottom margins. Replaced with dropdown.
* Update: Grid item legacy classes left, right and bottom margin are copied to Custom Class CSS.
* Fix: Added list content container custom width to custom style.

= 0.4.6 20160407 =
* Fix: Comments in CSS file.
* Fix: Multisite install error.

= 0.4.5 20160323 =
* Fix: Email icons now opens email client.

= 0.4.4 20160322 =
* New: Social Media icons.

= 0.4.1 20160311 =
* New: Replaced single data entry screen with Staff page and Single page.
* New: Replaced field ordering panel with with two panels: Staff and Single page.
* New: Added dropdown for Hide/Delete options.
* Update: Removed Hide/Delete from Show Field On.
* Update: Modified data fields layout to simplify data entry.
* Update: Shortcode descriptions.
* Fix: Undefined variable: inputLinkUrlHlp.

= 0.3.7 20160304 =
* Fix: Added missing utility file.

= 0.3.6 20160304 =
* Update: Udated shortcode tab and instructions.
* Update: Redesigned the Grid section.
* Update: Added some new CSS.

= 0.3.5 20160228 =
* Fix: File name changed

= 0.3.4 20160225 =
* Fix: Staff member data entry screen tabs

= 0.3.3 20160220 =
* Update: Replaced default abcfslLstRowCntrPadBMB with abcfslPadBMB30

= 0.3.2 20160215 =
* Update: Replaced trashed_post with wp_insert_post_data filter. to better handle template delete when it has staff members

= 0.3.1 20160215 =
* Fix: ABCFSL_MBox_List bug fix

= 0.3.0 20160215 =
* Update: Changed main file name.
* Update: Replaced checker ABCFSL_PLUGIN_FOLDER with slug.

= 0.2.9 20160215 =
* Update: Changed fields ID labels to match sort fields screen.

= 0.2.8 20160213 =
* New: Categories.

= 0.2.7 20160212 =
* Update: Changed to Pro.
* Update: Removed ABCFSL_VERSION. replaced with class var.
* New: Added post ID column do list of posts (WP admin).

= 0.2.6 20160208 =
* Update: Changed custom CSS file name to abcfolio/custom-staff-list.css.
* Update: Added plugin version to container class.

= 0.2.5 20160204 =
* New: Text Container Width = Image Width.
* New: CSS added horizontal line.

= 0.2.4 20160127 =
* Fix: Url to contact-us page.

= 0.2.3 20160127 =
* Update: Cleanup. Testing demo.

= 0.0.1 20151107 =
* Initial version.

