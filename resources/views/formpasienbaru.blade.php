<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pasien Baru</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>

/* SIDEBAR gradasi sama kayak login */
.sidebar {
   background-color: #778d8d !important;
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
                    <h1 class="h3 mb-4 text-gray-800">Pasien Baru</h1>

                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Circle Buttons -->
                            <div class="card shadow mb-7">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Identitas Pasien</h6>
                                </div>
                                <div class="card-body">
                                     <form>
                                            <!-- Nama Pasien -->
                                              <div class="form-group">
                <label>Nama Pasien <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_pasien">
            </div>

                                      <!-- No KTP -->
            <div class="form-group">
                <label>No KTP</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="no_ktp">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-success" type="button">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div> 
             <!-- Tanggal Lahir -->
            <div class="form-group">
                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="tanggal_lahir">
            </div>
             <!-- Umur -->
            <div class="form-group">
                <label>Umur <span class="text-danger">*</span></label>
                <div class="form-row">
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Tahun">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Bulan">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Hari">
                    </div>
                </div>
            </div>
             <!-- Jenis Kelamin -->
            <div class="form-group">
                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-control" name="jenis_kelamin">
                    <option value="">-- Pilih --</option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>

             <!-- Golongan Darah -->
            <div class="form-group">
                <label>Golongan Darah</label>
                <select class="form-control" name="golongan_darah">
                    <option value="">-- Pilih --</option>
                    <option>A</option>
                    <option>B</option>
                    <option>AB</option>
                    <option>O</option>
                </select>
            </div>


                                      <!-- Agama -->
            <div class="form-group">
                <label>Agama</label>
                <select class="form-control" name="agama">
                    <option value="">-- Pilih Agama --</option>
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katolik</option>
                    <option>Hindu</option>
                    <option>Buddha</option>
                    <option>Konghucu</option>
                </select>
            </div>

            <div class="form-group">
    <label>Wilayah</label>
    <select class="form-control" name="wilayah">
        <option value="">-- Pilih Wilayah --</option>
        <option value="dalam">Dalam Kab. Jember</option>
        <option value="luar">Luar Kab. Jember</option>
    </select>
</div>
              <!-- Alamat -->
            <div class="form-group">
                <label>Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control" rows="3" name="alamat"></textarea>
            </div>
        
             <div class="form-group">
    <label>Pekerjaan</label>
    <select class="form-control" name="pekerjaan">
        <option value="">-- Pilih Pekerjaan --</option>
        <option>Pelajar</option>
        <option>Mahasiswa</option>
        <option>PNS</option>
        <option>Swasta</option>
        <option>Wiraswasta</option>
        <option>Ibu Rumah Tangga</option>
        <option>Lainnya</option>
    </select>
</div>
          
             <!-- Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email">
            </div>
              <!-- No Telp -->
            <div class="form-group">
                <label>No Telp / WA </label>
                <input type="text" class="form-control" name="telp1">
            </div>
            <div class="form-group">
    <label>Tujuan Poli</label>
    <select class="form-control" name="tujuan_poli">
        <option value="">-- Pilih Poli --</option>
        <option>Poli Umum</option>
        <option>Poli Gigi</option>
        <option>Poli Anak</option>
        <option>Poli Kandungan</option>
        <option>Poli Penyakit Dalam</option>
        <option>Poli Bedah</option>
    </select>
</div>

            
            
                            <!-- Brand Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-4">
                                    <h6 class="m-0 font-weight-bold text-primary">Keterangan</h6>
                                </div>
                                <div class="card-body">
                                   <div class="row">
    <label>Rujukan </label>
    <select class="form-control" name="tujuan_poli">
        <option value="">-- Rujukan --</option>
        <option>Sendiri/Keluarga</option>
        <option>Rumah Sakit</option>
        <option>Dokter</option>
        <option>Klinik</option>
        <option>Puskesmas</option>
    </select>
</div>
<div class="form-group mb-3"></div>
 <!-- Tanggal Kunjungan -->
            <div class="form-group">
                <label>Tanggal Kunjungan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="tanggal_lahir">
            </div>
          <div>
            <div class="form-group mb-3"></div>
    <!--Kunjungan -->                     
            <label>Kunjungan</label>
    <select class="form-control" name="tujuan_poli">
        <option value="">-- Kunjungan --</option>
        <option>Sakit</option>
        <option>Kontrol</option>
    </select>
</div>
<div class="form-group mb-3"></div>
  <!-- Tombol -->
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>

        </form>
    </div>
</div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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

</body>

</html>