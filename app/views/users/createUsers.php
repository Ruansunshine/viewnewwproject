<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css"
      rel="stylesheet"
    />
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"
    ></script>
    
    <title>Sign Up</title>
  </head>

  <body>
    <section class="vh-100 bg-image" style="background-image: url('imagens/imagem.webp');">
      <div class="mask d-flex align-items-center h-100" style="background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
              <div class="card bg-dark text-white" style="border-radius: 15px">
                <div class="card-body p-5">
                  <h2 class="text-center mb-5">CRIE UMA CONTA</h2>

                  <form action="http://localhost/projetoAci/app/routes/routesUsuarios.php?action=cadastrar" method="POST">
                    <div class="form-outline mb-4 border-bottom">
                      <input
                        type="text"
                        id="form3Example1cg"
                        class="form-control form-control-lg"
                        name="Nome"
                        style="color: white;"
                        placeholder=" "
                      />
                      <label class="form-label text-white" for="form3Example1cg">Seu nome</label>
                    </div>

                    <div class="form-outline mb-4 border-bottom">
                      <input
                        type="email"
                        id="form3Example3cg"
                        class="form-control form-control-lg"
                        name="Email"
                        style="color: white;"
                        placeholder=" "
                      />
                      <label class="form-label text-white" for="form3Example3cg">Seu email</label>
                    </div>

                    <div class="form-outline mb-4 border-bottom">
                      <input
                        type="password"
                        id="form3Example4cg"
                        class="form-control form-control-lg"
                        name="Senha"
                        style="color: white;"
                        placeholder=" "
                      />
                      <label class="form-label text-white" for="form3Example4cg">Senha</label>
                    </div>

                    <div class="form-outline mb-4 border-bottom">
                      <input
                        type="password"
                        id="form3Example4cdg"
                        class="form-control form-control-lg"
                        nome="Senha"
                        style="color: white;"
                        placeholder=" "
                      />
                      <label class="form-label text-white" for="form3Example4cdg">Repita sua senha</label>
                    </div>

                    <div class="d-flex justify-content-center">
                      <button
                        type="submit"
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-success btn-block btn-lg"
                        style="background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1)); color: white;"
                      >
                        Registre-se
                      </button>
                    </div>

                    <p class="text-center mt-5 mb-0 text-white">
                      Já tem uma conta?
                      <a href="http://localhost/projetoAci/app/views/users/login.php" class="fw-bold text-white">
                        <u>Login</u>
                      </a>
                    </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
