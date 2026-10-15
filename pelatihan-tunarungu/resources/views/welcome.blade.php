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
            background: #f3f5f9;
            color: #1c2940;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 8%;
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 1px 0 rgba(35, 52, 88, 0.08);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .logo {
            font-size: 30px;
            font-weight: 800;
            color: #3d7af0;
            line-height: 1;
        }

        .logo span {
            color: #f5ad50;
        }

        nav .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        nav a {
            text-decoration: none;
            color: #2d3d5a;
            font-size: 15px;
            font-weight: 500;
            transition: opacity 0.2s ease;
        }

        nav a:hover {
            opacity: 0.8;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3f73ea, #4367d6);
            color: white;
            text-decoration: none;
            padding: 16px 26px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(63, 115, 234, 0.22);
        }

        
        .hero {
    position: relative;
    isolation: isolate;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 70px;

    padding: 90px 8% 70px;
    min-height: 620px;

    background:
        linear-gradient(
            rgba(243, 245, 249, 0.78),
            rgba(243, 245, 249, 0.78)
        ),
        url("{{ asset('image/background.jpg') }}");

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
        }


        .hero-content {
            max-width: 620px;
        }

        .tag {
            display: inline-block;
            padding: 9px 18px;
            background: rgba(116, 143, 234, 0.13);
            color: #2d6ae0;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        h1 {
            font-size: clamp(48px, 5vw, 74px);
            line-height: 0.98;
            margin-bottom: 28px;
            letter-spacing: -0.06em;
        }

        h1 span {
            display: block;
            color: #3d7af0;
            margin-top: 10px;
        }

        .hero p {
            color: #68738b;
            font-size: 17px;
            line-height: 1.8;
            margin-bottom: 36px;
            max-width: 560px;
        }

        .hero-visual {
            width: 430px;
            min-height: 340px;
            flex-shrink: 0;
            border-radius: 32px;
            background: linear-gradient(135deg, rgba(217, 228, 255, 0.7), rgba(248, 227, 208, 0.75));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 28px 28px 20px;
            box-shadow: inset 0 0 0 1px rgba(138, 152, 184, 0.12);
        }

        .hero-visual .emoji {
            font-size: 110px;
            margin-bottom: 10px;
            filter: drop-shadow(0 10px 18px rgba(61, 122, 240, 0.08));
        }

        .hero-visual h3 {
            font-size: 23px;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .hero-visual p {
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
            color: #556179;
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

        <div class="nav-links">
            <a href="#beranda">Beranda</a>
            <a href="#fitur">Fitur</a>
            <a href="#tentang">Tentang</a>
            <a href="{{ route('register') }}" class="btn">Daftar</a>
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

            <a href="{{ route('login') }}" class="btn">
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
        <a href="{{ route('register') }}" class="btn">Gabung Sekarang</a>
    </section>

    <footer>
        © {{ date('Y') }} E-Training Tunarungu. Belajar inklusif untuk semua.
    </footer>

</body>
</html>