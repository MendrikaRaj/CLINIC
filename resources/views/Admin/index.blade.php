<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
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
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/index') }}"
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
                    </li>
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
                    <div class="card shadow">
                        <div class="card-header py-3" style="text-align: right;">
                            <section class="newsletter-subscribe">
                                <div class="container">
                                    <form class="d-flex justify-content-center flex-wrap" method="post"
                                        action="{{ route('dashboard') }}">
                                        @csrf
                                        <div class="mb-3" style="text-align: center"><select class="form-select"
                                                name="mois">
                                                <optgroup label="Mois">
                                                    @foreach ($mois as $month)
                                                        <option value="{{ $month->id }}">{{ $month->mois }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                            @error('mois')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3" style="text-align: center"><select class="form-select"
                                                name="annee">
                                                <optgroup label="Année">
                                                    @for ($i = 1999; $i <= 2050; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor

                                                </optgroup>
                                            </select>
                                            @error('annee')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3"><button class="btn" type="submit"
                                                style="background: rgb(252,222,123);">rechercher</button></div>
                                    </form>
                                </div>
                            </section>
                        </div>
                        <div class="card-body">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Recette </p>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Type acte</th>
                                            <th>Réel</th>
                                            <th>Budget</th>
                                            <th>Réalisation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($realisationRecette as $realisationRecettes)
                                            <tr>
                                                <td>{{ $realisationRecettes->acte }}</td>
                                                <td>{{ number_format($realisationRecettes->montant ?? 0, 2, ',', ' ') }}Ar
                                                </td>
                                                <td>{{ number_format($realisationRecettes->budget_mensuel ?? 0, 2, ',', ' ') }}Ar
                                                </td>
                                                <td>{{ number_format($realisationRecettes->realisation ?? 0, 2, ',', ' ') }}%</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <th>{{ number_format($totaleRecette->totalerecette ?? 0, 2, ',', ' ') }}Ar
                                            </th>
                                            <th>{{ number_format($totaleRecette->totalebudget_mensuel ?? 0, 2, ',', ' ') }}Ar
                                            </th>
                                            <th>{{ number_format($totaleRecette->totalerealisation ?? 0, 2, ',', ' ') }}%
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Dépense </p>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Type dépense</th>
                                            <th>Réel</th>
                                            <th>Budget</th>
                                            <th>Réalisation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($realisationDepense as $realisationDepenses)
                                            <tr>
                                                <td>{{ $realisationDepenses->depense }}
                                                </td>
                                                <td>{{ number_format($realisationDepenses->montant ?? 0, 2, ',', ' ') }}Ar
                                                </td>
                                                <td>{{ number_format($realisationDepenses->budget_mensuel ?? 0, 2, ',', ' ') }}Ar
                                                </td>
                                                <td>{{ number_format($realisationDepenses->realisation ?? 0, 2, ',', ' ') }}%</a>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <th>{{ number_format($totaleDepense->totaledepense ?? 0, 2, ',', ' ') }}Ar
                                            </th>
                                            <th>{{ number_format($totaleDepense->totalebudget_mensuel ?? 0, 2, ',', ' ') }}Ar
                                            </th>
                                            <th>{{ number_format($totaleDepense->totalerealisation ?? 0, 2, ',', ' ') }}%
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Bénefice </p>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Réel</th>
                                            <th>Budget</th>
                                            <th>Réalisation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Recette</th>
                                            <td>{{ number_format($benefice->totalerecette ?? 0, 2, ',', ' ') }}Ar</td>
                                            <td>{{ number_format($benefice->totalerecettebudget_mensuel ?? 0, 2, ',', ' ') }}Ar
                                            </td>
                                            <td>{{ number_format($benefice->realisationrecette ?? 0, 2, ',', ' ') }}%
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dépense</th>
                                            <td>{{ number_format($benefice->totaledepense ?? 0, 2, ',', ' ') }}Ar</td>
                                            <td>{{ number_format($benefice->totaledepensebudget_mensuel ?? 0, 2, ',', ' ') }}Ar
                                            </td>
                                            <td>{{ number_format($benefice->realisationdepense ?? 0, 2, ',', ' ') }}%</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th>{{ number_format($benefice->beneficereel ?? 0, 2, ',', ' ') }}Ar</th>
                                            <th>{{ number_format($benefice->beneficebudget_mensuel ?? 0, 2, ',', ' ') }}Ar
                                            </th>
                                            <th>{{ number_format($benefice->realisationbenefice ?? 0, 2, ',', ' ') }}%
                                            </th>
                                        </tr>
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
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
