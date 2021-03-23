<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    @yield('meta')
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- backend css -->
    <link href="/css/backend/backend.css" rel="stylesheet" type= "text/css" />
    
    <!--  Font and icons -->
    <link href="/lte/extend/font-icons.css" rel="stylesheet" type= "text/css" />
    
    <link href="/css/admin-master.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="/lte/dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="lte/extend/html5shiv.min.js"></script>
        <script src="lte/extend/respond.min.js"></script>
    <![endif]-->
    
      <!-- backend js -->
    <script src="/js/libs.js" type="text/javascript"></script>
    
    <!-- My js for the App -->
    <script src="/js/app.js" type="text/javascript"></script>
    
    <!-- AdminLTE App -->
    <script src="/lte/dist/js/app.js" type="text/javascript"></script>
    
    <!-- Extend of Css -->
    @yield('backend.css')
    @yield('backend.js')
    
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

    @include('backend.partials.header')
     
     @include('backend.partials.sidebar')      
      
      <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
          
          @include('flash::message')
          
            <!-- Content Header (Page header) -->
            <section class="content-header">
              @yield('page-header')
              <ol class="breadcrumb">
                @yield('breadcrumbs')
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
             
             @yield('content')
            </section><!-- /.content -->
          </div><!-- /.content-wrapper -->
      
     @include('backend.partials.footer')

     @include('backend.partials.controlsidebar')
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
 
  
	@yield('backend.scripts.footer')

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
  </body>
  
</html>
