
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
            <a class="navbar-brand" href="#">Admin - {{Auth::user()->first_name}}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li {{Helpers::IsNotok(Request::segment(2))? 'class="active"' :''}} >
                {{link_to_route('getIndexAdmin','Accueil admin')}}
                </li>
                <li {{Helpers::isActive('buildings', Request::segment(2))}}>
                <a href="{{url('admin/buildings')}}">Bâtiments</a>
                </li>
              

            </ul>
            <!--  <form class="navbar-form navbar-left" role="search">
               <div class="form-group">
                 <input type="text" class="form-control" placeholder="Search">
               </div>
               <button type="submit" class="btn btn-default">Submit</button>
             </form> -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('admin/disconnect')}}">Déconnecter</a></li>
                <li><a href="{{url('admin/leave')}}">Quitter l'admin</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>