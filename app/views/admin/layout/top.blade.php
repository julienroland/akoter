
<body id="admin">

<nav class=" navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('admin/')}}">Admin - {{Auth::user()->first_name}}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
       @include('admin.layout.nav')
       <!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>