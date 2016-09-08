
module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            sass: {
                files: '**/*.scss',
                tasks: ['sass:dist']
            },
            livereload: {
                files: ['*.html', '*.php', 'js/**/*.{js,json}', 'css/*.css','images/**/*.{png,jpg,jpeg,gif,webp,svg}'],
                options: {
                    livereload: true
                }
            },
            scripts: {
                files: ['library/js/*.js'],
                tasks: ['uglify'],
                options: {
                  spawn: false,
                }
              },
              css: {
                files: ['library/css/*.css'],
                tasks: ['cssmin'],
                options: {
                  spawn: false,
                }
              },
              images: {
                files: ['library/images/**/*.{png,jpg,gif}', 'library/images-min/*.{png,jpg,gif}'],
                tasks: ['imagemin'],
                options: {
                  spawn: false,
                }
              }
        },
        sass: {
            dist: {
                files: {
                    'library/css/style.css' : 'library/scss/style.scss'
                },
                options: {
                    sourcemap: 'true'
                }
            }
        },
        uglify: {
            build: {
                src: 'library/js/scripts.js',
                dest: 'library/js/scripts.min.js'
            }
        },
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'library/images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'library/images/'
                }]
            }
        },
        cssmin: {
          combine: {
            files: {
              'library/css/style.min.css': ['library/css/style.css']
            }
          }
        }
    });

    require('load-grunt-tasks')(grunt);

    grunt.registerTask('default', ['sass', 'cssmin', 'imagemin', 'uglify']);

    grunt.registerTask('dev', ['watch']);

    
};