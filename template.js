/**
 * wpcollab-plugin-skeleton
 * https://github.com/WPCollab/wpcollab-plugin-skeleton
 *
 * Copyright (C) 2014 WPCollab Team (https://github.com/WPCollab/wpcollab-plugin-skeleton/graphs/contributors)
 * Licensed under the MIT License
 *
 * based on grunt-wp-boilerplate (https://github.com/fooplugins/grunt-wp-boilerplate) by Brad Vincent, FooPlugins LLC
 */

/**
 * @todo STRINGS
 *
 * title
 *	title_underscores = %title + make spaces into underscores
 *	title_camel_capital = %title + remove spaces
 *	title_camel_lowercase = %title + remove spaces and make lowercase
 *
 * homepage
 * description
 * slug
 * github_repo
 */

'use strict';

// Basic template description
// @todo exports.description = 'Create a ' %dev ' plugin skeleton!'; // @todo how to do this?

// Template-specific notes to be displayed after the question prompts.
exports.after = 'The plugin skeleton has been generated. Start coding!';

// Any existing file or directory matching this wildcard will cause a warning.
exports.warnOn = '*';

// The actual init template
exports.template =
	function(grunt, init, done) {
		init.process(
			{},
			[
				// Prompt for these values.
				init.prompt('title', 'Plugin Title'),
				init.prompt('slug', 'plugin-slug'),
				init.prompt('description', 'An awesome plugin that does awesome things'),
				{
					name: 'version',
					message: 'Plugin Version',
					default: '0.0.1'
				},
				init.prompt('homepage', 'http://wordpress.org/plugins'),
				init.prompt('dev', 'WPCollab'),
				init.prompt('dev_long', 'WPCollab Team'),
//				init.prompt('author_url'),
				init.prompt('github_repo')
			],
			function(err, props) {

				props.dev_lowercase = props.dev.toLowerCase();
				props.title_underscores = props.title.replace(/[\W_]+/g, '_');
				props.title_camel_capital = props.title.replace(/[\W_]+/g, ''); // @todo working?
				props.title_camel_lowercase = ( props.title.replace(/[\W_]+/g, '_') ).toLowerCase(); // @todo lowercase-ing - Is this right?

				// Files to copy and process
				var files = init.filesToCopy(props);

				//delete a file if necessary :
				//delete files[ 'public/assets/js/public.js'];

				console.log(files);

				// Actually copy and process files
				init.copyAndProcess(files, props, {noProcess: 'assets/**'});

				// Generate package.json file
				//init.writePackageJSON( 'package.json', props );

				// Done!
				done();
			}
		);
	};