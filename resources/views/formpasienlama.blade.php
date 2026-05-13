<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables </title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


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
                    <h1 class="h3 mb-4 text-gray-800">Form Pasien Lama</h1>

<div class="card shadow mb-4">
    <div class="card-body">

        <form id="formPasien">

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>No Rekam Medis</label>
                    <input type="text" class="form-control" id="noRM" required>
                </div>

                <div class="form-group col-md-4">
                    <label>Nama Pasien</label>
                    <input type="text" class="form-control" id="nama" required>
                </div>

                <div class="form-group col-md-4">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tglLahir" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Cari Data
            </button>

        </form>

        <hr>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No RM</th>
                        <th>Nama</th>
                        <th>Diagnosa</th>
                        <th>Dokter</th>
                        <th>Status BPJS</th>
                    </tr>
                </thead>
                <tbody id="hasilBody">
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
const dataPasien = [
    {
        noRM: "RM001",
        nik: "1234567890",
        tglLahir: "1990-05-12",
        nama: "Ahmad Fauzi",
        diagnosa: "Hipertensi",
        dokter: "Dr. Andi",
        bpjs: "Aktif"
    },
    {
        noRM: "RM002",
        nik: "0987654321",
        tglLahir: "1985-03-20",
        nama: "Siti Rahma",
        diagnosa: "Diabetes",
        dokter: "Dr. Budi",
        bpjs: "Tidak Aktif"
    }
];

document.getElementById("formPasien").addEventListener("submit", function(e){
    e.preventDefault();

    const noRM = document.getElementById("noRM").value;
    const nama = document.getElementById("nama").value;
    const tglLahir = document.getElementById("tglLahir").value;
    const hasilBody = document.getElementById("hasilBody");

    if(noRM === "" || nama === "" || tglLahir === ""){
        alert("Semua field wajib diisi!");
        return;
    }

    const hasil = dataPasien.find(p =>
        p.noRM === noRM &&
        p.nama === nama &&
        p.tglLahir === tglLahir
    );

    hasilBody.innerHTML = "";

    if(hasil){
        hasilBody.innerHTML = `
            <tr>
                <td>${hasil.noRM}</td>
                <td>${hasil.nama}</td>
                <td>${hasil.diagnosa}</td>
                <td>${hasil.dokter}</td>
                <td>
                    <span class="badge ${hasil.bpjs === 'Aktif' ? 'badge-success' : 'badge-danger'}">
                        ${hasil.bpjs}
                    </span>
                </td>
            </tr>
        `;
    } else {
        hasilBody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center text-danger font-weight-bold">
                    Data tidak ditemukan
                </td>
            </tr>
        `;
    }

});

</script>
</div>

@include('components.footer')

</div>
</body>
</html>