<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';


$stats = getCollectionStats($koleksiGame);

$featuredGame = $stats['game_tertinggi'] ?? $koleksiGame[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Profil Kolektor Game PlayStation 2 & 3 - Proyek Mini UTS Pemrograman Web">
    <title><?= e($profilKolektor['nama']); ?> - Koleksi Game PlayStation 2 & 3</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="site-header">
        <div class="container header-container">
            <a href="index.php" class="brand-wrapper">
                <div class="brand-icon" aria-hidden="true">🎮</div>
                <div class="brand-text">PlayVault PS2/PS3</div>
            </a>
            <nav class="site-nav" aria-label="Navigasi Utama">
                <a href="index.php" class="nav-link active">Profil Kolektor</a>
                <a href="katalog.php" class="nav-link">Katalog Game (<?= count($koleksiGame); ?>)</a>
            </nav>
        </div>
    </header>

    <main class="site-main">
        <div class="container">

            <section class="profile-section" aria-labelledby="heading-profil">
                <h1 id="heading-profil">Profil Kolektor PlayStation 2 & 3</h1>
                
                <article class="profile-card">
                    <div class="profile-avatar-wrapper">
                        <img 
                            src="<?= e($profilKolektor['avatar']); ?>" 
                            alt="Foto Avatar <?= e($profilKolektor['nama']); ?>" 
                            class="profile-avatar"
                            width="140"
                            height="140"
                        >
                    </div>

                    <div class="profile-info">
                        <h2><?= e($profilKolektor['nama']); ?></h2>
                        <div class="profile-meta-tags">
                            <span class="meta-pill"><?= e($profilKolektor['nim']); ?></span>
                            <span class="meta-pill"><?= e($profilKolektor['kelas']); ?></span>
                            <span class="meta-pill"><?= e($profilKolektor['level_kolektor']); ?></span>
                        </div>

                        <p class="profile-bio"><?= e($profilKolektor['bio']); ?></p>

                        <div class="profile-details-grid">
                            <div class="detail-item">
                                <div class="detail-label">Institusi Kampus</div>
                                <div class="detail-value"><?= e($profilKolektor['universitas']); ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Fokus Koleksi</div>
                                <div class="detail-value"><?= e(implode(' & ', $profilKolektor['platform_favorit'])); ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Tahun Mulai Mengoleksi</div>
                                <div class="detail-value">Sejak <?= e((string) $profilKolektor['tahun_mulai']); ?></div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>

            <section class="stats-section" aria-labelledby="heading-stats">
                <h2 id="heading-stats">Ringkasan Statistik Koleksi Konsol</h2>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" aria-hidden="true">💿</div>
                        <div class="stat-content">
                            <span class="stat-number"><?= $stats['total_game']; ?> Judul</span>
                            <span class="stat-label"><?= $stats['total_ps2']; ?> PS2 &bull; <?= $stats['total_ps3']; ?> PS3</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" aria-hidden="true">⏱️</div>
                        <div class="stat-content">
                            <span class="stat-number"><?= number_format($stats['total_jam']); ?> Jam</span>
                            <span class="stat-label">Total Waktu Bermain</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" aria-hidden="true">⭐</div>
                        <div class="stat-content">
                            <span class="stat-number"><?= number_format($stats['rata_rata_rating'], 1); ?> / 10</span>
                            <span class="stat-label">Rata-rata Rating Koleksi</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" aria-hidden="true">🏆</div>
                        <div class="stat-content">
                            <span class="stat-number"><?= $stats['persentase_tamat']; ?>%</span>
                            <span class="stat-label">Game Tamat (<?= $stats['total_tamat']; ?>/<?= $stats['total_game']; ?>)</span>
                        </div>
                    </div>
                </div>
            </section>

            <?php if ($featuredGame !== null): ?>
            <section class="spotlight-section" aria-labelledby="heading-spotlight">
                <h2 id="heading-spotlight">Game Sorotan / Rating Tertinggi</h2>

                <article class="spotlight-card">
                    <img 
                        src="<?= e($featuredGame['gambar']); ?>" 
                        alt="Sampul Game <?= e($featuredGame['judul']); ?>" 
                        class="spotlight-cover"
                        width="400"
                        height="240"
                    >

                    <div class="spotlight-content">
                        <div class="game-badge-row" style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center;">
                            <?= getPlatformBadge($featuredGame['platform']); ?>
                            <?= getStatusBadge($featuredGame['status']); ?>
                            <span class="meta-pill"><?= e($featuredGame['genre']); ?></span>
                        </div>

                        <h3><?= e($featuredGame['judul']); ?></h3>
                        
                        <p class="game-developer">Pengembang: <?= e($featuredGame['pengembang']); ?> &bull; Rilis: <?= e((string) $featuredGame['tahun']); ?></p>
                        
                        <div class="game-rating-row">
                            <?= formatRatingStars((float) $featuredGame['rating']); ?>
                        </div>

                        <p class="game-description"><?= e($featuredGame['deskripsi']); ?></p>

                        <div class="spotlight-meta">
                            <span>Waktu Bermain Kolektor: <strong><?= e((string) $featuredGame['jam_bermain']); ?> Jam</strong></span>
                        </div>
                    </div>
                </article>
            </section>
            <?php endif; ?>

            <section class="cta-banner" aria-labelledby="heading-cta">
                <h2 id="heading-cta">Telusuri Seluruh 12 Game Legendaris</h2>
                <p>Filter berdasarkan konsol PlayStation 2 atau PlayStation 3, cari judul game favorit masa kecil Anda, dan urutkan berdasarkan rating atau tahun rilis.</p>
                <a href="katalog.php" class="btn btn-cta">Buka Katalog Koleksi PS2 & PS3 &rarr;</a>
            </section>

        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-content">
            <div class="footer-credits">
                <strong>PlayVault</strong> &copy; <?= date('Y'); ?> &bull; Proyek Mini UTS Pemrograman Web
                <br>
                <span>Koleksi oleh: <strong><?= e($profilKolektor['nama']); ?></strong> (NIM: <?= e($profilKolektor['nim']); ?>)</span>
            </div>
            <div class="footer-links">
                <a href="index.php" class="footer-link">Profil</a>
                <a href="katalog.php" class="footer-link">Katalog Game</a>
            </div>
        </div>
    </footer>

</body>
</html>
