<?php
session_start();
include '../../app/db.conn.php';
include '../../app/helpers/user.php';
$user = getUser($_SESSION['username'], $conn);

$user_id = $_SESSION['user_id'];
$sql = "SELECT daftar.to_id, daftar.from_id, users.user_id, users.name, users.p_p, daftar.daftar_id, daftar.status, users.p_p, users.username
        FROM daftar
        INNER JOIN users ON daftar.from_id = users.user_id
        WHERE daftar.to_id = :user_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

$sql2 = "SELECT verif.user_id, verif.gaji, verif.verif_id, verif.status, verif.deskripsi_pekerjaan, verif.persyaratan_khusus, verif.deadline, verif.lokasi, verif.dokumen
        FROM verif
        WHERE verif.user_id = :user_id";

$stmt2 = $conn->prepare($sql2);
$stmt2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt2->execute();

$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="../assets/img/apple-icon.png"
    />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Dashboard</title>
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
    <style>
        .box {
            background-color: black;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        p {
            font-size: 17px;
            align-items: center;
        }
        .box a {
            display: inline-block;
            background-color: #fff;
            padding: 15px;
            border-radius: 3px;
        }
        .modal {
            align-items: center;
            display: flex;
            justify-content: center; 
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.8);
            transition: all 0.4s;
            visibility: hidden;
            opacity: 0;
        }
        .content {
            position: absolute;
            background: white;
            width: 400px;
            padding: 1em 2em;
            border-radius: 10px;
            max-height: 500px;
            overflow-y: scroll;
        } 
        .modal:target {
            visibility: visible;
            opacity: 1;
        }
        .box-close {
            position: absolute;
            top: 0;
            right: 15px;
            color: #fe0606;
            text-decoration: none;
            font-size: 30px;
            margin-top: 5px;
        }
    </style>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <div id="popup-box2" class="modal">
    <div class="content">
        <a href="#" class="box-close">×</a>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

            <label for="profile_image">Choose Image:</label>
            <input type="file" name="profile_image" id="profile_image" accept="image/*">
            <div id="imagePreview" style="min-widht: 100px;"></div>

            <input type="submit" value="Upload Image">
        </form>
    </div>
</div>

  <div id="popup-box" class="modal">
        <div class="content">
            <h3 class="bg-gradient-primary text-white text-center border-radius-lg mt-5">
                Pengaturan
            </h3>
            <form action="edit_process.php" method="post" class="input-group input-group-outline" style="overflow-y: scroll; overflow-x: hidden; display: inline;">
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

        <input type="hidden" name="username" class="form-control w-auto" value="<?php echo $user['username']; ?>" required>
      
        <label for="name">Nama Pasar Kerja:</label>
        <input type="text" name="name" class="form-control w-auto" value="<?php echo $user['name']; ?>" required>

        <label for="email">Email Pasar Kerja:</label>
        <input type="email" name="email" class="form-control w-auto" value="<?php echo $user['email']; ?>" required>

        <label for="nomor_handphone">No. HP Pasar Kerja:</label>
        <input type="text" name="nomor_handphone" class="form-control w-auto" value="<?php echo $user['nomor_handphone']; ?>" required>

        <label for="alamat">Alamat Pasar Kerja:</label>
        <input type="text" name="alamat" class="form-control w-auto" value="<?php echo $user['alamat']; ?>" required>

        <label for="NPWP">NPWP:</label>
        <input type="text" name="NPWP" class="form-control w-auto" value="<?php echo $user['NPWP']; ?>" required>

        <label for="no_izin">No. Izin Berdiri:</label>
        <input type="text" name="no_izin" class="form-control w-auto" value="<?php echo $user['no_izin']; ?>" required>

        <input class="mt-2 border-0 alert-success text-white " type="submit" value="SIMPAN"> <br>

    </form>
            <a href="#"
               class="box-close">
                ×
            </a>
        </div>
    </div>
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
        <a
          class="navbar-brand m-0"
          href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
          target="_blank"
        >
          <img
            src="../../../../../images/ico.png"
            class="navbar-brand-img h-100"
            alt="main_logo"
          />
          <span class="ms-1 font-weight-bold text-white"
            >SIKAYAN</span
          >
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
            <a class="nav-link text-white " href="../pasars/postinglowongan.php">
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
              class="nav-link text-white active bg-gradient-primary"
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
      <div class="sidenav-footer position-absolute w-100 bottom-0"></div>
    </aside>
    <main
      class="main-content position-relative max-height-vh-100 h-100 border-radius-lg"
    >
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
                Dashboard
              </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
          </nav>
          <div
            class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4"
            id="navbar"
          >
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
            <ul class="navbar-nav justify-content-end">
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
              <li class="nav-item dropdown pe-2 d-flex align-items-center">
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
                            src="../assets/img/team-4.jpg"
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
      <?php 
      $sql3 = "SELECT users.p_p, users.name, users.email, users.alamat, users.NPWP, users.no_izin, users.nomor_handphone
      FROM users
      WHERE users.user_id = :user_id";

