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
                    <li class="nav-item"><a class="nav-link" href="{{ url('/index-employe') }}"
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
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Date du facture</th>
                                            <th>id</th>
                                            <th>Detail</th>
                                            {{-- <th>Suppression</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patientActe as $patientActes)
                                            <tr>
                                                <td>{{ \App\Models\FormatDate::formatFR($patientActes->created_at) }}
                                                </td>
                                                <td>{{ $patientActes->id }}</td>
                                                <td><a
                                                        href="p-acte-patient?id={{ $patientActes->id }}&patientid={{ $patientActes->patientid }}">Detail
                                                        facture</a>
                                                </td>
                                                {{-- <td style="text-align: left;">
                                                    <button class="btn btn-link" type="button"
                                                        style="border: none; color: red; text-decoration: underline;"
                                                        data-bs-toggle="modal" data-bs-target="#modification-modal">
                                                        Modifier
                                                    </button>
                                                </td> --}}
                                            </tr>
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
