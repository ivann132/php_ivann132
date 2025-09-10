<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Person dan Hobi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .search-section {
            padding: 30px;
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
        }

        .search-form {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #495057;
        }

        .form-group input {
            padding: 12px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            transform: translateY(-1px);
        }

        .search-btn {
            padding: 12px 25px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }

        .data-section {
            padding: 30px;
        }

        .person-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .person-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .person-info {
            padding: 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: relative;
        }

        .person-info::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid #764ba2;
        }

        .person-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .person-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .hobi-section {
            padding: 25px;
            background: #f8f9fa;
        }

        .hobi-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #495057;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hobi-title::before {
            content: '🎯';
            font-size: 1.2rem;
        }

        .hobi-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .hobi-item {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: default;
        }

        .hobi-item:hover {
            transform: scale(1.05);
            box-shadow: 0 3px 10px rgba(79, 172, 254, 0.4);
        }

        .no-data {
            text-align: center;
            padding: 50px;
            color: #6c757d;
            font-size: 1.1rem;
        }

        .no-data::before {
            content: '🔍';
            font-size: 3rem;
            display: block;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .search-form {
                grid-template-columns: 1fr;
            }
            
            .person-details {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }

        .loading {
            text-align: center;
            padding: 50px;
            color: #6c757d;
        }

        .loading::after {
            content: '';
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4facfe;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Database Person & Hobi</h1>
            <p>Sistem Informasi Data Personal dan Hobi</p>
        </div>

        <div class="search-section">
            <form class="search-form" id="searchForm">
                <div class="form-group">
                    <label for="searchNama">Nama</label>
                    <input type="text" id="searchNama" placeholder="Cari berdasarkan nama...">
                </div>
                <div class="form-group">
                    <label for="searchAlamat">Alamat</label>
                    <input type="text" id="searchAlamat" placeholder="Cari berdasarkan alamat...">
                </div>
                <div class="form-group">
                    <label for="searchHobi">Hobi</label>
                    <input type="text" id="searchHobi" placeholder="Cari berdasarkan hobi...">
                </div>
                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>

        <div class="data-section">
            <div id="dataContainer">
                <!-- Data will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        // Sample data - In real application, this would come from database
        const sampleData = [
            {
                id: 1,
                nama: "John Doe",
                alamat: "Jl. Merdeka No. 123, Jakarta",
                telepon: "081234567890",
                email: "john.doe@email.com",
                hobi: [
                    { nama_hobi: "Membaca", deskripsi: "Suka membaca buku-buku non-fiksi" },
                    { nama_hobi: "Fotografi", deskripsi: "Hobi mengambil foto landscape" },
                    { nama_hobi: "Traveling", deskripsi: "Suka berkeliling Indonesia" }
                ]
            },
            {
                id: 2,
                nama: "Jane Smith",
                alamat: "Jl. Sudirman No. 456, Bandung",
                telepon: "081234567891",
                email: "jane.smith@email.com",
                hobi: [
                    { nama_hobi: "Memasak", deskripsi: "Ahli memasak masakan Italia" },
                    { nama_hobi: "Yoga", deskripsi: "Praktisi yoga sejak 5 tahun" }
                ]
            },
            {
                id: 3,
                nama: "Ahmad Rahman",
                alamat: "Jl. Diponegoro No. 789, Surabaya",
                telepon: "081234567892",
                email: "ahmad.rahman@email.com",
                hobi: [
                    { nama_hobi: "Sepak Bola", deskripsi: "Pemain sepak bola amatir" },
                    { nama_hobi: "Musik", deskripsi: "Bermain gitar dan keyboard" },
                    { nama_hobi: "Gaming", deskripsi: "Suka bermain game strategy" }
                ]
            },
            {
                id: 4,
                nama: "Siti Nurhaliza",
                alamat: "Jl. Gatot Subroto No. 321, Yogyakarta",
                telepon: "081234567893",
                email: "siti.nurhaliza@email.com",
                hobi: [
                    { nama_hobi: "Menyanyi", deskripsi: "Hobi menyanyi lagu pop dan dangdut" },
                    { nama_hobi: "Menari", deskripsi: "Penari tradisional Jawa" }
                ]
            },
            {
                id: 5,
                nama: "Budi Santoso",
                alamat: "Jl. Pahlawan No. 654, Medan",
                telepon: "081234567894",
                email: "budi.santoso@email.com",
                hobi: [
                    { nama_hobi: "Berkebun", deskripsi: "Menanam sayuran organik" },
                    { nama_hobi: "Memancing", deskripsi: "Suka memancing di laut" },
                    { nama_hobi: "Traveling", deskripsi: "Hobi jalan-jalan ke tempat wisata" }
                ]
            },
            {
                id: 6,
                nama: "Lisa Wijaya",
                alamat: "Jl. Ahmad Yani No. 987, Malang",
                telepon: "081234567895",
                email: "lisa.wijaya@email.com",
                hobi: [
                    { nama_hobi: "Lukis", deskripsi: "Melukis dengan cat air" },
                    { nama_hobi: "Fotografi", deskripsi: "Spesialis foto portrait" },
                    { nama_hobi: "Membaca", deskripsi: "Membaca novel dan komik" }
                ]
            }
        ];

        let currentData = sampleData;

        function renderData(data) {
            const container = document.getElementById('dataContainer');
            
            if (data.length === 0) {
                container.innerHTML = `
                    <div class="no-data">
                        Tidak ada data yang ditemukan
                    </div>
                `;
                return;
            }

            const html = data.map(person => `
                <div class="person-card">
                    <div class="person-info">
                        <div class="person-name">${person.nama}</div>
                        <div class="person-details">
                            <div><strong>📧 Email:</strong> ${person.email}</div>
                            <div><strong>📞 Telepon:</strong> ${person.telepon}</div>
                            <div style="grid-column: 1 / -1;"><strong>📍 Alamat:</strong> ${person.alamat}</div>
                        </div>
                    </div>
                    <div class="hobi-section">
                        <div class="hobi-title">Hobi</div>
                        <div class="hobi-list">
                            ${person.hobi.map(hobi => `
                                <span class="hobi-item" title="${hobi.deskripsi}">${hobi.nama_hobi}</span>
                            `).join('')}
                        </div>
                    </div>
                </div>
            `).join('');

            container.innerHTML = html;
        }

        function searchData(nama, alamat, hobi) {
            const filtered = sampleData.filter(person => {
                const namaMatch = !nama || person.nama.toLowerCase().includes(nama.toLowerCase());
                const alamatMatch = !alamat || person.alamat.toLowerCase().includes(alamat.toLowerCase());
                const hobiMatch = !hobi || person.hobi.some(h => 
                    h.nama_hobi.toLowerCase().includes(hobi.toLowerCase()) ||
                    h.deskripsi.toLowerCase().includes(hobi.toLowerCase())
                );

                return namaMatch && alamatMatch && hobiMatch;
            });

            return filtered;
        }

        function showLoading() {
            document.getElementById('dataContainer').innerHTML = `
                <div class="loading">
                    Sedang mencari data...
                </div>
            `;
        }

        // Event listeners
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nama = document.getElementById('searchNama').value.trim();
            const alamat = document.getElementById('searchAlamat').value.trim();
            const hobi = document.getElementById('searchHobi').value.trim();

            showLoading();

            // Simulate loading delay for better UX
            setTimeout(() => {
                const filteredData = searchData(nama, alamat, hobi);
                renderData(filteredData);
            }, 500);
        });

        // Clear search and show all data when inputs are cleared
        document.querySelectorAll('#searchForm input').forEach(input => {
            input.addEventListener('input', function() {
                const allEmpty = Array.from(document.querySelectorAll('#searchForm input'))
                    .every(inp => inp.value.trim() === '');
                
                if (allEmpty) {
                    renderData(sampleData);
                }
            });
        });

        // Initial load
        renderData(sampleData);
    </script>
</body>
</html>