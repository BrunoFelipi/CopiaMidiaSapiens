<?php include('validacao/conexao.php') ?>
<?php include('validacao/import.html') ?>

<html>    
    <head>        
        <style>
            body, html {
                height: 100%;
                background-repeat: no-repeat;
                background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
            }

            .card-container.card {
                max-width: 350px;
                padding: 40px 40px;
            }

            .btn {
                font-weight: 700;
                height: 36px;
                -moz-user-select: none;
                -webkit-user-select: none;
                user-select: none;
                cursor: default;
            }

            /*
             * Card component
             */
            .card {
                background-color: #F7F7F7;
                /* just in case there no content*/
                padding: 20px 25px 30px;
                margin: 0 auto 25px;
                margin-top: 50px;
                /* shadows and rounded borders */
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                border-radius: 2px;
                -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            }

            .profile-img-card {
                width: 96px;
                height: 96px;
                margin: 0 auto 10px;
                display: block;
                -moz-border-radius: 50%;
                -webkit-border-radius: 50%;
                border-radius: 50%;
            }

            /*
             * Form styles
             */
            .profile-name-card {
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                margin: 10px 0 0;
                min-height: 1em;
            }

            .reauth-email {
                display: block;
                color: #404040;
                line-height: 2;
                margin-bottom: 10px;
                font-size: 14px;
                text-align: center;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .form-signin #inputEmail,
            .form-signin #inputPassword {
                direction: ltr;
                height: 44px;
                font-size: 16px;
            }

            .form-signin input[type=email],
            .form-signin input[type=password],
            .form-signin input[type=text],
            .form-signin button {
                width: 100%;
                display: block;
                margin-bottom: 10px;
                z-index: 1;
                position: relative;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .form-signin .form-control:focus {
                border-color: rgb(104, 145, 162);
                outline: 0;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
            }

            .btn.btn-signin {
                /*background-color: #4d90fe; */
                background-color: rgb(104, 145, 162);
                /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
                padding: 0px;
                font-weight: 700;
                font-size: 14px;
                height: 36px;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                border: none;
                -o-transition: all 0.218s;
                -moz-transition: all 0.218s;
                -webkit-transition: all 0.218s;
                transition: all 0.218s;
            }

            .btn.btn-signin:hover,
            .btn.btn-signin:active,
            .btn.btn-signin:focus {
                background-color: rgb(12, 97, 33);
            }

            .forgot-password {
                color: rgb(104, 145, 162);
            }

            .forgot-password:hover,
            .forgot-password:active,
            .forgot-password:focus{
                color: rgb(12, 97, 33);
            }
            
            .glyphicon.glyphicon-arrow-left {
                font-size: 20px;
            }
            
        </style>   
                
        <script>
        
        ready(function() {
            
            var loggedIn = <?php echo isset($_SESSION['is_logged'])?>;
            
            alert(loggedIn);

         })();
        
        
        function notify($status){
                
            if($status === 'MidiaCopiada'){
                
                Lobibox.notify('success', {
                    size: 'mini',
                    img: 'sa.png' ,
                    msg: 'Mídia copiada com sucesso',
                    delay: false
                });
                
            } else if($status === '!existSource'){
                    
                Lobibox.notify('error', {
                    size: 'mini',
                    img: 'sa.png' ,
                    msg: 'Release inexistente',
                    delay: false
                });
            } else if($status === 'UsuarioNaoCadastrado'){
                    
                Lobibox.notify('error', {
                    size: 'mini',
                    img: 'sa.png' ,
                    msg: 'Usuário não cadastrado',
                    delay: false
                });
            } else if($status === 'CaminhoNaoExiste'){
                    
                Lobibox.notify('error', {
                    size: 'mini',
                    img: 'sa.png' ,
                    msg: 'Mídia de origem não existe',
                    delay: false
                });
            }
            
            <?php unset($_SESSION['status'])?>
        }
            
        </script>
        
    </head>
        
    <body>        
        <div class="container">
            <div class="card card-container">
                <div class="container-content">
                    <a href="index.php"><span class="glyphicon glyphicon-arrow-left"></span></a>
                </div>

                <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
                <!-- <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" /> -->
                <img id="profile-img" class="profile-img-card" src="resources/erp-logo.png" />
                <p id="profile-name" class="profile-name-card"></p>
                
                <form class="form-signin" method="POST" action="validacao/validarLogin.php">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                    <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
                    
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Entrar</button>
                                        
                </form><!-- /form -->
                
                <a href="validacao/esqueceuSenha.php" class="forgot-password" style="text-align: left">
                    Esqueceu sua senha?
                </a>

                <a href="novoCadastro.php" class="forgot-password" style="padding-left: 43">
                    Cadastre-se
                </a>
                
            </div>
        </div>
        
    </body>    
</html>