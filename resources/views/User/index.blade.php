<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
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
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/index-employe') }}"
                            style="color: rgba(0,0,0,0.8);"><i class="fas fa-tachometer-alt"
                                style="color: rgba(0,0,0,0.3);"></i><span>Patients</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/depense') }}"
                            style="color: rgba(0,0,0,0.8);"><i class="fas fa-tachometer-alt"
                                style="color: rgba(0,0,0,0.3);"></i><span>Depense</span></a></li>
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
                                            class="d-none d-lg-inline me-2 text-gray-600 small">Utilisateur</span><img
                                            class="border rounded-circle img-profile"
                                            src="assets/img/pexels-jonas-svidras-1434819.jpg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <div class="dropdown-divider"></div><a class="dropdown-item"
                                            href="{{ url('/logoutEmploye') }}"><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3" style="text-align: right;">
                            <section class="newsletter-subscribe">
                                <div class="container">
                                    <form class="d-flex justify-content-center flex-wrap" method="post"
                                        action="{{ route('patient-search') }}">
                                        @csrf
                                        @if (Session::has('success'))
                                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                                        @endif
                                        @if (Session::has('fail'))
                                            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                                        @endif
                                        <div class="mb-3"><input class="form-control" type="text"
                                                name="searchbar" placeholder="Nom du patient"></div>
                                        <div class="mb-3"><button class="btn" type="submit"
                                                style="background: rgb(252,222,123);">rechercher</button></div>
                                    </form>
                                </div>
                            </section>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Genre</th>
                                            <th>Date de naissance</th>
                                            <th>Facture</th>
                                            <th>Acte</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patient as $patients)
                                            <tr>
                                                <td>{{ $patients->nom }}</td>
                                                <td>{{ $patients->genre }}</td>
                                                <td>{{ \App\Models\FormatDate::formatFR($patients->datenaissance) }}
                                                </td>
                                                <td><a href="liste-facture?patientid={{ $patients->id }}">Liste de
                                                        facture</a>
                                                </td>
                                                <td style="text-align: left;">
                                                    <button class="btn btn-link" type="button"
                                                        style="border: none; color: blue; text-decoration: underline;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#acte-modal-{{ $patients->id }}">
                                                        Faire un acte
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" role="dialog" tabindex="-1"
                                                id="acte-modal-{{ $patients->id }}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content" style="background-color: white">
                                                        <div class="modal-header" style="text-align: left;">
                                                            <h4 class="modal-title" style="color: black">
                                                                Sélection date</h4>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('acte-patient') }}"
                                                                method="post">
                                                                @csrf
                                                                @if (Session::has('success'))
                                                                    <div class="alert alert-success">
                                                                        {{ Session::get('success') }}</div>
                                                                @endif
                                                                @if (Session::has('error'))
                                                                    <div class="alert alert-danger">
                                                                        {{ Session::get('erreur') }}</div>
                                                                @endif
                                                                <div class="mb-3">
                                                                    <input type="hidden" value="{{ $patients->id }}"
                                                                        name="id">
                                                                    <input class="form-control" type="date"
                                                                        name="date">
                                                                    @error('date')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-light" type="button"
                                                                data-bs-dismiss="modal">Fermer</button>
                                                            <button class="btn btn-primary" type="submit"
                                                                style="background: rgb(252, 222, 123); color: rgb(0, 0, 0);">Faire
                                                                un acte</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
