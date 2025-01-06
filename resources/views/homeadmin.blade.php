@extends('layout.navigasiadmin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopsi Hewan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylehomeadmin.css') }}">
</head>
<body>

    <!-- Main Content -->
    <main>
        <section class="hero">
            <div class="content">
                <h2>Temukan Hewan Peliharaan Yang Kamu Sukai !</h2>
                <p>
                    FindaPet hadir untuk membantu Anda menemukan hewan peliharaan impian yang siap diadopsi.
                    Kami bekerja sama dengan berbagai tempat penampungan untuk memberikan rumah baru penuh kasih
                    setiap hewan yang membutuhkan.
                </p>
                <button class="cta-button">Adopsi Sekarang</button>
            </div>
            <div class="hero-image">
                <img src="Images Admin\image 1.png" alt="Ilustrasi Orang dan Kucing">
            </div>
        </section>
    </main>

<!-- Carousel -->
    <div id="carouselCardControls" class="carousel slide p-5" data-bs-ride="carousel">
    <h1 style="text-align: center; padding: 20px;">Pilih Hewan Peliharaan</h1>
    <div class="carousel-inner">

    <div class="carousel-item active">
        <div class="row">
            @foreach($hewans->take(5) as $hewan)
            <div class="col-md-2 @if($loop->first) offset-md-1 @endif">
                <div class="card">
                    <img src="{{ Storage::url($hewan->foto) }}" class="card-img-top" alt="{{ $hewan->nama_hewan }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $hewan->nama_hewan }}</h5>
                        <p class="card-text">{{ Str::limit($hewan->deskripsi, 50) }}</p>
                        <a href="{{ route('admin.detailhewan', $hewan->id_hewan) }}" class="btn btn-card me-2">Lihat Detail >></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="carousel-item">
        <div class="row">
            @foreach($hewans->skip(5)->take(5) as $hewan)
            <div class="col-md-2 @if($loop->first) offset-md-1 @endif">
                <div class="card">
                    <img src="{{ Storage::url($hewan->foto) }}" class="card-img-top" alt="{{ $hewan->nama_hewan }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $hewan->nama_hewan }}</h5>
                        <p class="card-text">{{ Str::limit($hewan->deskripsi, 50) }}</p>
                        <a href="{{ route('admin.detailhewan', $hewan->id_hewan) }}" class="btn btn-card me-2">Lihat Detail >></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>




    <!-- Carousel Navigation Buttons -->
    <button class="carousel-control-prev btn btn-nav me-2" type="button" data-bs-target="#carouselCardControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next btn btn-nav me-2" type="button" data-bs-target="#carouselCardControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


    <!-- Acordion -->
    <h1 style="text-align: center;">Pertanyaan Umum</h1>
    <div class="accordion-wrapper">
<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Apa itu FindaPet?
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <strong>FindaPet</strong> adalah platform yang membantu Anda menemukan hewan peliharaan impian yang siap diadopsi. Kami bekerja sama dengan tempat penampungan hewan untuk memberikan rumah baru bagi hewan yang membutuhkan.
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Apa jenis hewan yang tersedia untuk diadopsi di FindaPet?
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                Di <strong>FindaPet</strong>, Anda dapat menemukan berbagai jenis hewan peliharaan, seperti anjing, kucing, dan hewan lainnya. Kami juga bekerja sama dengan berbagai penampungan untuk memastikan pilihan yang beragam.
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Bagaimana cara mengadopsi hewan peliharaan melalui FindaPet?
            </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                Untuk mengadopsi hewan peliharaan melalui <strong>FindaPet</strong>, Anda dapat mencari hewan yang sesuai dengan preferensi Anda, lalu melenkapi formulir adopsi di situs kami. Setelah itu, Anda dapat mengadopsi hewan melalui FindaPet.
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Apakah ada biaya untuk mengadopsi hewan melalui FindaPet?
            </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                Tidak ada biaya untuk mengadopsi hewan melalui <strong>FindaPet</strong> tetapi ada syarat dan ketentuan yang harus dipenuhi.
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                Apa yang perlu dipersiapkan sebelum mengadopsi hewan peliharaan?
            </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                Sebelum mengadopsi hewan peliharaan, pastikan Anda sudah menyiapkan rumah yang aman dan nyaman, peralatan dasar seperti kandang, makanan, dan akses ke layanan kesehatan hewan. Kami juga menyarankan agar Anda memahami tanggung jawab dalam merawat hewan peliharaan dengan baik.
            </div>
        </div>
    </div>
