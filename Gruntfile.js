'use strict';
module.exports = function(grunt) {

    grunt.initConfig({

        uglify: {

            options: {
            },
            front_js: {
                src: 'public/js/avma-maintenance-js.js',
                dest: 'public/js/avma.min.js'
            },
            admin_js: {
                src: 'admin/js/avma-maintenance.js',
                dest: 'admin/js/avma.min.js'
            }
        },

        // javascript linting with jshint
        jshint: {
            options: {
                jshintrc: '.jshintrc',
                "force": true
            }
        },
        // ccs min task
        cssmin: {
              options: {
              },
              target: {
                files: {
                  'public/css/style.min.css' : ['public/css/style.css' , 'public/css/animation.css']
                }
              }
            }

    });
    // load task
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    //register task
    grunt.registerTask('default', ['uglify']);
    grunt.registerTask('default', ['cssmin']);
    grunt.registerTask('default', ['jshint']);
};