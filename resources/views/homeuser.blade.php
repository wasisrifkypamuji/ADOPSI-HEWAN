@extends('layout.navigasi')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adopsi Hewan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/stylehome.css') }}">
  </head>
<body>

    <div class="container bg-gray p-5" style="color: white;">
      <h1>Temukan Hewan Peliharaan Yang Kamu Sukai!</h1>
      <p style="font-family: Arial, Helvetica, sans-serif;">FindaPet membantu Anda menemukan hewan peliharaan <br>
        impian yang siap diadopsi. Kami bekerja sama dengan tempat penampungan <br>
        untuk memberikan rumah baru penuh kasih bagi hewan yang membutuhkan, <br>
        dengan memastikan setiap hewan telah melalui pemeriksaan kesehatan yang baik.</p>
      <button class="btn-nav me-2">Adopsi Sekarang</button>
    </div>

<div id="carouselCardControls" class="carousel slide p-5" data-bs-ride="carousel">
  <h1 style="text-align: center;">Pilih Hewan Peliharaan</h1>
  <div class="carousel-inner">
    <!--Item 1 -->
    <div class="carousel-item active">
      <div class="row">
        <div class="col-md-2 offset-md-1">
          <div class="card">
            <img src="https://shorturl.at/yNAI4" class="card-img-top" alt="Kucing 1">
            <div class="card-body text-center">
              <h5 class="card-title">Kucing 1</h5>
              <p class="card-text">Kucing putih yang lucu.</p>
              <button class="btn-nav me-2">Adopsi Sekarang</button>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card">
            <img src="https://shorturl.at/yNAI4" class="card-img-top" alt="Kucing 2">
            <div class="card-body text-center">
              <h5 class="card-title">Kucing 2</h5>
              <p class="card-text">Kucing hitam yang menggemaskan.</p>
              <button class="btn-nav me-2">Adopsi Sekarang</button>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card">
            <img src="https://shorturl.at/yNAI4" class="card-img-top" alt="Kucing 3">
            <div class="card-body text-center">
              <h5 class="card-title">Kucing 3</h5>
              <p class="card-text">Kucing abu-abu dengan mata besar.</p>
              <button class="btn-nav me-2">Adopsi Sekarang</button>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card">
            <img src="https://shorturl.at/yNAI4" class="card-img-top" alt="Kucing 4">
            <div class="card-body text-center">
              <h5 class="card-title">Kucing 4</h5>
              <p class="card-text">Kucing coklat dengan ekor panjang.</p>
              <button class="btn-nav me-2">Adopsi Sekarang</button>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card">
            <img src="https://shorturl.at/yNAI4" class="card-img-top" alt="Kucing 5">
            <div class="card-body text-center">
              <h5 class="card-title">Kucing 5</h5>
              <p class="card-text">Kucing dengan bulu lebat.</p>
              <button class="btn-nav me-2">Adopsi Sekarang</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Item 2 -->
    <div class="carousel-item">
      <div class="row">
        <div class="col-md-2 offset-md-1">
          <div class="card">
            <img src="https://shorturl.at/yNAI4" class="card-img-top" alt="Kucing 6">
            <div class="card-body text-center">
              <h5 class="card-title">Kucing 6</h5>
              <p class="card-text">Kucing yang ramah dan penuh kasih.</p>
              <button class="btn-nav me-2">Adopsi Sekarang</button>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card">
            <img src="https://shorturl.at/yNAI4" class="card-img-top" alt="Kucing 7">
            <div class="card-body text-center">
              <h5 class="card-title">Kucing 7</h5>
              <p class="card-text">Kucing dengan ekspresi lucu.</p>
              <button class="btn-nav me-2">Adopsi Sekarang</button>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card">
            <img src="https://shorturl.at/yNAI4" class="card-img-top" alt="Kucing 8">
            <div class="card-body text-center">
              <h5 class="card-title">Kucing 8</h5>
              <p class="card-text">Kucing anggora berbulu halus.</p>
              <button class="btn-nav me-2">Adopsi Sekarang</button>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card">
            <img src="https://shorturl.at/yNAI4" class="card-img-top" alt="Kucing 9">
            <div class="card-body text-center">
              <h5 class="card-title">Kucing 9</h5>
              <p class="card-text">Kucing dengan karakter ceria.</p>
              <button class="btn-nav me-2">Adopsi Sekarang</button>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card">
            <img src="https://shorturl.at/yNAI4" class="card-img-top" alt="Kucing 10">
            <div class="card-body text-center">
              <h5 class="card-title">Kucing 10</h5>
              <p class="card-text">Kucing yang suka bermain bola.</p>
              <button class="btn-nav me-2">Adopsi Sekarang</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--tombol navigasi carousel -->
  <button class="carousel-control-prev btn btn-nav me-2" type="button" data-bs-target="#carouselCardControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next btn btn-nav me-2" type="button" data-bs-target="#carouselCardControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


  <!-- acordion -->
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


  <!-- Komentar -->
  <section class="komentar my-5">
    <div class="container">
      <h2 class="text-center mb-4">Bagikan Ceritamu</h2>
      <form>
            <div class="mb-3 d-flex justify-content-start">
                <button type="button" class="btn btn-outline-secondary me-2" title="Tambahkan Gambar">
                    <i class="bi bi-image"></i> 
                </button>
                <button type="button" class="btn btn-outline-secondary me-2" title="Tambahkan Video">
                    <i class="bi bi-camera-video"></i> 
                </button>
            </div>
            <div class="mb-3">
                <textarea class="form-control" placeholder="Bagikan cerita menarik..." rows="5" required></textarea>
            </div>
            <button type="submit" class="btn-nav btn-kirim">Kirim</button>
        </form>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
