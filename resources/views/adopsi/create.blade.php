@extends('layout.navigasi')

@section('content')
<div class="container py-4">
   <h1 class="text-center mb-4">Form Adopsi {{ $hewan->nama_hewan }}</h1>
   
   <!-- acordion adopsi -->
   <div class="row justify-content-center mb-4">
       <div class="col-md-8">
           <div class="card shadow-sm">
               <div class="accordion w-100" id="accordionSyarat">
                   <div class="accordion-item">
                       <h2 class="accordion-header" id="headingOne">
                           <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                   data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                               <strong>Persyaratan Adopsi</strong>
                           </button>
                       </h2>
                       <div id="collapseOne" class="accordion-collapse collapse show" 
                            aria-labelledby="headingOne" data-bs-parent="#accordionSyarat">
                           <div class="accordion-body">
                               <ol class="mb-0">
                                   <li class="mb-2">Berusia minimal 21 tahun atau sudah menikah</li>
                                   <li class="mb-2">Memiliki KTP dan tempat tinggal tetap</li>
                                   <li class="mb-2">Memiliki penghasilan tetap</li>
                                   <li class="mb-2">Mendapat persetujuan dari semua anggota keluarga</li>
                                   <li class="mb-2">Bersedia untuk dilakukan survei tempat tinggal</li>
                                   <li class="mb-2">Siap bertanggung jawab atas kebutuhan hewan adopsi</li>
                               </ol>
                           </div>
                       </div>
                   </div>

                   <div class="accordion-item">
                       <h2 class="accordion-header" id="headingTwo">
                           <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                   data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                               <strong>Ketentuan Adopsi</strong>
                           </button>
                       </h2>
                       <div id="collapseTwo" class="accordion-collapse collapse" 
                            aria-labelledby="headingTwo" data-bs-parent="#accordionSyarat">
                           <div class="accordion-body">
                               <ol class="mb-4">
                                   <li class="mb-2">Hewan adopsi tidak untuk diperjualbelikan</li>
                                   <li class="mb-2">Bersedia mengirimkan update kondisi hewan secara berkala</li>
                                   <li class="mb-2">Bersedia mengembalikan hewan jika ditemukan pelanggaran</li>
                                   <li class="mb-2">Mengisi form perjanjian adopsi dengan lengkap</li>
                                   <li class="mb-2">Bersedia untuk dihubungi terkait survei pasca adopsi</li>
                               </ol>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

   <!-- Form adopsi -->
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card shadow-sm">
               <div class="card-body">
                   @if ($errors->any())
                       <div class="alert alert-danger">
                           <ul class="mb-0">
                               @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                               @endforeach
                           </ul>
                       </div>
                   @endif

                   <form action="{{ route('adopsi.store') }}" method="POST" enctype="multipart/form-data">
                       @csrf
                       <input type="hidden" name="id_hewan" value="{{ $hewan->id_hewan }}">
                       
                       <!-- Data Diri -->
                       <div class="mb-4">
                           <h5 class="border-bottom pb-2 mb-3">Data Diri</h5>
                           <div class="mb-3">
                               <label class="form-label">Nama Lengkap</label>
                               <input type="text" class="form-control" name="nama_lengkap" value="{{ Auth::user()->nama_lengkap }}" readonly>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Email</label>
                               <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Nomor Telepon</label>
                               <input type="text" class="form-control" name="no_telepon" value="{{ Auth::user()->no_telepon }}" readonly>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Alamat Lengkap</label>
                               <textarea class="form-control" name="alamat" rows="3" readonly>{{ Auth::user()->alamat }}</textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Pekerjaan</label>
                               <input type="text" class="form-control" name="pekerjaan" value="{{ Auth::user()->pekerjaan }}" readonly>
                           </div>

                           <div class="alert alert-info">
                               <small>Jika ada data diri yang perlu diperbarui, silakan update melalui halaman profil Anda.</small>
                           </div>
                       </div>

                       <!-- Pertanyaan -->
                       <div class="mb-4">
                           <h5 class="border-bottom pb-2 mb-3">Pertanyaan Kualifikasi</h5>
                           <div class="mb-3">
                               <label class="form-label">1. Apakah Anda memiliki pengalaman memelihara hewan?</label>
                               <textarea class="form-control" name="q1" rows="2" required>{{ old('q1') }}</textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">2. Berapa banyak waktu yang dapat Anda luangkan untuk merawat hewan?</label>
                               <textarea class="form-control" name="q2" rows="2" required>{{ old('q2') }}</textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">3. Apakah Anda memiliki hewan peliharaan lain? Jika ya, sebutkan.</label>
                               <textarea class="form-control" name="q3" rows="2" required>{{ old('q3') }}</textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">4. Apakah semua anggota keluarga setuju dengan adopsi ini?</label>
                               <textarea class="form-control" name="q4" rows="2" required>{{ old('q4') }}</textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">5. Dimana hewan akan tinggal? (Indoor/Outdoor)</label>
                               <textarea class="form-control" name="q5" rows="2" required>{{ old('q5') }}</textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">6. Bagaimana rencana perawatan kesehatan hewan?</label>
                               <textarea class="form-control" name="q6" rows="2" required>{{ old('q6') }}</textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">7. Apakah Anda siap dengan biaya perawatan hewan?</label>
                               <textarea class="form-control" name="q7" rows="2" required>{{ old('q7') }}</textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">8. Bagaimana rencana Anda jika harus berpergian?</label>
                               <textarea class="form-control" name="q8" rows="2" required>{{ old('q8') }}</textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">9. Mengapa Anda ingin mengadopsi hewan ini?</label>
                               <textarea class="form-control" name="q9" rows="2" required>{{ old('q9') }}</textarea>
                           </div>
                       </div>

                       <!-- Surat Perjanjian -->
                       <div class="mb-4">
                           <h5 class="border-bottom pb-2 mb-3">Surat Perjanjian</h5>
                           <div class="mb-3">
                               <label class="form-label">Upload Surat Perjanjian (PDF/JPG/PNG, max 2MB) <span class="text-danger">*</span></label>
                               <input type="file" class="form-control" name="surat_perjanjian" accept=".pdf,.jpg,.jpeg,.png" required>
                               <div class="form-text">Format yang diterima: PDF, JPG, JPEG, PNG. Maksimal ukuran file 2MB.</div>

                               <a href="{{ url('/download-template-adopsi') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-download me-1"></i> Unduh Template
                              </a>
                           </div>
                       </div>

                       <div class="d-grid gap-4">
                           <button type="submit" class="btn-nav">Kirim Pengajuan Adopsi</button>
                           <a href="{{ route('adopsi.index') }}" class="btn btn-danger">Batal</a>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection