<?php 
  session_start();

  if (isset($_SESSION['username'])) {
  	# database connection file
  	include '../../app/db.conn.php';

  	include '../../app/helpers/user.php';

  	# Getting User data data
  	$user = getUser($_SESSION['username'], $conn);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=0.9, shrink-to-fit=no"
    />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="../assets/img/apple-icon.png"
    />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Kalkulator</title>
    <!--     Fonts and icons     -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"
    />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script
      src="https://kit.fontawesome.com/42d5adcbca.js"
      crossorigin="anonymous"
    ></script>
    <!-- Material Icons -->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Round"
      rel="stylesheet"
    />
    <!-- CSS Files -->
    <link
      id="pagestyle"
      href="../assets/css/material-dashboard.css?v=3.1.0"
      rel="stylesheet"
    />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script
      defer
      data-site="YOUR_DOMAIN_HERE"
      src="https://api.nepcha.com/js/nepcha-analytics.js"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body class="g-sidenav-show bg-gray-400">
    <aside
      class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
      id="sidenav-main"
    >
      <div class="sidenav-header">
        <i
          class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
          aria-hidden="true"
          id="iconSidenav"
        ></i>
        <a class="navbar-brand m-0" href="profile.php">
        <img src="../../../../../images/ico.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white"> SIKAYAN</span>
        </a>
      </div>
      <hr class="horizontal light mt-0 mb-2" />
      <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-white " href="../../../../index.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <div class="">
                <i class="material-icons opacity-10">home</i>
              </div>
              <span class="nav-link-text ms-1">Kembali Ke Beranda</span></div>
            </a> 
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="#" onclick="showSweetAlert()">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">forum</i>
              </div>
              <span class="nav-link-text ms-1">Ruang Diskusi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white active bg-gradient-primary" href="../pasars/postinglowongan.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">add_circle</i>
              </div>
              <span class="nav-link-text ms-1">Posting Lowongan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="#" onclick="showSweetAlert()">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">add_circle</i>
              </div>
              <span class="nav-link-text ms-1">Posting Pelatihan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="#" onclick="showSweetAlert()">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <div class="">
                <i class="material-icons opacity-10">report</i>
              </div>
              <span class="nav-link-text ms-1">Pelayanan & Pengaduan </span></div>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="../pasars/kalk.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">calculate</i>
              </div>
              <span class="nav-link-text ms-1">Kalkulator Sikayan Pintar</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#" onclick="showSweetAlert()">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">notifications</i>
              </div>
              <span class="nav-link-text ms-1">Notifikasi</span>
            </a>
          </li>
          <li class="nav-item mt-3">
            <h6
              class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8"
            >
              Account pages
            </h6>
          </li>
          <li class="nav-item">
            <a
              class="nav-link text-white "
              href="../pasars/dashboard.php"
            >
              <div
                class="text-white text-center me-2 d-flex align-items-center justify-content-center"
              >
                <i class="material-icons opacity-10">dashboard</i>
              </div>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="../../../pages/logout.php">
              <div
                class="text-white text-center me-2 d-flex align-items-center justify-content-center"
              >
                <i class="material-icons opacity-10">logout</i>
              </div>
              <span class="nav-link-text ms-1">Keluar Akun</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>
    <main
      class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
      <!-- Navbar -->
      <nav
        class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
        id="navbarBlur"
        data-scroll="true"
      >
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol
              class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5"
            >
              <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
              </li>
              <li
                class="breadcrumb-item text-sm text-dark active"
                aria-current="page"
              >
                Posting
              </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Posting</h6>
          </nav>
          <div
            class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4"
            id="navbar"
          >
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group input-group-outline">

              </div>
            </div>
            <ul class="navbar-nav justify-content-end">
              <li class="mt-2"></li>
              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a
                  href="javascript:;"
                  class="nav-link text-body p-0"
                  id="iconNavbarSidenav"
                >
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    Menu
                  </div>
                </a>
              </li>
              <li class="nav-item px-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0"> </a>
              </li>
                <ul
                  class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                  aria-labelledby="dropdownMenuButton"
                >
                  <li class="mb-2">
                    <a
                      class="dropdown-item border-radius-md"
                      href="javascript:;"
                    >
                      <div class="d-flex py-1">
                        <div class="my-auto">
                          <img
                            src="../assets/img/team-2.jpg"
                            class="avatar avatar-sm me-3"
                          />
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="text-sm font-weight-normal mb-1">
                            <span class="font-weight-bold">New message</span>
                            from Laur
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                            <i class="fa fa-clock me-1"></i>
                            13 minutes ago
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="mb-2">
                    <a
                      class="dropdown-item border-radius-md"
                      href="javascript:;"
                    >
                      <div class="d-flex py-1">
                        <div class="my-auto">
                          <img
                            src="../assets/img/small-logos/logo-spotify.svg"
                            class="avatar avatar-sm bg-gradient-dark me-3"
                          />
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="text-sm font-weight-normal mb-1">
                            <span class="font-weight-bold">New album</span> by
                            Travis Scott
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                            <i class="fa fa-clock me-1"></i>
                            1 day
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a
                      class="dropdown-item border-radius-md"
                      href="javascript:;"
                    >
                      <div class="d-flex py-1">
                        <div
                          class="avatar avatar-sm bg-gradient-secondary me-3 my-auto"
                        >
                          <svg
                            width="12px"
                            height="12px"
                            viewBox="0 0 43 36"
                            version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                          >
                            <title>credit-card</title>
                            <g
                              stroke="none"
                              stroke-width="1"
                              fill="none"
                              fill-rule="evenodd"
                            >
                              <g
                                transform="translate(-2169.000000, -745.000000)"
                                fill="#FFFFFF"
                                fill-rule="nonzero"
                              >
                                <g
                                  transform="translate(1716.000000, 291.000000)"
                                >
                                  <g
                                    transform="translate(453.000000, 454.000000)"
                                  >
                                    <path
                                      class="color-background"
                                      d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                      opacity="0.593633743"
                                    ></path>
                                    <path
                                      class="color-background"
                                      d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"
                                    ></path>
                                  </g>
                                </g>
                              </g>
                            </g>
                          </svg>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="text-sm font-weight-normal mb-1">
                            Payment successfully completed
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                            <i class="fa fa-clock me-1"></i>
                            2 days
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="max-width: 290px;">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="max-width: 290px;">
                  <h6 class="text-white text-capitalize ps-4">Posting Lowongan Pekerjaan</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <tbody>
                    </div>
                      <form action="postlowongan.php" method="POST" enctype="multipart/form-data">
                      <div class="input-group input-group-outline mb-3" style="flex-direction: column; padding-left: 20px; overflow: hidden; padding-right: 20px;">
                        Deskripsi Pekerjaan:
                        <textarea type="text" class="form-control" name="desc" value="" style="min-height: 100px; min-width: 320px; " placeholder="Tulis Caption Anda"></textarea>
                        Persyaratan Khusus:
                        <textarea type="text" class="form-control" name="persyaratan" value="" style="min-height: 100px; min-width: 320px; " placeholder="Tulis Caption Anda"></textarea>
                        Gaji:
                        <input type="text" class="form-control" name="gaji" value="" style="min-width: 300px ;" placeholder="Tulis Caption Anda">
                        Lokasi: 
                        <input type="text" class="form-control" name="lokasi" value="" style="min-width: 300px ;" placeholder="Tulis Caption Anda">
                        Deadline: 
                        <input type="text" class="form-control" name="deadline" style="min-width: 300px ;" placeholder="Tulis Caption Anda">
                        <div class="mb-3 d-flex">
                          <div class="" style="width:200px;">
                            <select name="kategori" class="bg-gradient-primary p-2 border-radius-lg mt-3" required>
                              <option value="">Pilih Kategori:</option>
                              <option value="Pekerjaan Umum">Pekerjaan Umum</option>
                              <option value="Sales & Marketing">Sales & Marketing</option>
                              <option value="IT & Software">IT & Software</option>
                              <option value="Media & Creative">Media & Creative</option>
                            </select>
                          </div>  
                        </div>
                        Pilih Dokumen Tambahan(.pdf):
                        <input type="file" name="dokumen" accept=".pdf">  
                        <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                        <div style="display: flex;">
                        <input type="checkbox" id="no-image" name="nodokumen" style="padding: 10px;"> &nbsp; Tekan untuk Upload Tanpa Formulir Tambahan</div>
                        
                        <div>
                        </div>
                    </div>
                    <button type="submit" name="toadmin" class="btn btn-lg bg-gradient-primary mx-3"><font class="" style="margin: 15px;">Post</font></button> 
                      </form>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer py-4">
          <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
              <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with <i class="fa fa-heart"></i> by
                  <a href="https://www.creative-tim.com"
                    class="font-weight-bold"
                    target="_blank"
                    >SIKAYAN TEAM</a>
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </main>
    <!--   Core JS Files   -->
    <script>
    function showSweetAlert() {
        Swal.fire({
            title: 'ERROR 404!',
            text: 'Fitur ini ditutup karena alasan pengembangan',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
</script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
      var win = navigator.platform.indexOf("Win") > -1;
      if (win && document.querySelector("#sidenav-scrollbar")) {
        var options = {
          damping: "0.5",
        };
        Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
      }
    </script>
    <script>
      function previewImage(event) {
          const input = event.target;
          const preview = document.getElementById('image-preview');

          if (input.files && input.files[0]) {
              const reader = new FileReader();

              reader.onload = function (e) {
                  preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview">`;
              };

              reader.readAsDataURL(input.files[0]);
          } else {
              preview.innerHTML = '';
          }
      }

      function toggleImageInput() {
          const imageInput = document.getElementById('image-input');
          const noImageCheckbox = document.getElementById('no-image');

          if (noImageCheckbox.checked) {
              // Hide the image input
              imageInput.style.display = 'none';
              // Clear the image preview
              document.getElementById('image-preview').innerHTML = '';
          } else {
              // Show the image input
              imageInput.style.display = 'block';
          }
      }

      document.getElementById('myForm').addEventListener('submit', function (event) {
          const noImageCheckbox = document.getElementById('no-image');

          if (noImageCheckbox.checked) {
              // Handle the case where the user doesn't want to upload an image
              alert('Image will not be uploaded.');
          } else {
              // Handle the case where the user wants to upload an image
              alert('Image will be uploaded.');
          }

          // Prevent the default form submission
          event.preventDefault();
      });
  </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
  </body>
</html>
<?php
  }else{
  	header("Location: ../../sign-in.php");
   	exit;
  }
 ?>