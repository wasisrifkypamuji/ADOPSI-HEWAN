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



 <!-- Daftar Komentar -->
 <div class="mt-5">
    @forelse ($komentar as $komen)
        <div class="d-flex align-items-start mb-4 p-3 comment-box">
            <img src="{{ $komen->foto ? asset('uploads/' . $komen->foto) : 'https://via.placeholder.com/50' }}" alt="Avatar" class="rounded-circle me-3">
            <div>
                <h5 class="mb-1">{{ $komen->username ?? 'Anonim' }}</h5>
                <p>{{ $komen->komen }}</p>

                <!-- Tampilkan Balasan -->
                @if ($komen->balasan)
                    <div class="mt-4 ms-4">
                        <p><strong>Balasan:</strong> {{ $komen->balasan }}</p>
                    </div>
                @endif

                <!-- Form untuk Membalas Komentar -->
                <form action="{{ route('komentar.reply', $komen->id_komen) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <textarea name="balasan" class="form-control" placeholder="Tulis balasan..." rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-balas">Balas</button>
                </form>

                <!-- Tombol Hapus Komentar -->
                <form action="{{ route('komentar.destroy', $komen->id_komen) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p>Tidak ada komentar.</p>
    @endforelse
</div>
    </div>
</section>

<!-- Footer
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>Findpet.</h3>
            <p>Temukan teman setia Anda di FindPet - platform adopsi hewan terpercaya untuk memberi mereka rumah penuh kasih!</p>
        </div>
        <div class="footer-section">
            <h3>Costumer Information</h3>
            <ul>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/how-to-adopt">How To Adopt?</a></li>
            </ul>
        </div>
    </div>
</footer> -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection
