<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="<?php echo base_url(); ?>Template/dist/assets/images/logoNeuro.png" alt="" class="logo">
            <!-- <img src="<?php echo base_url(); ?>Template/dist/assets/images/logo-icon.png" alt="" class="logo-thumb"> -->
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                    <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
                        Dropdown
                    </a>
                    <div class="dropdown-menu profile-notification ">
                        <ul class="pro-body">
                            <li><a href="user-profile.html" class="dropdown-item"><i class="fas fa-circle"></i> Perfil</a></li>
                            <li><a href="email_inbox.html" class="dropdown-item"><i class="fas fa-circle"></i> Mensajes</a></li>
                            <li><a href="auth-signin.html" class="dropdown-item"><i class="fas fa-circle"></i> Lock Screen</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="dropdown mega-menu">
                    <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
                        Mega
                    </a>
                    <div class="dropdown-menu profile-notification ">
                        <!-- ... (contenido del mega menú, sin cambios) ... -->
                    </div>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="icon feather icon-bell"></i>
                        <span class="badge badge-pill badge-danger">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <!-- ... (contenido de notificaciones, sin cambios) ... -->
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="<?php echo base_url(); ?>Template/dist/assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
                            <span><?php echo $this->session->userdata('nombre'); ?></span>
                            <a href="<?php echo base_url('index.php/Administrador/logout'); ?>" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                        <ul class="pro-body">
                            <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Perfil</a></li>
                            <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> Mensajes</a></li>
                            <li><a href="<?php echo base_url('index.php/Administrador/logout'); ?>" class="dropdown-item"><i class="feather icon-lock"></i> Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
<!-- [ Header ] end -->