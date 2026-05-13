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
  background: linear-gradient(180deg, #778d8d, #f7cbca, #FFFFFF) !important;
}

/* TOPBAR pink soft */
.topbar {
  background-color: #f7cbca !important;
}

/* CARD HEADER tosca muda */
.card-header {
  background-color: #a1bfbc !important;
  color: #4F6F6F;
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
            <!-- Page Heading -->
            <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
           <div class="container-fluid">

  <h1 class="h3 mb-4 text-gray-800">Form SOAP Poli</h1>

<div class="card shadow mb-4">
  <div class="card-header font-weight-bold">
    Data Kunjungan
  </div>
  <div class="card-body">
    <div class="row">

      <div class="col-md-3">
        <div class="form-group">
          <label>No RM</label>
          <input type="text" class="form-control" value="RM00123" readonly>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label>Nama Pasien</label>
          <input type="text" class="form-control" value="Budi Santoso" readonly>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label>Dokter</label>
          <select class="form-control">
            <option>-- Pilih Dokter --</option>
            <option>Dr. Andi - Dokter Umum</option>
            <option>Dr. Rina - Sp.PD</option>
          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label>Tanggal Pemeriksaan</label>
          <input type="datetime-local" class="form-control">
        </div>
      </div>

    </div>
  </div>
</div>

  <div class="card shadow mb-4">
    <div class="card-body">
      <form>

        <div class="row">
          
          <!-- SUBJECTIVE -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Subjective</label>
              <textarea class="form-control" rows="4"
                placeholder="Keluhan utama, riwayat penyakit, dll"></textarea>
            </div>
          </div>

          <!-- OBJECTIVE -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Objective</label>
              <textarea class="form-control" rows="4"
                placeholder="Hasil pemeriksaan fisik"></textarea>
            </div>
          </div>

        </div>

        <!-- TANDA VITAL -->
        <hr>
        <h6 class="font-weight-bold">Tanda Vital</h6>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Suhu (°C)</label>
              <input type="number" class="form-control">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Tensi (mmHg)</label>
              <input type="text" class="form-control" placeholder="120/80">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Nadi (/menit)</label>
              <input type="number" class="form-control">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Respirasi (/menit)</label>
              <input type="number" class="form-control">
            </div>
          </div>
        </div>

        <!-- ASSESSMENT -->
        <div class="form-group">
          <label>Assessment</label>
          <textarea class="form-control" rows="3"
            placeholder="Diagnosis kerja / ICD-10"></textarea>
        </div>

        <!-- PLAN -->
        <div class="form-group">
          <label>Plan</label>
          <textarea class="form-control" rows="3"
            placeholder="Terapi, edukasi, kontrol ulang"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
          Simpan
        </button>

      </form>
    </div>
  </div>

  <div class="card shadow mb-4">
  <div class="card-header font-weight-bold">
    Riwayat SOAP
  </div>
  <div class="card-body">

    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th>Tanggal Pemeriksaan</th>
          <th>Jam</th>
          <th>Dokter</th>
          <th>No. RM</th>
          <th>Pasien</th>
          <th>Assessment</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>03-03-2026</td>
          <td>13:02:20</td>
          <td>Dr. Andi</td>
          <td>000001</td>
          <td>Dita</td>
          <td>Gastritis</td>
          <td>
            <button class="btn btn-sm btn-info">Detail</button>
          </td>
        </tr>
      </tbody>
    </table>

  </div>
</div>
        <!-- End of Main Content -->

        </div>

@include('components.footer')

</div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
  </body>

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
  </body>
</html>