$stmt3 = $conn->prepare($sql3);
$stmt3->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt3->execute();

// Mengambil nilai 'p_p' dari hasil query
$result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
      if (isset($result3['p_p'])) {
    // Menggunakan nilai 'p_p' dari hasil query
    $p_p_value = $result3['p_p'];
    ?>
      <div class="container-fluid py-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../../uploads/<?=$p_p_value?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>

          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $_SESSION['username']; ?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                Masuk Sebagai: Pasar Kerja
              </p>
              <p class="mb-0 font-weight-normal text-sm">
                <a href="#popup-box2" style="text-decoration: underline;">Edit Foto Profil </a>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active" href="#popup-box" role="tab" aria-selected="false" onclick="openTab('tab1')">
                    <i class="material-icons text-lg position-relative">settings</i>
                    <span class="ms-1">Pengaturan</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-0">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                <div class="card-body p-0">
                  <hr class="horizontal gray-light my-0"><h5 class="mb-3">Informasi Pasar Kerja: </h5>
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nama:</strong> &nbsp; <?php echo $result3['name']; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $result3['email']; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No Handphone:</strong> &nbsp; <?php echo $result3['nomor_handphone']; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alamat:</strong> &nbsp; <?php echo $result3['alamat']; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">NPWP:</strong> &nbsp; <?php echo $result3['NPWP']; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No Izin Berdiri (opsional):</strong> &nbsp; <?php echo $result3['no_izin']; ?></li>
                  </ul></div>
                </div>
              </div>
            </div>          
            <?php
      } else {
        echo "tidak ditemukan";
      }
          ?>
                </div>
              </div>
            </div>
          </div>
        <div class="row p-4">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div
                  class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute"
                >
                  <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Jumlah Karyawan Saat Ini</p>
                  <h4 class="mb-0">2,300</h4>
                </div>
              </div>
              <hr class="dark horizontal my-0" />
              <div class="card-footer p-3">
                <form action="dashboard.php" method="POST">
                  <div class="input-group input-group-outline mb-2 pt-0" style="max-width: 500px; overflow: hidden;"> 
                    <label class="form-label">Masukkan Jumlah Karyawan</label>
                    <input type="number" class="form-control" name="gaji1" value="">
                  </div>
                <button type="submit" name="" class="btn bg-gradient-primary w-100 mb-2">Input Jumlah Karyawan</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div
                  class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute"
                >
                  <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Jumlah Pelamar</p>
                  <h4 class="mb-0"><?=$count?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0" />
              <div class="card-footer p-3">
                <a href="pelamar.php" name="" class="btn bg-gradient-primary w-100 mb-2">Lihat Pelamar</a>
              </div>
            </div>
          </div>
        </div>
        <?php
        foreach ($result2 as $row) {
      ?>

        <div class="row px-3"> 
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card my-1">
            <div class="px-2 bg-gradient-success shadow-success text-center text-white border-radius-xl mt-n4 position-absolute">
                   <h5 class="pt-2 text-white"> Lowongan Yang Saya Buka</h5>
                </div>
              <div class="card-body px-0 pb-2" >
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
<tbody>
                    <div class="pb-2 mx-3">
                        <div class="d-flex">
                    <h5 class="mt-2">Id Lowongan: <?=$row['verif_id']?></h5></div>
                    <p class="mb-1 mt-3 font-weight-normal text-sm">Status Verifikasi:<span class="alert-success p-1 border-radius-lg text-white mx-1"><?=$row['status']?></span></p>
                    </div>
                    <ul class="list-group px-3">
                      <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Deskripsi Pekerjaan:</strong> &nbsp; <?php echo $row['deskripsi_pekerjaan']; ?></li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Persyaratan Khusus:</strong> &nbsp; <?php echo $row['persyaratan_khusus']; ?></li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gaji:</strong> &nbsp; <?php echo $row['gaji']; ?></li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Lokasi:</strong> &nbsp; <?php echo $row['lokasi']; ?></li>
                     <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Deadline:</strong> &nbsp; <?php echo $row['deadline']; ?></li>
                    </ul>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
          }

          $conn = null;
          ?>
        </div>

        <footer class="footer py-4">
          <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
              <div class="col-lg-6 mb-lg-0 mb-4">
                <div
                  class="copyright text-center text-sm text-muted text-lg-start"
                >
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with <i class="fa fa-heart"></i> by
                  <a
                    href="https://www.creative-tim.com"
                    class="font-weight-bold"
                    target="_blank"
                    >SIKAYAN TEAM</a
                  >
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
    <script>
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('imagePreview');
        
        // Clear previous preview
        previewContainer.innerHTML = '';

        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = document.createElement('img');
                img.setAttribute('src', e.target.result);
                img.setAttribute('style', 'max-width:100%; max-height:100%;');
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }
</script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>

    <script>
      var win = navigator.platform.indexOf("Win") > -1;
      if (win && document.querySelector("#sidenav-scrollbar")) {
        var options = {
          damping: "0.5",
        };
        Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
  </body>
</html>
