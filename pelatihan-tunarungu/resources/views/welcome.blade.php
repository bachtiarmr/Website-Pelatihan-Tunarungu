<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Training Tunarungu</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8faff;
            color: #202b46;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 8%;
            background: white;
            box-shadow: 0 3px 18px #202b4610;
        }

        .logo {
            font-size: 21px;
            font-weight: 800;
            color: #4169e1;
        }

        .logo span {
            color: #ffad60;
        }

        nav a {
            text-decoration: none;
            color: #35415e;
            margin-left: 25px;
            font-size: 14px;
            font-weight: 500;
        }

        .btn {
            display: inline-block;
            background: #4169e1;
            color: white;
            text-decoration: none;
            padding: 13px 24px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
            padding: 90px 8%;
            min-height: 540px;
        }

        .hero-content {
            max-width: 590px;
        }

        .tag {
            display: inline-block;
            padding: 9px 15px;
            background: #e8edff;
            color: #4169e1;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        h1 {
            font-size: clamp(34px, 4vw, 52px);
            line-height: 1.25;
            margin-bottom: 22px;
        }

        h1 span {
            color: #4169e1;
        }

        .hero p {
            color: #68738b;
            font-size: 15px;
            line-height: 1.9;
            margin-bottom: 30px;
        }

        .hero-visual {
            width: 390px;
            min-height: 330px;
            flex-shrink: 0;
            border-radius: 35px;
            background: linear-gradient(135deg, #dfe7ff, #ffe7d2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 30px;
        }

        .hero-visual .emoji {
            font-size: 100px;
            margin-bottom: 20px;
        }

        .hero-visual h3 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .hero-visual p {
            font-size: 13px;
            margin: 0;
        }

        .features {
            padding: 65px 8%;
            background: white;
            text-align: center;
        }

        .features h2 {
            font-size: 30px;
            margin-bottom: 12px;
        }

        .section-desc {
            color: #68738b;
            margin-bottom: 40px;
            font-size: 14px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            text-align: left;
        }

        .feature-card {
            padding: 28px;
            border: 1px solid #edf0f7;
            border-radius: 18px;
            background: #fff;
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            background: #edf1ff;
            border-radius: 14px;
            font-size: 25px;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 17px;
            margin-bottom: 10px;
        }

        .feature-card p {
            color: #68738b;
            font-size: 13px;
            line-height: 1.8;
        }

        .cta {
            margin: 65px 8%;
            padding: 50px 25px;
            border-radius: 25px;
            text-align: center;
            background: #4169e1;
            color: white;
        }

        .cta h2 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .cta p {
            font-size: 14px;
            margin-bottom: 25px;
            color: #edf1ff;
        }

        .cta .btn {
            background: white;
            color: #4169e1;
        }

        footer {
            padding: 25px;
            text-align: center;
            color: #68738b;
            font-size: 12px;
            background: white;
        }

        @media (max-width: 800px) {
            nav {
                padding: 18px 5%;
            }

            nav a {
                margin-left: 10px;
                font-size: 12px;
            }

            .hero {
                flex-direction: column;
                padding: 60px 6%;
                align-items: stretch;
            }

            .hero-visual {
                width: 100%;
                min-height: 260px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .features {
                padding: 50px 6%;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo">E-Training<span>.</span></div>

        <div>
            <a href="#beranda">Beranda</a>
            <a href="#fitur">Fitur</a>
            <a href="#tentang">Tentang</a>
            <a href="{{ url('/register') }}" class="btn">Daftar</a>
        </div>
    </nav>

    <section class="hero" id="beranda">
        <div class="hero-content">
            <div class="tag">Belajar Tanpa Batas</div>

            <h1>
                Tingkatkan Skill,<br>
                Raih Masa Depan <span>Hebat!</span>
            </h1>

            <p>
                Platform pelatihan digital yang dirancang untuk mendukung
                penyandang disabilitas tunarungu melalui pembelajaran visual,
                materi interaktif, dan video dengan subtitle.
            </p>

            <a href="{{ url('/register') }}" class="btn">
                Mulai Belajar Sekarang →
            </a>
        </div>

        <div class="hero-visual">
            <div class="emoji" aria-hidden="true">🤟</div>
            <h3>Belajar dengan Cara yang Nyaman</h3>
            <p>Materi visual, video bersubtitle, dan evaluasi pembelajaran.</p>
        </div>
    </section>

    <section class="features" id="fitur">
        <h2>Fitur Pembelajaran</h2>
        <p class="section-desc">
            Semua yang kamu butuhkan untuk mengembangkan kompetensi.
        </p>

        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon" aria-hidden="true">📚</div>
                <h3>Materi Interaktif</h3>
                <p>
                    Pelajari materi melalui teks, gambar, dan konten visual
                    yang mudah dipahami.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon" aria-hidden="true">🎬</div>
                <h3>Video Bersubtitle</h3>
                <p>
                    Ikuti video pembelajaran dengan subtitle agar informasi
                    dapat diakses dengan nyaman.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon" aria-hidden="true">📈</div>
                <h3>Progres Belajar</h3>
                <p>
                    Pantau perkembangan belajar, hasil kuis, riwayat pelatihan,
                    dan kompetensi yang diperoleh.
                </p>
            </div>
        </div>
    </section>

    <section class="cta" id="tentang">
        <h2>Siap Mengembangkan Potensimu?</h2>
        <p>Mulai perjalanan belajar dan tingkatkan kompetensimu hari ini.</p>
        <a href="{{ url('/register') }}" class="btn">Gabung Sekarang</a>
    </section>

    <footer>
        © {{ date('Y') }} E-Training Tunarungu. Belajar inklusif untuk semua.
    </footer>

</body>
</html>
