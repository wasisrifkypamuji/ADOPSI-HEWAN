<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Donasi Hewan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylehome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .form-control {
            background-color: #eee;
            border: none;
            padding: 10px;
            margin-bottom: 15px;
        }
        .upload-box {
            background-color: #eee;
            border: 2px dashed #ccc;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .upload-box:hover {
            background-color: #e0e0e0;
        }
        .upload-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 3px;
        }
        .kirim-btn {
            background-color: #ff6b35;
            color: white;
            border: none;
            padding: 8px 25px;
            border-radius: 5px;
            float: right;
        }
        .img-preview {
            max-width: 100%;
            max-height: 150px;
            border-radius: 5px;
        }
        .alert {
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @extends('layout.navigasi')

    @section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Donasi Hewan</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="bg-light p-4 rounded">
            <!-- Accordion Syarat -->
            <div class="accordion mb-4 w-100" id="accordionExample" data-bs-parent="#accordionExample">
           <div class="accordion-item">
               <h2 class="accordion-header">
                   <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                       Syarat Donasi Hewan
                   </button>
               </h2>
               <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                   <div class="accordion-body">
                       <ul>
                           <li>Hewan dalam kondisi sehat dan terawat</li>
                           <li>Memiliki surat keterangan sehat dari dokter hewan</li>
                           <li>Usia minimal hewan 3 bulan</li>
                           <li>Hewan sudah divaksin rabies (untuk anjing/kucing)</li>
                           <li>Bersedia mengisi surat perjanjian donasi</li>
                           <li>Menyertakan foto dan video kondisi hewan</li>
                           <li>Memberikan informasi lengkap tentang riwayat kesehatan hewan</li>
                       </ul>
                   </div>
               </div>
           </div>
           <div class="accordion-item">
               <h2 class="accordion-header">
                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                       Ketentuan Donasi Hewan
                   </button>
               </h2>
               <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                   <div class="accordion-body">
                       <ul>
                           <li>Donasi bersifat sukarela dan tanpa biaya</li>
                           <li>Data yang diberikan harus lengkap dan valid</li>
                           <li>Proses verifikasi membutuhkan waktu 1-3 hari kerja</li>
                           <li>Tim FindPet berhak menolak donasi jika tidak memenuhi syarat</li>
                           <li>Pendonasi tidak dapat membatalkan donasi setelah disetujui</li>
                           <li>Hewan yang didonasikan akan dirawat sesuai standar FindPet</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>

       <!-- Checkbox Agreement -->
       <div class="form-check mb-4">
           <input class="form-check-input" type="checkbox" id="agreementCheck" required>
           <label class="form-check-label" for="agreementCheck">
               Saya menyetujui syarat dan ketentuan donasi hewan
           </label>
       </div>
      
                        
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Form Donasi -->
            <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Basic Info -->
                <div class="mb-3">
                    <input type="text" name="nama_lengkap" class="form-control bg-gray-100 border-0" 
                           placeholder="Nama Pemilik" required value="{{ old('nama_lengkap') }}">
                </div>

                <div class="mb-3">
                    <select name="id_kategori" class="form-control bg-gray-100 border-0" required>
                        <option value="" disabled selected>Pilih Kategori Hewan</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id_kategori }}" {{ old('id_kategori') == $category->id_kategori ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <input type="text" name="nama_hewan" class="form-control bg-gray-100 border-0" 
                           placeholder="Nama Hewan" required value="{{ old('nama_hewan') }}">
                </div>

                <div class="mb-3">
                    <input type="text" name="ras" class="form-control bg-gray-100 border-0" 
                           placeholder="Ras Hewan" required value="{{ old('ras') }}">
                </div>

                <div class="mb-3">
                    <textarea name="deskripsi" class="form-control bg-gray-100 border-0" rows="4" 
                              placeholder="Deskripsi" required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <input type="number" name="usia" class="form-control bg-gray-100 border-0" 
                           placeholder="Usia" required value="{{ old('usia') }}">
                </div>

                <div class="mb-3">
                    <select name="gender" class="form-control bg-gray-100 border-0" required>
                        <option value="" disabled selected>Gender</option>
                        <option value="Jantan" {{ old('gender') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                        <option value="Betina" {{ old('gender') == 'Betina' ? 'selected' : '' }}>Betina</option>
                    </select>
                </div>

                <!-- Upload Section -->
                <div class="mb-4">
                    <label class="form-label">Upload Foto</label>
                    <div class="bg-gray-100 border-2 border-dashed p-4 text-center rounded upload-box" id="foto-box">
                        <div id="foto-preview" class="text-center">
                            <i class="fas fa-image fa-2x mb-2"></i>
                            <p>Klik untuk upload foto</p>
                        </div>
                        <input type="file" name="foto" class="d-none" accept="image/*" required id="foto-input">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Upload Video (Opsional)</label>
                    <div class="bg-gray-100 border-2 border-dashed p-4 text-center rounded upload-box" id="video-box">
                        <div id="video-preview" class="text-center">
                            <i class="fas fa-video fa-2x mb-2"></i>
                            <p>Klik untuk upload video</p>
                        </div>
                        <input type="file" name="video" class="d-none" accept="video/*" id="video-input">
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="mb-3">
                    <label class="d-block mb-2">Upload Perjanjian Donasi(PDF) </label>
                    <button type="button" class="btn btn-success btn-sm upload-btn" 
                            onclick="document.getElementById('perjanjian').click()">
                        Upload
                    </button>
                    

                    <input type="file" id="perjanjian" name="surat_perjanjian" accept=".pdf" 
                           class="d-none" required>
                    <a href="{{ url('/download-template-perjanjian') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-download me-1"></i> Unduh Template
                    </a>
                </div>

                <div class="mb-4">
                    <label class="d-block mb-2">Surat Keterangan Kesehatan Hewan Oleh Dokter Hewan</label>
                    <button type="button" class="btn btn-success btn-sm upload-btn" 
                            onclick="document.getElementById('surat_sehat').click()">
                        Upload
                    </button>
                    <input type="file" id="surat_sehat" name="surat_keterangan_sehat" accept=".pdf" 
                           class="d-none" required>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview untuk foto
        document.querySelector('#foto-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#foto-preview').innerHTML = `
                        <img src="${e.target.result}" class="img-preview mb-2">
                        <p>${file.name}</p>
                    `;
                }
                reader.readAsDataURL(file);
            }
        });


        // Preview untuk video
        document.querySelector('#video-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.querySelector('#video-preview').innerHTML = `
                    <i class="fas fa-check-circle fa-2x mb-2 text-success"></i>
                    <p>${file.name}</p>
                `;
            }
        });

        // Trigger upload ketika box diklik
        document.querySelectorAll('.upload-box').forEach(box => {
            box.addEventListener('click', function() {
                this.querySelector('input[type="file"]').click();
            });
        });

        // File name display untuk dokumen PDF
        document.querySelectorAll('#perjanjian, #surat_sehat').forEach(input => {
            input.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const fileName = this.files[0].name;
                    this.previousElementSibling.textContent = fileName;
                    this.previousElementSibling.classList.add('btn-success');
                }
            });
        });

        
        document.querySelector('form').addEventListener('submit', function(e) {
            // Disable submit button
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...';
        });

        document.getElementById('donasiForm').addEventListener('submit', function(e) {
        if (!document.getElementById('agreementCheck').checked) {
            e.preventDefault();
            alert('Anda harus menyetujui syarat dan ketentuan terlebih dahulu');
        }
        });

    </script>

    <style>
        
        .accordion {
        margin-bottom: 2rem;
        }
        .form-check {
        margin: 1rem 0 2rem;
        }
        .form-control, .accordion {
        width: 100%;
        }
        .form-control {
            padding: 10px;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #ff6b35;
            border: none;
        }
        .btn-primary:hover {
            background-color: #e55a2b;
        }
        .upload-btn {
            background-color: #4CAF50;
            border: none;
        }
        

        /* Tambahkan di bagian style formulirdonasi.blade.php */
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-dismissible {
            padding-right: 4rem;
        }
    </style>
    @endsection
</body>
</html>