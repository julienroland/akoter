 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">

        <li {{Helpers::isActive('buildings', Request::segment(2))}}>
            <a href="{{url('admin/buildings')}}">Bâtiments</a>
        </li>
        <li {{Helpers::isActive('locations', Request::segment(2))}}>
            <a href="{{url('admin/locations')}}">Annonces</a>
        </li>
        <li {{Helpers::isActive('articles', Request::segment(2))}}>
            <a href="{{url('admin/articles')}}">Articles</a>
        </li>

        <li {{Helpers::isActive('users', Request::segment(2))}}>
            <a href="{{url('admin/users')}}">Utilisateurs</a>
        </li>

        <li {{Helpers::isActive('schools', Request::segment(2))}}>
            <a href="{{url('admin/schools')}}">Ecole</a>
        </li>

        <li {{Helpers::isActive('translations', Request::segment(2))}}>
            <a href="{{url('admin/translations')}}">Traductions statiques</a>
        </li>

        <li {{Helpers::isActive('translations2', Request::segment(2))}}>
            <a href="{{url('admin/translations2')}}">Traductions dynamique</a>
        </li>

         <li {{Helpers::isActive('notices', Request::segment(2))}}>
            <a href="{{url('admin/notices')}}">Avis</a>
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
    </div>