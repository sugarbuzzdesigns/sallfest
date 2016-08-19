/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    dirs: {
      jsSrc: 'js/src',
      jsTmp: 'js/tmp',
      jsBuild: 'js/build',
      jsDist: 'js/dist',

      sassSrc: 'scss',
      cssSrc: 'css'
    },
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration.
    clean: {
      css: [
        'js/tmp',
        'js/build',
        'js/dist'
      ],
      js: [
        'js/tmp',
        'js/build',
        'js/dist'
      ],
      tmp: [
        'js/tmp',
      ]
    },
    concat: {
      options: {},
      build: {
        src: [
          '<%= dirs.jsSrc %>/plugins.js',
          '<%= dirs.jsSrc %>/main.js'
        ],
        dest: '<%= dirs.jsBuild %>/scripts.js'
      },
      dist: {
        src: [
          '<%= dirs.jsTmp %>/min/js/plugins.js',
          '<%= dirs.jsTmp %>/min/js/main.js'
        ],
        dest: '<%= dirs.jsDist %>/scripts.min.js'
      },
    },
    uglify: {
      options: {
        preserveComments: 'some'
      },
      main: {
        files: [{
          expand: true,
          cwd: 'js/src',
          src: ['plugins.js', 'main.js'],
          dest: 'js/tmp/min/js'
        }]
      }
    },
    jshint: {
      options: {
        curly: true,
        eqeqeq: true,
        immed: true,
        latedef: true,
        newcap: true,
        noarg: true,
        sub: true,
        undef: true,
        unused: true,
        boss: true,
        eqnull: true,
        globals: {}
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      site_js: {
        src: ['lib/**/*.js', 'test/**/*.js']
      }
    },
    sass: {                              // Task
      options: {                       // Target options
        style: 'expanded'
      },
      main: {                            // Target
        files: {                         // Dictionary of files
          '<%= dirs.cssSrc %>/style.css': '<%= dirs.sassSrc %>/style.scss',
        }
      }
    },
    watch: {
      gruntfile: {
        files: '<%= jshint.gruntfile %>',
        tasks: ['jshint:gruntfile']
      },
      jsMain: {
        files: '<%= dirs.jsSrc %>/*.js',
        tasks: ['jsBuild']
      }
    }
  });

  // These plugins provide necessary tasks.
  require('load-grunt-tasks')(grunt);

  // Default task.
  grunt.registerTask('dev', ['watch']);

  // build and concat main js and modules
  grunt.registerTask('jsBuild', ['clean:js', 'uglify', 'concat:build', 'concat:dist', 'clean:tmp']);

  // sass builds
  // grunt.registerTask('sassAdmin', ['sass:admin']);
  // grunt.registerTask('sassLogin', ['sass:login']);
  // grunt.registerTask('sassMain', ['sass:main']);

  // grunt.registerTask('tmp', ['clean:all', 'uglify', 'concat:build']);

};
