module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        sass: {
            options: {
                includePaths: ['bower_components/foundation/scss']
            },
            dist: {
                options: {
                    outputStyle: 'compressed'
                },
                files: {
                    '../public/css/msn.css': 'scss/msn.scss'
                }
            }
        },

        jshint: {
            gruntfile: ['Gruntfile.js'],
            dist: ['js/msn.js']
        },

        uglify: {
            options: {
                preserveComments: false,
                mangle: false,
                compress: {
                    drop_console: true
                }
            },
            dist: {
                files: {
                    'js/msn.min.js': 'js/msn.js'
                }
            }
        },

        concat: {
            options: {
              separator: ';\n',
            },
            dist: {
                src: [
                    'bower_components/jquery/dist/jquery.min.js',
                    'bower_components/foundation/js/foundation.min.js',
                    'bower_components/slick.js/slick/slick.min.js',
                    'js/msn.min.js'
                ],
                dest: '../public/js/msn.min.js',
            },
        },

        clean: {
            dist: ['js/msn.min.js'],
        },

        svgmin: {
            options: {
                plugins: [
                    {removeViewBox: false},
                    {removeUselessStrokeAndFill: false}
                ]
            },
            dist: {
                files: [{
                    expand: true,
                    cwd: 'images/svg',
                    src: '**/*.svg',
                    dest: '../public/images/svg'
                }]
            }
        },

        copy: {
            dist: {
                files: [
                    {
                        expand: true,
                        flatten: true,
                        src: ['bower_components/slick.js/slick/fonts/*'],
                        dest: '../public/fonts/'
                    },
                    {
                        flatten: true,
                        expand: true,
                        src: ['bower_components/slick.js/slick/ajax-loader.gif'],
                        dest: '../public/',
                        filter: 'isFile'
                    },
                    {
                        expand: true,
                        flatten: true,
                        src: ['bower_components/fontawesome/fonts/*'],
                        dest: '../public/fonts/'
                    }
                ]
            }
        },

        watch: {
            grunt: {
                files: ['Gruntfile.js'],
                tasks: ['build']
            },
            sass: {
                files: 'scss/**/*.scss',
                tasks: ['sass']
            },
            js: {
                files: ['js/**/*.js'],
                tasks: ['jshint', 'uglify', 'concat', 'clean']
            },
            svg: {
                files: ['images/svg/**/*.svg'],
                tasks: ['svgmin']
            }
        }
    });

    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-svgmin');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.registerTask('build', ['sass', 'jshint', 'uglify', 'concat', 'clean', 'copy', 'svgmin']);
    grunt.registerTask('default', ['build', 'watch']);
};
