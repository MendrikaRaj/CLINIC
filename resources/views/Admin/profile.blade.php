<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Newsletter-Subscription-Form.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
            style="background: rgb(252,222,123);">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
                    href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-medkit"
                            style="color: rgb(249,69,69);"></i></div>
                    <div class="sidebar-brand-text mx-3"><span style="color: rgb(0,0,0);">Clinic&nbsp;</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar" style="color: rgb(0,0,0);">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/index') }}"
                            style="color: rgba(0,0,0,0.8);"><i class="fas fa-tachometer-alt"
                                style="color: rgba(0,0,0,0.3);"></i><span>Tableau de
                                bord</span></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ url('/ajout-acte') }}"
                            style="color: rgba(0,0,0,0.8);"><i class="fas fa-user"
                                style="color: rgba(0,0,0,0.3);"></i><span>Ajout type
                                d'acte</span></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ url('/ajout-depense') }}"
                            style="color: rgba(0,0,0,0.8);"><i class="far fa-user-circle"
                                style="color: rgba(0,0,0,0.3);"></i><span>Ajout type
                                dépense</span></a>

                    <li class="nav-item"><a class="nav-link" href="{{ url('/ajout-patient') }}"
                            style="color: rgba(0,0,0,0.8);"><i class="far fa-user-circle"
                                style="color: rgba(0,0,0,0.3);"></i><span>Ajout Patient</span></a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"
                        style="color: rgb(0,0,0);background: rgba(0,0,0,0.2);"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                                    placeholder="Rechercher"><button class="btn btn-primary py-0" type="button"
                                    style="background: rgb(252,222,123);"><i class="fas fa-search"></i></button></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                    aria-expanded="false" data-bs-toggle="dropdown" href="#"><i
                                        class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small"
                                                type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0"
                                                    type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                            class="d-none d-lg-inline me-2 text-gray-600 small">Administrateur</span><img
                                            class="border rounded-circle img-profile"
                                            src="assets/img/pexels-jonas-svidras-1434819.jpg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a
                                            class="dropdown-item" href="{{ url('/profile') }}"><i
                                                class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item"
                                            href="{{ url('/logoutAdmin') }}"><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Profil Administrateur</h3>
                </div>
                <div class="container">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Information administrateur</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('modifier', ['modelName' => 'Admin', 'id' => $admin->id]) }}"
                                method="POST">
                                @csrf
                                @if (Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif
                                @if (Session::has('error'))
                                    <div class="alert alert-danger">{{ Session::get('erreur') }}</div>
                                @endif
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label"
                                                for="username"><strong>Nom</strong></label><input class="form-control"
                                                type="text" id="username-1" value="{{ $admin->nom }}"
                                                name="nom">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="email"><strong>Adresse
                                                    email</strong></label><input class="form-control" type="email"
                                                id="email-1" value="{{ $admin->email }}" name="email"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Mot de
                                                    passe</strong></label><input class="form-control" type="password"
                                                id="last_name-2" value="{{ $admin->password }}" name="password">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p><br>Prenez le temps de réfléchir aux modifications que vous souhaitez
                                            apporter. Assurez-vous qu'elles sont précises et correctes avant de les
                                            enregistrer.<br><br></p>
                                    </div>
                                </div>
                                <div class="mb-3" style="text-align: center;"><button
                                        class="btn btn-primary btn-sm" type="submit"
                                        style="background: rgb(252,222,123);color: rgb(0,0,0);border-color: rgb(255,255,255);border-radius: 10px;">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Mendrika 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
