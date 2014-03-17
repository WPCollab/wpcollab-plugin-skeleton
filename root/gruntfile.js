module.exports = function (grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			files: {
				src: 'js/*.js',
				dest: 'js/',
				expand: true,
				flatten: true,
				ext: '.min.js'
			}
		},
		sass: {
			dist: {
				options: {
					style: 'expanded'
				},
				files: {
					'css/admin.css' : 'css/scss/admin.scss',
					'css/frontend.css' : 'css/scss/frontend.scss'
				}
			},
			dist2: {
				options: {
					style: 'compressed'
				},
				files: {
					'css/admin.min.css' : 'css/scss/admin.scss',
					'css/frontend.min.css' : 'css/scss/frontend.scss'
				}
			}
		},
		makepot: {
			options: {
				exclude: [ 'node_modules/**' ],
				mainFile: 'uber-media.php',
				potFilename: 'media-manager-plus.pot',
				type: 'wp-plugin'
			}
		},
		po2mo: {
			files: {
				src: 'languages/*.po',
				dest: 'languages/*.mo',
			},
		},
		watch: {
			js:  {
				files: 'js/*.js',
				tasks: [ 'uglify' ]
			},
			sass: {
				files: 'css/scss/*.scss',
				tasks: ['sass']
			},
			po2mo: {
				files: 'languages/*.po',
				tasks: ['po2mo']
			}
		}
	});

// load plugins
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-wp-i18n');
	grunt.loadNpmTasks('grunt-po2mo');

// register at least this one task
	grunt.registerTask('default', [ 'watch' ]);
};