</div>
    </div>


    <!-- daftar komen -->
    <div class="comments-list">
      <h2 class="text-center mb-4">Cerita Orang</h2>
      @foreach($komentars as $komentar)
        <div class="comment-card card mb-3">
          <div class="card-body">
            <div class="comment-header d-flex align-items-center mb-2">
              <div class="avatar me-2">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($komentar->username) }}" 
                     alt="{{ $komentar->username }}" 
                     class="rounded-circle" 
                     width="40">
              </div>
              <h6 class="mb-0">{{ $komentar->username }}</h6>
            </div>
            <p class="card-text">{{ $komentar->komen }}</p>            
            
            <div class="comment-actions d-flex gap-2">
              @if($komentar->foto)
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal{{ $komentar->id_komen }}">
                  <i class="bi bi-image"></i> Lihat Foto
                </button>
              @endif
              
              @if($komentar->video)
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#videoModal{{ $komentar->id_komen }}">
                  <i class="bi bi-play-circle"></i> Lihat Video
                </button>
              @endif
              
              @if(Auth::check())
                <button class="btn text-primary btn-sm" onclick="toggleReplyForm({{ $komentar->id_komen }})">
                  <i class="bi bi-reply"></i> Balas
                </button>
                
                @if(Auth::id() === $komentar->user_id)
                  <form action="{{ route('komentar.destroy', $komentar->id_komen) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn text-danger btn-sm" 
                            onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </form>
                @endif
              @endif
            </div>

            <!-- form balasan -->
            <div id="replyForm{{ $komentar->id_komen }}" class="reply-form mt-3" style="display: none;">
              <form action="{{ route('komentar.reply', $komentar->id_komen) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <textarea class="form-control" name="komen" placeholder="Tulis balasan..." rows="2" required></textarea>
                </div>
                
                <div class="media-upload d-flex gap-2 mb-3">
                  <label class="btn btn-outline-secondary" role="button">
                    <i class="bi bi-image"></i>
                    <input type="file" name="foto" class="d-none" accept="image/*" 
                           onchange="previewReplyImage(this, {{ $komentar->id_komen }})">
                  </label>
                  <label class="btn btn-outline-secondary" role="button">
                    <i class="bi bi-camera-video"></i>
                    <input type="file" name="video" class="d-none" accept="video/*" 
                           onchange="previewReplyVideo(this, {{ $komentar->id_komen }})">
                  </label>
                </div>

                <div class="preview-section mb-3 d-flex gap-2">
                  <div id="replyImagePreview{{ $komentar->id_komen }}" class="d-none">
                    <img src="#" class="img-fluid" style="max-width: 200px; cursor: pointer;">
                  </div>
                  <div id="replyVideoPreview{{ $komentar->id_komen }}" class="d-none">
                    <video class="img-fluid" style="max-width: 200px;" controls>
                      <source src="#" type="video/mp4">
                    </video>
                  </div>
                </div>

                <div class="reply-actions">
                  <button type="submit" class="btn-nav me-2">Kirim</button>
                  <button type="button" class="btn btn-danger" 
                          onclick="toggleReplyForm({{ $komentar->id_komen }})">Batal</button>
                </div>
              </form>
            </div>

 <!-- balasan komen-->
@if($komentar->replies && $komentar->replies->count() > 0)
  <div class="replies-list ms-4 mt-3">
    @foreach($komentar->replies as $reply)
      <div class="reply-card card mb-2">
        <div class="card-body">
          <div class="reply-header d-flex align-items-center mb-2">
            <div class="avatar me-2">
              <img src="https://ui-avatars.com/api/?name={{ urlencode($reply->username) }}" 
                   alt="{{ $reply->username }}"
                   class="rounded-circle" 
                   width="30">
            </div>
            <h6 class="mb-0">{{ $reply->username }}</h6>
          </div>
          
          <p class="card-text">{{ $reply->komen }}</p>
          
          <div class="reply-actions d-flex gap-2">
            @if($reply->foto)
              <button class="btn btn-light btn-sm" data-bs-toggle="modal" 
                      data-bs-target="#replyImageModal{{ $reply->id_komen }}">
                <i class="bi bi-image"></i> Lihat Foto
              </button>
            @endif
            
            @if($reply->video)
              <button class="btn btn-light btn-sm" data-bs-toggle="modal" 
                      data-bs-target="#replyVideoModal{{ $reply->id_komen }}">
                <i class="bi bi-play-circle"></i> Lihat Video
              </button>
            @endif

            @if(Auth::guard('admin')->check() && $reply->username === 'Admin')
              <form action="{{ route('komentar.destroy', $reply->id_komen) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn text-danger btn-sm" 
                        onclick="return confirm('Apakah Anda yakin ingin menghapus balasan ini?')">
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </form>
            @endif
          </div>
        </div>
      </div>

      <!-- Reply Modals -->
      @if($reply->foto)
        <div class="modal fade" id="replyImageModal{{ $reply->id_komen }}" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Foto Balasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <img src="{{ Storage::url($reply->foto) }}" alt="Reply Image" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      @endif

      @if($reply->video)
        <div class="modal fade" id="replyVideoModal{{ $reply->id_komen }}" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Video Balasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <video controls class="w-100">
                  <source src="{{ Storage::url($reply->video) }}" type="video/mp4">
                </video>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endforeach
  </div>
@endif

            <!-- Comment Modals -->
            @if($komentar->foto)
              <div class="modal fade" id="imageModal{{ $komentar->id_komen }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Foto</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <img src="{{ Storage::url($komentar->foto) }}" alt="Comment Image" class="img-fluid">
                    </div>
                  </div>
                </div>
              </div>
            @endif

            @if($komentar->video)
              <div class="modal fade" id="videoModal{{ $komentar->id_komen }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Video</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <video controls class="w-100">
                        <source src="{{ Storage::url($komentar->video) }}" type="video/mp4">
                      </video>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<script src="{{ asset('js/komen.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection
