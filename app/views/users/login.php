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
    <!-- MDB -->
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Login</title>
  </head>

  <body>
    <section
      class="vh-100 bg-image"
      style="
       background-image: url('imagens/imagem.webp');   
      "
    >
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div
            class="row d-flex justify-content-center align-items-center h-100"
          >
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
              <div class="card bg-dark text-white" style="border-radius: 15px">
                <div class="card-body p-5">
                  <h2 class="text-center mb-5">
                  BEM VINDO DE VOLTA!
                  </h2>

                  <form  action="http://localhost/projetoAci/app/routes/routesUsuarios.php?action=login" method="POST">

                    <div
                      data-mdb-input-init
                      class="form-outline mb-4 border-bottom"
                    >
                      <input
                        type="email"
                        id="form3Example3cg"
                        class="form-control form-control-lg"
                        name="Email"
                      />
                      <label class="form-label text-white" for="form3Example3cg"
                        >Seu email</label
                      >
                    </div>

                    <div
                      data-mdb-input-init
                      class="form-outline mb-4 border-bottom"
                    >
                      <input
                        type="password"
                        id="form3Example4cg"
                        class="form-control form-control-lg"
                        name="Senha"
                      />
                      <label class="form-label text-white" for="form3Example4cg"
                        >Senha</label
                      >
                    </div>
                    <div class="d-flex justify-content-center">
                      <button
                        type="submit"
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body"
                      >
                        LOGIN
                      </button>
                    </div>

                    <p class="text-center mt-5 mb-0 text-white">
                       Não tem uma conta?
                      <a href="http://localhost/projetoAci/app/views/users/createUsers.php" class="fw-bold text-white"
                        ><u>Registre-se</u></a
                      >
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
