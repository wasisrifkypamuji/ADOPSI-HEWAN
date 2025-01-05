<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Adopsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .footer {
            text-align: center;
            margin-top: 50px;
        }
        .signature {
            margin-top: 200px;
        }
        .signature div {
            display: inline-block;
            width: 45%;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="text-center mb-4">
            <h2>Bukti Adopsi Hewan</h2>
            <p><strong>AdopsiMu</strong></p>
        </div>
        <hr>
        <div class="card p-4 shadow-sm">
            <p><strong>Nama Pemohon:</strong> {{ $adoption->user->nama_lengkap ?? '-' }}</p>
            <p><strong>Email Pemohon:</strong> {{ $adoption->user->email ?? '-' }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $adoption->user->no_telepon ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $adoption->user->alamat ?? '-' }}</p>
            <hr>
            <p><strong>Nama Hewan:</strong> {{ $adoption->hewan->nama_hewan ?? '-' }}</p>
            <p><strong>Jenis Hewan:</strong> {{ $adoption->hewan->kategori->nama_kategori ?? '-' }}</p>
            <p><strong>Umur Hewan:</strong> {{ $adoption->hewan->umur ?? '-' }}</p>
            <p><strong>Jenis Kelamin Hewan:</strong> {{ $adoption->hewan->gender ?? '-' }}</p>
            <hr>
            <p><strong>Tanggal Pengajuan:</strong> {{ $adoption->created_at->format('d/m/Y') }}</p>
            <p><strong>Status Adopsi:</strong> {{ $adoption->status_adopsi }}</p>
            @if($adoption->status_adopsi == 'Ditolak' && $adoption->alasan_penolakan)
                <p><strong>Alasan Penolakan:</strong> {{ $adoption->alasan_penolakan }}</p>
            @endif
        </div>
        <div class="text-center mt-4">
            <p></p>
            <p>
            Dengan adanya bukti ini, pemohon berhak 
            atas adopsi hewan yang disebutkan di atas, 
            dan dapat membawa pulang hewan tersebut setelah proses 
            adopsi disetujui.Harap diperhatikan bahwa surat ini hanya 
            berlaku untuk pengajuan adopsi yang disetujui oleh pihak kami.     
            Terima kasih telah mengadopsi hewan melalui AdopsiMu.</p>
        </div>
    </div>
    <div class="footer">
        <p>Terima kasih telah mengadopsi hewan melalui AdopsiMu.</p>
    </div>

    <div class="signature">
        <div>
            <p>_______________________</p>
            <p><strong>Tanda Tangan Pemohon</strong></p>
        </div>
        <div>
            <p>_______________________</p>
            <p><strong>Tanda Tangan Pihak Admin</strong></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
