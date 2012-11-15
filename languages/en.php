<?php
/**
 *	Elgg-ggouv_template plugin
 *	@package elgg-ggouv_template
 *	@author Emmanuel Salomon @ManUtopiK
 *	@license GNU Affero General Public License, version 3 or late
 *	@link https://github.com/ggouv/elgg-ggouv_template
 *
 *	Elgg-ggouv_template English language
 *
 */

$english = array(

	/**
	 * Comment
	 */
	'comment:error'  =>  "Error saving comment",
	'comment:edited' => "Comment Edited",
	'comment:edit' =>"Edit comment",

	/**
	 * Members
	 */
	'members:label:newest' => 'Newest',
	'members:label:popular' => 'Popular',
	'members:label:online' => 'Online',
	'members:searchname' => 'Search members by name',
	'members:searchtag' => 'Search members by tag',
	'members:title:searchname' => 'Member search for %s',
	'members:title:searchtag' => 'Members tagged with %s',
	'friends:following' => "Following",
	'friends:title:following' => "Your Following",
	'friends:followers' => "Followers",
	'friends:title:followers' => "Your Followers",

	/**
	 * Groups
	 */
	'groups:summary:members' => "Group<br/>members",
	'groups:summary:created' => "Created %s",
	'groups:metagroup' => "Meta group",
	'groups:typogroup' => "Typo group",
	'groups:localgroup' => "Local group",
	'groups:metagroups' => "Meta groups",
	'groups:typogroups' => "Typo groups",
	'groups:localgroups' => "Local groups",
	'groups:localgroup:departement' => "Departement",
	
	/**
	 * Forms
	 */
	'ggouv:search:localgroups' => "Search local group by postal code or name :",
	'ggouv:search:localgroups:notfound' => "Nothing found.",
	'xoxco:removing_tag' => "Removing tag",
	'xoxco:input:default' => "add a tag (separate with commas)",
	'ggouv:longtext:help' => "Syntaxe markdown accéptée :<br/>**gras**",

	/**
	 * System message
	 */
	'groups:error:more_five_groups' => "You cannot create more five groups.",
	
	/**
	 * Plugin settings
	 */
	'ggouv_template:markdown_wiki_page_for_home' => "Guid of the home page",
	'ggouv_template:markdown_wiki_page_for_translation' => "Guid for page translation",
	'ggouv_template:bot_string' => "Bot with admin right",
	
);

add_translation("en", $english);
