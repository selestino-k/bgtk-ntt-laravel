<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BeritaSeeder extends Seeder
{
    /**
     * Parse berita-norm.csv and seed beritas, tag, and berita_tag tables.
     */
    public function run(): void
    {
        $csvFile = database_path('berita-norm.csv');

        if (! file_exists($csvFile)) {
            $this->command->error('berita-norm.csv not found in database/ folder.');
            return;
        }

        $rows    = $this->parseCsv($csvFile);
        $userMap = User::pluck('id', 'username')->map(fn ($id) => $id)->all();
        $tagMap  = [];
        $count   = 0;

        DB::transaction(function () use ($rows, $userMap, &$tagMap, &$count) {
            foreach ($rows as $row) {
                // Skip unpublished rows
                if (strtoupper(trim($row['published'] ?? '')) !== 'Y') {
                    continue;
                }

                // Skip if slug already exists
                if (Berita::where('slug', $row['slug'])->exists()) {
                    continue;
                }

                // Resolve author by username (case-insensitive fallback)
                $authorId = $userMap[$row['username']] ?? null;
                if ($authorId === null) {
                    // try case-insensitive match
                    foreach ($userMap as $uname => $id) {
                        if (strcasecmp($uname, $row['username']) === 0) {
                            $authorId = $id;
                            break;
                        }
                    }
                }

                // Parse timestamp from tanggal (DD/MM/YYYY) + jam
                try {
                    $createdAt = Carbon::createFromFormat('d/m/Y H:i:s', $row['tanggal'] . ' ' . $row['jam']);
                } catch (\Exception) {
                    $createdAt = now();
                }

                // Insert berita
                $berita = Berita::create([
                    'judul'       => $row['judul'],
                    'slug'        => $row['slug'],
                    'isi'         => $row['isi'],
                    'gambar'      => $row['gambar'] ?: null,
                    'dokumen_url' => null,
                    'author_id'   => $authorId,
                    'published'   => true,
                    'created_at'  => $createdAt,
                    'updated_at'  => $createdAt,
                ]);

                // Parse and attach tags
                $rawTags = array_filter(
                    array_map('trim', explode(',', $row['tag'] ?? ''))
                );

                $tagIds = [];
                foreach ($rawTags as $tagline) {
                    if ($tagline === '') {
                        continue;
                    }
                    if (! isset($tagMap[$tagline])) {
                        $tag             = Tag::firstOrCreate(['tagline' => $tagline]);
                        $tagMap[$tagline] = $tag->id;
                    }
                    $tagIds[] = $tagMap[$tagline];
                }

                if ($tagIds) {
                    $berita->tags()->syncWithoutDetaching($tagIds);
                }

                $count++;
            }
        });

        $this->command->info("BeritaSeeder: inserted {$count} berita records.");
    }

    /**
     * Parse a semicolon-delimited CSV with quoted multi-line fields.
     * Handles doubled internal quotes ("") as per RFC 4180 style.
     *
     * @return array<int, array<string, string>>
     */
    private function parseCsv(string $filePath): array
    {
        $handle = fopen($filePath, 'r');
        if ($handle === false) {
            return [];
        }

        // Read header row
        $headers = fgetcsv($handle, 0, ';', '"', '\\');
        if ($headers === false) {
            fclose($handle);
            return [];
        }
        $headers = array_map('trim', $headers);

        $rows = [];
        while (($values = fgetcsv($handle, 0, ';', '"', '\\')) !== false) {
            if (count($values) !== count($headers)) {
                continue; // skip malformed rows
            }
            $rows[] = array_combine($headers, $values);
        }

        fclose($handle);
        return $rows;
    }
}
