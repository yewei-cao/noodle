var elixir = require('laravel-elixir');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
//    mix.sass('app.scss');
	/*
	 * css 
	 */
	//frontend css  bootstrap and sweetalert
    mix.styles([ 
                'bootstrap/bootstrap.css',
                'mycss/sweetalert.css',
                'mycss/frontend.css',
             ],'public/css/frontend/frontend.css','resources/assets/sass/css');
    
    //backend css
    mix.styles([ 
                'bootstrap/bootstrap.css',
                'mycss/sweetalert.css',
                'mycss/backend.css',
             ],'public/css/backend/backend.css','resources/assets/sass/css');
     
    /*
     * component
     */
    
    //select2
    mix.styles([ 
                'mycss/select2.css',
                ],'public/css/select2.css','resources/assets/sass/css');
    
    //dropzone  
    mix.styles([
                'mycss/dropzone.css'
                ],'public/css/dropzone.css','resources/assets/sass/css');
            
    mix.scripts([
                 'dropzone/dropzone.js'
                 ],'public/js/dropzone.js','resources/assets/sass/js');
            
   //admin-LTE
    mix.styles([
               'AdminLTE.css',
               'skins/skin-blue.min.css',
               ],'public/css/admin-master.css','resources/assets/sass/css/admin-lte/dist/css');
            
            //font and icons css file
    mix.styles([
                'font-awesome.min.css',
                'ionicons.min.css',
                ],'public/lte/extend/font-icons.css','resources/assets/sass/css/admin-lte/font-icon');
            
            
    /*
     * Javascript
  	*/      
    mix.scripts([
                 'jquery/jquery.js',
                 'bootstrap/bootstrap.min.js',
                 'sweetalert-dev.js',
                 ],'public/js/libs.js','resources/assets/sass/js');

    mix.scripts([
                 'select2/select2.min.js',
                 ],'public/js/select2.js','resources/assets/sass/js');
        
    mix.scripts([
                 'pubsub.js',
                 'ajax-helper.js',
                 'app.js',
                 ],'public/js/app.js','resources/assets/sass/js');
    
    mix.scripts([
                 'validator.js',
                 ],'public/js/validate.js','resources/assets/sass/js');
    
    mix.scripts([
                 'ordertime-index.js',
                 ],'public/js/ordertime.js','resources/assets/sass/js');
	
	
});
