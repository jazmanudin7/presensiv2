<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Finapp</title>
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, wallet, banking, fintech mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url();?>assets/img/icon/192x192.png">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
 
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sweetalert2.min.css">
    
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="<?php echo base_url();?>assets/img/loading-icon.png" alt="icon" class="loading-icon">
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
            <a href="<?php echo base_url();?>auth/login" class="headerButton">
                Login
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h3>CV. Makmur Permata</h3>
        </div>
        <div class="section mb-5 p-2">
            <form action="#" method="POST" autocomplete="off">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">NIK</label>
                                <input type="text" class="form-control" id="nik" placeholder="Masukan NIK">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-Mail</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukan Email">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password1" autocomplete="off"
                                    placeholder="Masukan Password">
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password2">Password Again</label>
                                <input type="password" class="form-control" id="password2" autocomplete="off"
                                    placeholder="Masukan Password Lagi">
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <input type="checkbox" onclick="myFunction()"> Show Password
                            </div>
                        </div>

                    </div>
                </div>


                <div class="form-button-group transparent">
                    <a href="#" class="btn btn-primary btn-block btn-lg" id="simpanRegistrasi">Register</a>
                </div>
            </form>
        </div>

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
     
    <!-- Sweat Alert 2 -->
    <script src="<?php echo base_url();?>assets/js/sweetalert2.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="<?php echo base_url();?>assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="<?php echo base_url();?>assets/js/base.js"></script>
    
    
    <script type="text/javascript">
    
        function myFunction() {
            var password1 = document.getElementById("password1");
            var password2 = document.getElementById("password2");
            if (password1.type === "password" && password2.type === "password") {
                password1.type = "text";
                password2.type = "text";
            } else {
                password1.type = "password";
                password2.type = "password";
            }
        }
            
        $(document).ready(function() {
            
            
            $("#simpanRegistrasi").click(function() {
                
                var nik = $("#nik").val();
                var email = $("#email").val();
                var password1 = $("#password1").val();
                var password2 = $("#password2").val();
                if(nik == ''){
                            
                    Swal.fire(
                      'Opps..!!',
                      'NIK belum diisi',
                      'warning'
                    )
                    
                }else if(email == ''){
                
                    Swal.fire(
                      'Opps..!!',
                      'Email belum diisi',
                      'warning'
                    )
                    
                }else if(password1 == '' || password2 == ''){
                
                    Swal.fire(
                      'Opps..!!',
                      'Password belum diisi',
                      'warning'
                    )
                    
                }else if(password1 != password2){
                
                    Swal.fire(
                      'Opps..!!',
                      'Password belum sama',
                      'warning'
                    )
                    
                }else{
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url(); ?>auth/cek_nik',
                        data: {
                            nik:nik
                        },
                        cache: false,
                        success: function(respond) {
                            
                            if(respond >= 1){
                                
                                Swal.fire(
                                  'Opps..!!',
                                  'NIK ini sudah terdaftar',
                                  'warning'
                                )
                                
                            }else{
                                
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url(); ?>auth/insertRegistrasi',
                                    data: 
                                    {
                                        nik : nik,
                                        email : email,
                                        password : password1,
                                    },
                                    cache: false,
                                    success: function() {
                                        
                                        Swal.fire(
                                          'Berhasil',
                                          'Berhasil Daftar Berhasil',
                                          'success'
                                        )
                                        window.location.href = "https://mobile.pedasalami.com";
                            
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