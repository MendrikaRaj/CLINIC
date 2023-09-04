<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Brand</title>
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

<body class="bg-gradient-primary" style="background: rgb(254,224,124);">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5" style="height: 670px;">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-login-image"
                            style="background: url(&quot;assets/img/pexels-jonas-svidras-1434819.jpg&quot;) bottom / cover;height: 670px;">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Bienvenue sur notre site Administrateur</h4>
                            </div>
                            <form class="user" action="{{ route('logAdmin') }}" method="POST">
                                @csrf
                                @if (Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif
                                @if (Session::has('fail'))
                                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                                @endif
                                <div class="mb-3"><input class="form-control form-control-user" type="email"
                                        id="exampleInputEmail-1" aria-describedby="emailHelp"
                                        placeholder="Entrer votre addresse email" name="email" value="test@gmail.com">
                                </div>
                                <div><span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="password"
                                        id="exampleInputPassword-1" placeholder="Mot de passe" name="password"
                                        value="123456789"></div>
                                <div><span class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span></div>
                                <div class="mb-3">
                                    <div class="custom-control custom-checkbox small"></div>
                                </div><button class="btn btn-primary d-block btn-user w-100" type="submit"
                                    style="background: rgb(252,222,123);color: rgb(3,3,3);border-color: rgb(255,255,255);">Connexion</button>
                                <hr><a class="btn btn-primary d-block btn-google btn-user w-100 mb-2" role="button"><i
                                        class="fab fa-google"></i>&nbsp; Se connecter avec Google</a><a
                                    class="btn btn-primary d-block btn-facebook btn-user w-100" role="button"><i
                                        class="fab fa-facebook-f"></i>&nbsp; Se connecter avec Facebook</a>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
