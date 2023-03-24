<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Login Presensi</title>
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, wallet, banking, fintech mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/img/icon/192x192.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="manifest" href="__manifest.json">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert2.min.css">
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="<?php echo base_url(); ?>assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
        </div>
    </div>
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h3>CV. Makmur Permata</h3>
        </div>
        <div class="section mb-5 p-2">


            <form action="" method="POST" autocomplete="off">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email" autocomplete="off">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password" autocomplete="off">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <input type="checkbox" onclick="myFunction()"> Show Password
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-links mt-2">
                    <div>
                        <a href="<?php echo base_url(); ?>auth/registrasi">Register</a>
                    </div>
                    <div><a href="#" class="text-muted">Forgot Password?</a></div>
                </div>

                <div class="form-button-group  transparent">
                    <a href="#" class="btn btn-primary btn-block btn-lg" id="login" name="submit">Log in</a>
                </div>

            </form>
        </div>

    </div>
    <!-- * App Capsule -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <!-- Sweat Alert 2 -->
    <script src="<?php echo base_url(); ?>assets/js/sweetalert2.min.js"></script>

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="<?php echo base_url(); ?>assets/js/base.js"></script>

    <script type="text/javascript">
        function myFunction() {
            var password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }

        $(document).ready(function() {

            $("#login").click(function() {

                var email = $("#email").val();
                var password = $("#password").val();

                if (email == '') {

                    Swal.fire(
                        'Opps..!!',
                        'Email belum diisi',
                        'warning'
                    )

                } else if (password == '') {

                    Swal.fire(
                        'Opps..!!',
                        'Password belum diisi',
                        'warning'
                    )

                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url(); ?>auth/cek_user',
                        data: {
                            email: email,
                            password: password
                        },
                        cache: false,
                        success: function(respond) {

                            if (respond <= 0) {

                                Swal.fire(
                                    'Opps..!!',
                                    'Periksa kembali Email & Password',
                                    'warning'
                                )

                            } else {

                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url(); ?>auth/InsertLogin',
                                    data: {
                                        email: email,
                                        password: password,
                                    },
                                    cache: false,
                                    success: function() {

                                        Swal.fire(
                                            'Berhasil',
                                            'Login Berhasil',
                                            'success'
                                        )
                                        window.location.href = "http://localhost/presensiv2/";

                                    }

                                });

                            }
                        }

                    });
                }
            });
        });
    </script>

</body>

</html>