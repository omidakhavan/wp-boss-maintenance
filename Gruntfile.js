'use strict';
module.exports = function(grunt) {

    grunt.initConfig({

        uglify: {

            options: {
            },
            front_js: {
                src: 'public/js/hdm-maintenance-js.js',
                dest: 'public/js/hdm-maintenance.min.js'
            },
            admin_js: {
                src: 'admin/js/hdm-maintenance.js',
                dest: 'admin/js/hdm-maintenance.min.js'
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
                  'public/css/hdm-maintenance.min.css' : ['public/css/hdm-maintenance-style.css' , 'public/css/hdm-maintenance-animation.css']
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