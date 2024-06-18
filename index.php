<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inixindo | Junior Web Dev</title>
  <link rel="icon" type="image/x-icon" href="./assets/logo_x.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="https://inixindo.id">INIXINDO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Training & Certification
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Training</a></li>
              <li><a class="dropdown-item" href="#">Certification</a></li>
              <li><a class="dropdown-item" href="#">Instructor</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              User Area
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Register</a></li>
              <li><a class="dropdown-item" href="#">Login</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-3 pt-3">
    <div class="mt-5 mb-5 px-5">
      <header class="pb-3 mb-3">
        <a href="https://inixindo.id" class="d-flex align-items-center text-dark text-decoration-none">
          <img src="https://i.ibb.co/4W5dH5L/Logo-X-Transparent.png" alt="Logo-X" width="32" height="32" />
          <span class="fs-3 ms-3">Inixindo Corp.</span>
        </a>
      </header>
      <hr />

      <div class="p-5 mb-4 text-bg-secondary rounded-3">
        <div class="container-fluid py-3">
          <h1 class="display-6 fw-bold">Junior Web Developer</h1>
          <p class="col-md-8 fs-4">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore
            officia, magni, ullam, qui aliquam eligendi rerum asperiores
            dolorum animi dolor libero veritatis! Non omnis, illo nemo
            perferendis exercitationem laborum facere?
          </p>
          <button type="button" class="btn btn-outline-light btn-lg" data-bs-toggle="modal" data-bs-target="#registerUser">
            Getting Started
          </button>

          <!-- Modal -->
          <div class="modal fade" id="registerUser" tabindex="-1" aria-labelledby="registerUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5 text-dark" id="registerUserLabel">
                    Register New User
                  </h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card shadow">
                    <div class="card-header bg-primary text-white fw-bold">
                      Entry Your Data
                    </div>
                    <div class="card-body text-secondary">
                      <?php
                      if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $HOST = "localhost";
                        $USER = "root";
                        $PSWD = "";
                        $DB = "db_laravel_training";
                        $conn = mysqli_connect($HOST, $USER, $PSWD, $DB);
                        if (mysqli_connect_error()) {
                          die("Connection failed: " . mysqli_connect_error());
                        }
                        //* =================================================================

                        if (isset($_POST['submitBtn'])) {
                          if ($stmt = $conn->prepare("SELECT id, password FROM accounts WHERE username = ?")) {
                            $stmt->bind_param('s', $_POST['username']);
                            $stmt->execute();
                            $stmt->store_result();
                            if ($stmt->num_rows() > 0) {
                              echo "<script type='text/javascript'>alert('Username already in use.');</script>";
                              echo "<script type='text/javascript'>location.href='index.php';</script>";
                            } else {
                              if ($stmt = $conn->prepare("INSERT INTO accounts (username, email, password) VALUES(?, ?, ?)")) {
                                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                $stmt->bind_param('sss', $_POST['username'], $_POST['email'], $password);
                                $stmt->execute();
                                echo "<script type='text/javascript'>alert('Account created successfully.');</script>";
                                echo "<script type='text/javascript'>location.href='index.php';</script>";
                              } else {
                                echo "Error: " . $conn->error;
                              }
                            }
                            $stmt->close();
                          }
                          $conn->close();
                        }
                      }
                      ?>
                      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                          <label for="username" class="text-dark form-label">Username</label>
                          <input type="text" name="username" id="username" class="form-control" autocomplete="off" />
                          <small id="usernameCheck" class="form-text text-danger">**Username is missing</small>
                        </div>
                        <div class="form-group mb-3">
                          <label for="email" class="text-dark form-label">Email</label>
                          <input type="email" name="email" id="email" class="form-control" autocomplete="off" />
                          <small id="emailCheck" class="form-text text-danger invalid-feedback">**Enter a valid email address</small>
                        </div>
                        <div class="form-group mb-3">
                          <label for="password" class="text-dark form-label">Password</label>
                          <input type="password" name="password" id="password" class="form-control" autocomplete="off" />
                          <small id="passwordCheck" class="form-text text-danger">**Password cannot be empty
                          </small>
                        </div>
                        <div class="form-group mb-3">
                          <label for="confirmpassword" class="text-dark form-label">Confirm Password</label>
                          <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" autocomplete="off" />
                          <small id="confirmpasswordCheck" class="form-text text-danger">**Confirm password didn't match</small>
                        </div>
                        <div class="form-group mb-3">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                          </button>
                          <button type="submit" class="btn btn-primary" name="submitBtn" id="submitBtn">
                            Register
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-between">
        <div class="col-md-6">
          <div class="h-100 p-5 bg-body-secondary rounded-3">
            <h2>Inixindo Partners</h2>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Animi
              ipsa voluptatibus quos iusto sint? Obcaecati, perferendis sunt.
              Voluptate quasi exercitationem error tenetur, ex ut consectetur
              ipsum soluta doloribus consequuntur asperiores.
            </p>
            <button class="btn btn-outline-dark" type="button">
              Read more
            </button>
          </div>
        </div>
        <div class="col-md-6">
          <div class="h-100 p-5 bg-body-tertiary border rounded-3">
            <h2>Inixindo Clients</h2>
            <p>
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae
              similique itaque voluptatibus dolore accusantium commodi sequi
              iste laboriosam unde eligendi, cum impedit iusto, inventore,
              nostrum quae! Neque esse repellendus veniam.
            </p>
            <button class="btn btn-outline-dark" type="button">
              Read more
            </button>
          </div>
        </div>
      </div>
      <div class="mt-3 mb-3"></div>
      <div class="row justify-content-between">
        <div class="col-md-6">
          <div class="h-100 p-5 bg-body-tertiary border rounded-3">
            <h2>Inixindo Events</h2>
            <p>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Officiis debitis praesentium animi corporis neque voluptate
              laudantium tenetur a tempore, accusantium obcaecati totam dolor
              nemo aperiam molestias aliquam maxime voluptates excepturi.
            </p>
            <button class="btn btn-outline-dark" type="button">
              Read more
            </button>
          </div>
        </div>
        <div class="col-md-6">
          <div class="h-100 p-5 bg-body-secondary rounded-3">
            <h2>Inixindo Careers</h2>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex a
              illum iste quae. Ipsam deleniti ducimus, ut incidunt praesentium
              fugiat saepe ea omnis ipsum voluptas blanditiis sint. Cumque,
              sint asperiores.
            </p>
            <button class="btn btn-outline-dark" type="button">
              Read more
            </button>
          </div>
        </div>
      </div>
      <div class="mt-3 mb-3"></div>
      <div class="row justify-content-between">
        <div class="col-md-6">
          <div class="h-100 p-5 bg-body-secondary rounded-3">
            <h2>Inixindo Academy</h2>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit.
              Deserunt porro temporibus minima magni repudiandae amet deleniti
              mollitia officia ex ipsa? Quisquam accusamus earum accusantium
              error, rem dolorum adipisci necessitatibus eius.
            </p>
            <button class="btn btn-outline-dark" type="button">
              Read more
            </button>
          </div>
        </div>
        <div class="col-md-6">
          <div class="h-100 p-5 bg-body-tertiary border rounded-3">
            <h2>Inixindo Gallery</h2>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi,
              dolore porro! Iure, nulla perferendis nobis, explicabo
              voluptatibus voluptatem tempore, impedit voluptatum facere
              accusantium architecto possimus harum tempora tenetur a sunt.
            </p>
            <button class="btn btn-outline-dark" type="button">
              Read more
            </button>
          </div>
        </div>
      </div>

      <hr />
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-3">
        <p class="col-md-4 mb-0 text-body-secondary">
          &copy; 2024 Inixindo, Corp.
        </p>

        <a href="http://inixindo.id" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
          <img src="https://i.ibb.co/4W5dH5L/Logo-X-Transparent.png" alt="Logo-X" width="32" height="32" />
        </a>

        <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">Training</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">Certification</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">About</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">Contact Us</a>
          </li>
        </ul>
      </footer>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://requirejs.org/docs/release/2.3.6/minified/require.js"></script>
  <script src="./validation.js"></script>
</body>

</html>