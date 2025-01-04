<!DOCTYPE html>
<html>
<head>
    <title>Bukti Penerimaan Donasi Hewan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature-space {
            height: 80px;
        }
        #loading {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255,255,255,0.9);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
    <div id="content-to-pdf">
        <div class="header">
            <div class="title">BUKTI PENERIMAAN DONASI HEWAN</div>
            <div>Nomor: DNH-{{ str_pad($donation->id_kirim, 4, '0', STR_PAD_LEFT) }}/{{ date('Y') }}</div>
        </div>

        <div class="content">
            <div class="info-item">
                <strong>Tanggal Penerimaan:</strong> {{ $donation->updated_at->format('d F Y') }}
            </div>
            <div class="info-item">
                <strong>Nama Pendonasi:</strong> {{ $donation->nama_lengkap }}
            </div>
            <div class="info-item">
                <strong>Nama Hewan:</strong> {{ $donation->nama_hewan }}
            </div>
            <div class="info-item">
                <strong>Kategori:</strong> {{ $donation->nama_kategori }}
            </div>
            <div class="info-item">
                <strong>Usia Hewan:</strong> {{ $donation->usia }}
            </div>
            <div class="info-item">
                <strong>Jenis Kelamin:</strong> {{ $donation->gender }}
            </div>
        </div>

        <div class="content">
            <p>Dengan ini menyatakan bahwa donasi hewan telah diterima dan akan dirawat sesuai dengan ketentuan yang berlaku di FindPet.</p>
        </div>

        <div class="footer">
            <p>Jakarta, {{ date('d F Y') }}</p>
            <p>Admin FindPet,</p>
            <div class="signature-space"></div>
            <p>( {{ Auth::guard('admin')->user()->nama }} )</p>
        </div>
    </div>

    <div id="loading">Generating PDF...</div>
    
    <button onclick="generatePDF()" style="margin: 20px;" class="btn btn-primary">Download PDF</button>

    <script>
        window.jsPDF = window.jspdf.jsPDF;
        
        function generatePDF() {
            const loading = document.getElementById('loading');
            loading.style.display = 'block';
            
            const element = document.getElementById('content-to-pdf');
            html2canvas(element).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF();
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('bukti_terima_donasi.pdf');
                
                loading.style.display = 'none';
            }).catch(error => {
                console.error('Error generating PDF:', error);
                loading.style.display = 'none';
                alert('Terjadi kesalahan saat membuat PDF. Silakan coba lagi.');
            });
        }
    </script>
</body>
</html>