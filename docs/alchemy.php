<?php

/*

Meta Classes:

-------WPAlchemy_MetaBox 		- Base metabox class for saving metadata to a post
	|
	|------HH_Alchemy			- Extends the base class enabling pre built controls + extras
		|
		|------HH_Settings 		- Extends HH_Alchemy enabling use on admin settings pages, saving to user options
		|		
		|------HH_Tax_Meta 		- Extends HH_Alchemy enabling use on taxonomy terms, saving to user meta
		|		
		|------HH_User_Meta 	- Extends HH_Alchemy enabling use on user pages, saving to user meta
	
	Alchemy Args:
		META TYPE	-	KEY				-	TYPE	-	DESCRIPTION
		hh_alchemy		capability			string		A capability requirment to view and edit the meta
		hh_alchemy		sectionHeight		int/str		Set a height for each control in the metabox (if int will be pixles)
		hh_alchemy		controls			array		an array of controls see below for list of controls and options
		settings		icon				string		Url to an icon to use in the menu
		settings		group				integer		Position in menu
		settings		parent_slug			string		Make the page a sub menu by specifying the parent slug
	
Control Types:

	All Controls:
		NAME			-	KEY			-	DESCRIPTION
		Text Notice		-	notice		-	Developer text notice to the user (paragraph)
		Textbox			-	text		-	Simple one line text input 
		Large Textarea	-	textarea	-	Simple multiple line text input
		Select Box		-	select		-	Dropdown selection box
		Radio Buttons	-	radio		-	Multiple choice, can only select 1 option
		Checkboxs		-	checkbox	-	Multiple choice, can select any options
		Image Select	-	image		-	Uses thickbox to get media resourse ID (with preview)
		File Select		-	file		-	Uses thickbox to get media resourse ID (with url)
		WP Editor		-	wysiwyg		-	Complex tinyMCE multiple line text editor (doesn't work in multi)
		Template File	-	template	-	Grab the output/code from an external file
		Multiple Fields -	multi		-	Sets up a repeatable area of the metabox
		Multi Radio		-	multiradio	-	Displays diffrent controls depending on selected radio option
		Color Picker	-	colorpicker	-	Displays a color picker

Arguments:

	Required Args:
		CONTROL		-	KEY			-	TYPE	-	DESCRIPTION
		all			-	type		-	string	-	Defines the type of control, ie 'text' / 'select'
		all			-	id			-	string	-	ID is used as a key to store/get the data

	Optional Args:
		CONTROL		-	KEY			-	TYPE	-	DESCRIPTION
		all			-	title		-	string	-	A name to give the control context to the user
		all			-	description	-	string	-	A description or tooltip to help the user
		all			-	height		-	string	-	A section height override, integer in px, don't abuse it!
		all			-	width		-	string	-	A section width override, string 'full' or 'half', don't abuse it!
		all			-	add_column	-	boolean	-	Add the field to the the admin index list true or false

	Special Args:
		CONTROL		-	KEY			-	TYPE	-	DESCRIPTION
		notice		-	tag 		- 	string  -	The HTML tag to use on the title, i.e. strong, h2, h3, h4, p, span
		checkbox	-	datatype 	- 	string  -	You can use 'posts_via_type', 'terms_via_taxonomy' or 'raw'
		radio		-	datatype 	- 	string  -	You can use 'posts_via_type', 'terms_via_taxonomy' or 'raw'
		select		-	datatype 	- 	string  -	You can use 'posts_via_type', 'terms_via_taxonomy' or 'raw'
		select		-	data		- 	array 	-	Key = value attribute, value = textnode OR array of post types
		image		-	rel			- 	string 	-	Used in the media manager to customise buttons and titles
		file		-	rel			- 	string 	-	Used in the media manager to customise buttons and titles
		checkbox	-	data 		- 	array	-	Key = value attribute, value = textnode
		radio		-	data 		- 	array	-	Key = value attribute, value = textnode
		multiradio	-	data 		- 	array	-	Key = value attribute, value = child title
		multiradio	-	children 	- 	array	-	Key = Key in data array, value = an array containing arrays of the children
		multi		-	children 	- 	array	-	An array containing the arrays of the children
		multi		- 	itemname 	- 	string	-	The name for items in the multi
		template 	-	template 	- 	string	-	Absolute url

*/
