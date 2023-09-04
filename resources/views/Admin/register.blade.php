<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - Brand</title>
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
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image"
                            style="background: url(&quot;assets/img/pexels-jonas-svidras-1434819.jpg&quot;) center / cover;">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Créer votre compte Administrateur</h4>
                            </div>
                            <form class="user" method="POST"
                                action="{{ route('enregistrer', ['modelName' => 'Admin']) }}">
                                @csrf
                                @if (Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif
                                @if (Session::has('error'))
                                    <div class="alert alert-danger">{{ Session::get('erreur') }}</div>
                                @endif

                                <div class="mb-3"><label class="form-label">Nom</label><input
                                        class="form-control form-control-user" type="text" id="exampleInputEmail"
                                        aria-describedby="emailHelp" placeholder="Entrer votre nom" name="nom"
                                        style="border-radius: 10px;">
                                    @error('nom')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3"><label class="form-label">Adresse email</label><input
                                        class="form-control form-control-user" type="email" id="exampleInputEmail-2"
                                        aria-describedby="emailHelp" placeholder="Adresse email" name="email"
                                        style="border-radius: 10px;">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3"><label class="form-label">Mot de passe</label><input
                                        class="form-control form-control-user" type="password" id="exampleInputEmail-1"
                                        aria-describedby="emailHelp" placeholder="Mot de passe" name="password"
                                        style="border-radius: 10px;">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div><button class="btn btn-primary d-block btn-user w-100" type="submit"
                                    style="background: rgb(252,222,123);color: rgb(0,0,0);border-color: rgb(255,255,255);">S'enregistrer</button>
                                <hr><a class="btn btn-primary d-block btn-google btn-user w-100 mb-2" role="button"><i
                                        class="fab fa-google"></i>&nbsp; S'enregistrer avec Google</a><a
                                    class="btn btn-primary d-block btn-facebook btn-user w-100" role="button"><i
                                        class="fab fa-facebook-f"></i>&nbsp; S'enregistrer avec Facebook</a>
                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="{{ url('/') }}">Vous avez déja un
                                    compte ?
                                    Connexion</a></div>
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
