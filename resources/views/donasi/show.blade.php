<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Donasi Hewan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylehome.css') }}">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body>
    <!-- navbar -->
    @extends('layout.navigasi')

    <!-- Content -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Donasikan Hewan</h1>

        <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="nama_lengkap">
                    Nama Lengkap
                </label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="id_kategori">
                    Kategori Hewan
                </label>
                <select name="id_kategori" id="id_kategori" class="form-select w-full" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="nama_hewan">
                    Nama Hewan
                </label>
                <input type="text" name="nama_hewan" id="nama_hewan" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="deskripsi">
                    Deskripsi
                </label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-textarea w-full" required></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="usia">
                        Usia
                    </label>
                    <input type="text" name="usia" id="usia" class="form-input w-full" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="gender">
                        Jenis Kelamin
                    </label>
                    <select name="gender" id="gender" class="form-select w-full" required>
                        <option value="Jantan">Jantan</option>
                        <option value="Betina">Betina</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="foto">
                    Foto Hewan
                </label>
                <input type="file" name="foto" id="foto" class="form-input w-full" accept="image/*" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="video">
                    Video (Opsional)
                </label>
                <input type="file" name="video" id="video" class="form-input w-full" accept="video/*">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="surat_perjanjian">
                    Surat Perjanjian
                </label>
                <input type="file" name="surat_perjanjian" id="surat_perjanjian" class="form-input w-full" accept=".pdf" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="surat_keterangan_sehat">
                    Surat Keterangan Sehat
                </label>
                <input type="file" name="surat_keterangan_sehat" id="surat_keterangan_sehat" class="form-input w-full" accept=".pdf" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Submit Donasi
            </button>
        </form>
    </div>

    <!-- footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; 2024 Adopsi Hewan. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>