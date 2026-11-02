<?php

declare(strict_types=1);

/**
 * @param string $value
 * @return string
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * @param string $status
 * @return string
 */
function getStatusBadge(string $status): string
{
    $cleanStatus = trim($status);

    $badgeClass = match ($cleanStatus) {
        'Tamat' => 'badge-status badge-tamat',
        'Sedang Dimainkan' => 'badge-status badge-dimainkan',
        'Backlog' => 'badge-status badge-backlog',
        default => 'badge-status badge-default',
    };

    return sprintf(
        '<span class="%s">%s</span>',
        e($badgeClass),
        e($cleanStatus)
    );
}

/**
 * @param string $platform
 * @return string
 */
function getPlatformBadge(string $platform): string
{
    $cleanPlatform = trim($platform);

    $badgeClass = match ($cleanPlatform) {
        'PlayStation 2' => 'badge-platform badge-ps2',
        'PlayStation 3' => 'badge-platform badge-ps3',
        default => 'badge-platform badge-ps-default',
    };

    return sprintf(
        '<span class="%s">%s</span>',
        e($badgeClass),
        e($cleanPlatform)
    );
}

/**
 * @param float $rating
 * @return string
 */
function formatRatingStars(float $rating): string
{
    $starsCount = (int) round($rating / 2);
    $starsCount = max(1, min(5, $starsCount));
    $filledStars = str_repeat('★', $starsCount);
    $emptyStars = str_repeat('☆', 5 - $starsCount);

    return sprintf(
        '<div class="rating-display" title="Skor: %.1f / 10">' .
        '<span class="rating-stars" aria-hidden="true">%s%s</span>' .
        '<span class="rating-score">%.1f<small>/10</small></span>' .
        '</div>',
        $rating,
        $filledStars,
        $emptyStars,
        $rating
    );
}

/**
 * @param array<int, array<string, mixed>> $games
 * @return array<string, mixed>
 */
function getCollectionStats(array $games): array
{
    $totalGames = count($games);

    if ($totalGames === 0) {
        return [
            'total_game' => 0,
            'total_jam' => 0,
            'rata_rata_rating' => 0.0,
            'persentase_tamat' => 0.0,
            'game_tertinggi' => null,
            'game_terlama' => null,
            'total_tamat' => 0,
            'total_dimainkan' => 0,
            'total_backlog' => 0,
            'total_ps2' => 0,
            'total_ps3' => 0,
        ];
    }

    $daftarJam = array_column($games, 'jam_bermain');
    $daftarRating = array_column($games, 'rating');

    $totalJam = (int) array_sum($daftarJam);
    $totalRating = (float) array_sum($daftarRating);
    $rataRataRating = round($totalRating / $totalGames, 1);

    $gameTamat = array_filter(
        $games,
        static fn(array $item): bool => $item['status'] === 'Tamat'
    );
    $gameDimainkan = array_filter(
        $games,
        static fn(array $item): bool => $item['status'] === 'Sedang Dimainkan'
    );
    $gameBacklog = array_filter(
        $games,
        static fn(array $item): bool => $item['status'] === 'Backlog'
    );

    $gamePs2 = array_filter(
        $games,
        static fn(array $item): bool => $item['platform'] === 'PlayStation 2'
    );
    $gamePs3 = array_filter(
        $games,
        static fn(array $item): bool => $item['platform'] === 'PlayStation 3'
    );

    $totalTamat = count($gameTamat);
    $persentaseTamat = round(($totalTamat / $totalGames) * 100, 1);

    $gameTertinggi = $games[0];
    $gameTerlama = $games[0];

    foreach ($games as $game) {
        if ($game['rating'] > $gameTertinggi['rating']) {
            $gameTertinggi = $game;
        }
        if ($game['jam_bermain'] > $gameTerlama['jam_bermain']) {
            $gameTerlama = $game;
        }
    }

    return [
        'total_game' => $totalGames,
        'total_jam' => $totalJam,
        'rata_rata_rating' => $rataRataRating,
        'persentase_tamat' => $persentaseTamat,
        'game_tertinggi' => $gameTertinggi,
        'game_terlama' => $gameTerlama,
        'total_tamat' => $totalTamat,
        'total_dimainkan' => count($gameDimainkan),
        'total_backlog' => count($gameBacklog),
        'total_ps2' => count($gamePs2),
        'total_ps3' => count($gamePs3),
    ];
}

/**
 * @param array<int, array<string, mixed>> $games
 * @param string $keyword
 * @param string $platform
 * @param string $genre
 * @param string $status
 * @return array<int, array<string, mixed>>
 */
function filterGames(
    array $games,
    string $keyword = '',
    string $platform = '',
    string $genre = '',
    string $status = ''
): array {
    $filtered = array_filter($games, static function (array $game) use ($keyword, $platform, $genre, $status): bool {
        $matchKeyword = true;
        if ($keyword !== '') {
            $term = mb_strtolower(trim($keyword));
            $judul = mb_strtolower((string) $game['judul']);
            $pengembang = mb_strtolower((string) $game['pengembang']);
            $matchKeyword = (str_contains($judul, $term) || str_contains($pengembang, $term));
        }

        $matchPlatform = true;
        if ($platform !== '' && $platform !== 'Semua') {
            $matchPlatform = ($game['platform'] === $platform);
        }

        $matchGenre = true;
        if ($genre !== '' && $genre !== 'Semua') {
            $matchGenre = ($game['genre'] === $genre);
        }

        $matchStatus = true;
        if ($status !== '' && $status !== 'Semua') {
            $matchStatus = ($game['status'] === $status);
        }

        return $matchKeyword && $matchPlatform && $matchGenre && $matchStatus;
    });

    return array_values($filtered);
}

/**
 * @param array<int, array<string, mixed>> $games
 * @param string $sortBy
 * @return array<int, array<string, mixed>>
 */
function sortGames(array $games, string $sortBy = 'tahun_terbaru'): array
{
    $sorted = $games;

    usort($sorted, static function (array $a, array $b) use ($sortBy): int {
        return match ($sortBy) {
            'rating_tinggi' => $b['rating'] <=> $a['rating'],
            'rating_rendah' => $a['rating'] <=> $b['rating'],
            'tahun_terlama' => $a['tahun'] <=> $b['tahun'],
            'jam_terbanyak' => $b['jam_bermain'] <=> $a['jam_bermain'],
            'judul_az' => strcasecmp((string) $a['judul'], (string) $b['judul']),
            default => $b['tahun'] <=> $a['tahun'], // Default: tahun_terbaru
        };
    });

    return $sorted;
}

/**
 * @param array<int, array<string, mixed>> $games
 * @return array<int, string>
 */
function getUniqueGenres(array $games): array
{
    $genres = array_unique(array_column($games, 'genre'));
    sort($genres);
    return $genres;
}

/**
 * @param array<int, array<string, mixed>> $games
 * @return array<int, string>
 */
function getUniquePlatforms(array $games): array
{
    $platforms = array_unique(array_column($games, 'platform'));
    sort($platforms);
    return $platforms;
}
