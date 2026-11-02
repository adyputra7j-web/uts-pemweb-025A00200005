<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

$searchKeyword = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
$selectedPlatform = isset($_GET['platform']) ? trim((string) $_GET['platform']) : 'Semua';
$selectedGenre = isset($_GET['genre']) ? trim((string) $_GET['genre']) : 'Semua';
$selectedStatus = isset($_GET['status']) ? trim((string) $_GET['status']) : 'Semua';
$selectedSort = isset($_GET['sort']) ? trim((string) $_GET['sort']) : 'tahun_terbaru';

$daftarPlatform = getUniquePlatforms($koleksiGame);
$daftarGenre = getUniqueGenres($koleksiGame);

$filteredGames = filterGames($koleksiGame, $searchKeyword, $selectedPlatform, $selectedGenre, $selectedStatus);

$displayGames = sortGames($filteredGames, $selectedSort);

$currentStats = getCollectionStats($displayGames);
$totalOriginal = count($koleksiGame);
$totalDisplayed = count($displayGames);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Katalog Koleksi Game PlayStation 2 dan 3 - Cari dan saring koleksi game klasik legendaris.">
    <title>Katalog Game PlayStation 2 & 3 (<?= $totalDisplayed; ?> Judul) - PlayVault</title>
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
                <a href="index.php" class="nav-link">Profil Kolektor</a>
                <a href="katalog.php" class="nav-link active">Katalog Game (<?= $totalOriginal; ?>)</a>
            </nav>
        </div>
    </header>

    <main class="site-main">
        <div class="container">

            <section class="catalog-header-section" aria-labelledby="heading-katalog">
                <h1 id="heading-katalog">Katalog Koleksi Game PlayStation 2 & 3</h1>
                <p style="color: var(--text-muted); margin-bottom: 2rem;">
                </p>
            </section>

            <section class="filter-section" aria-labelledby="heading-filter">
                <h2 id="heading-filter">Filter & Pencarian Koleksi</h2>
                
                <form action="katalog.php" method="GET" class="filter-form">
                    <div class="form-group">
                        <label for="input-search" class="form-label">Cari Judul / Pengembang</label>
                        <input 
                            type="text" 
                            id="input-search" 
                            name="q" 
                            class="form-input" 
                            placeholder="Misal: GTA, God of War, Capcom..." 
                            value="<?= e($searchKeyword); ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label for="select-platform" class="form-label">Platform Konsol</label>
                        <select id="select-platform" name="platform" class="form-select">
                            <option value="Semua">Semua Konsol</option>
                            <?php foreach ($daftarPlatform as $platform): ?>
                                <option value="<?= e($platform); ?>" <?= $selectedPlatform === $platform ? 'selected' : ''; ?>>
                                    <?= e($platform); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="select-genre" class="form-label">Genre</label>
                        <select id="select-genre" name="genre" class="form-select">
                            <option value="Semua">Semua Genre</option>
                            <?php foreach ($daftarGenre as $genre): ?>
                                <option value="<?= e($genre); ?>" <?= $selectedGenre === $genre ? 'selected' : ''; ?>>
                                    <?= e($genre); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="select-status" class="form-label">Status Bermain</label>
                        <select id="select-status" name="status" class="form-select">
                            <option value="Semua" <?= $selectedStatus === 'Semua' ? 'selected' : ''; ?>>Semua Status</option>
                            <option value="Tamat" <?= $selectedStatus === 'Tamat' ? 'selected' : ''; ?>>Tamat</option>
                            <option value="Sedang Dimainkan" <?= $selectedStatus === 'Sedang Dimainkan' ? 'selected' : ''; ?>>Sedang Dimainkan</option>
                            <option value="Backlog" <?= $selectedStatus === 'Backlog' ? 'selected' : ''; ?>>Backlog</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="select-sort" class="form-label">Urutkan</label>
                        <select id="select-sort" name="sort" class="form-select">
                            <option value="tahun_terbaru" <?= $selectedSort === 'tahun_terbaru' ? 'selected' : ''; ?>>Tahun Rilis Terbaru</option>
                            <option value="tahun_terlama" <?= $selectedSort === 'tahun_terlama' ? 'selected' : ''; ?>>Tahun Rilis Terlama</option>
                            <option value="rating_tinggi" <?= $selectedSort === 'rating_tinggi' ? 'selected' : ''; ?>>Rating Tertinggi</option>
                            <option value="rating_rendah" <?= $selectedSort === 'rating_rendah' ? 'selected' : ''; ?>>Rating Terendah</option>
                            <option value="jam_terbanyak" <?= $selectedSort === 'jam_terbanyak' ? 'selected' : ''; ?>>Jam Bermain Terbanyak</option>
                            <option value="judul_az" <?= $selectedSort === 'judul_az' ? 'selected' : ''; ?>>Judul (A - Z)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary">Terapkan</button>
                    </div>

                    <?php if ($searchKeyword !== '' || $selectedPlatform !== 'Semua' || $selectedGenre !== 'Semua' || $selectedStatus !== 'Semua' || $selectedSort !== 'tahun_terbaru'): ?>
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <a href="katalog.php" class="btn btn-secondary">Reset</a>
                    </div>
                    <?php endif; ?>
                </form>
            </section>

            <section class="results-summary-section" aria-label="Ringkasan Hasil">
                <div class="results-toolbar">
                    <div class="results-count">
                        Menampilkan <strong><?= $totalDisplayed; ?></strong> dari total <strong><?= $totalOriginal; ?></strong> game
                        <?php if ($totalDisplayed > 0): ?>
                            &bull; <strong><?= $currentStats['total_ps2']; ?> PS2</strong> | <strong><?= $currentStats['total_ps3']; ?> PS3</strong>
                            &bull; Total Durasi: <strong><?= number_format($currentStats['total_jam']); ?> Jam</strong>
                            &bull; Rata-rata Skor: <strong><?= number_format($currentStats['rata_rata_rating'], 1); ?>/10</strong>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <section class="games-list-section" aria-labelledby="heading-daftar-game">
                <h2 id="heading-daftar-game" class="sr-only" style="display: none;">Daftar Item Game</h2>

                <?php if ($totalDisplayed === 0): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon" aria-hidden="true">🔍</div>
                        <h3>Tidak Ada Game yang Cocok</h3>
                        <p>Tidak ditemukan game dengan kata kunci "<?= e($searchKeyword); ?>" atau kombinasi filter yang Anda pilih.</p>
                        <a href="katalog.php" class="btn btn-primary">Reset Filter Pencarian</a>
                    </div>
                <?php else: ?>
                    <div class="games-grid">
                        <?php foreach ($displayGames as $game): ?>
                            <article class="game-card">
                                <div class="game-cover-container">
                                    <img 
                                        src="<?= e($game['gambar']); ?>" 
                                        alt="Sampul Game <?= e($game['judul']); ?>" 
                                        class="game-cover"
                                        loading="lazy"
                                        width="400"
                                        height="240"
                                    >
                                    <div class="game-badge-overlay">
                                        <?= getStatusBadge((string) $game['status']); ?>
                                    </div>
                                </div>

                                <div class="game-card-body">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
                                        <span class="game-genre-tag"><?= e($game['genre']); ?></span>
                                        <?= getPlatformBadge((string) $game['platform']); ?>
                                    </div>
                                    
                                    <h3 class="game-title"><?= e($game['judul']); ?></h3>
                                    
                                    <div class="game-developer">
                                        Oleh <?= e($game['pengembang']); ?> &bull; Rilis <?= e((string) $game['tahun']); ?>
                                    </div>

                                    <div class="game-rating-row">
                                        <?= formatRatingStars((float) $game['rating']); ?>
                                    </div>

                                    <p class="game-description">
                                        <?= e($game['deskripsi']); ?>
                                    </p>

                                    <div class="game-meta-footer">
                                        <div class="meta-info-item">
                                            <span>💿 Konsol:</span>
                                            <strong><?= e($game['platform']); ?></strong>
                                        </div>
                                        <div class="meta-info-item">
                                            <span>⏱️ Main:</span>
                                            <strong><?= e((string) $game['jam_bermain']); ?> Jam</strong>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>

        </div>
    </main>

    <!-- Footer Semantik -->
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
