<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
      /* SIDEBAR gradasi sama kayak login */
      .sidebar {
        background: linear-gradient(
          180deg,
          #778d8d,
          #f7cbca,
          #ffffff
        ) !important;
      }

      /* TOPBAR pink soft */
      .topbar {
        background-color: #f7cbca !important;
      }

      /* CARD HEADER tosca muda */
      .card-header {
        background-color: #a1bfbc !important;
        color: #4f6f6f;
      }

      /* BUTTON primary jadi pink */
      .btn-primary {
        background-color: #f7cbca !important;
        border-color: #f7cbca !important;
      }

      /* Hover button */
      .btn-primary:hover {
        background-color: #f3b6cf !important;
        border-color: #f3b6cf !important;
      }
    </style>
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

    @include('components.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
          
        <!-- Main Content -->
        <div id="content">
         <div id="content">

    @include('components.navbar')

    <div class="container-fluid">

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Data Kunjungan</h1>
            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" />
                  </div>

                  <div class="col-md-4">
                    <label>Status</label>
                    <select class="form-control">
                      <option value="">Semua</option>
                      <option value="selesai">Selesai</option>
                      <option value="menunggu">Menunggu</option>
                    </select>
                  </div>

                  <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary">Filter</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="alert alert-success">
                  <strong>Selesai :</strong> 25
                </div>
              </div>
              <div class="col-md-6">
                <div class="alert alert-warning">
                  <strong>Menunggu :</strong> 12
                </div>
              </div>
            </div>
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Kunjungan Hari Ini
                </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>No RM</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Budi Santoso</td>
                        <td>001234</td>
                        <td>Poli Umum</td>
                        <td>dr. Andi</td>
                        <td>
                          <span class="badge badge-success">Selesai</span>
                        </td>
                        <td>Sudah Pulang</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Siti Aisyah</td>
                        <td>001567</td>
                        <td>Poli Anak</td>
                        <td>dr. Maya</td>
                        <td>
                          <span class="badge badge-warning">Menunggu</span>
                        </td>
                        <td>Menunggu Dokter</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>

@include('components.footer')

</div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Select "Logout" below if you are ready to end your current session.
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
              Cancel
            </button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
  </body>
</html>
