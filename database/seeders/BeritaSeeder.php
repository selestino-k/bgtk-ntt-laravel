<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Parse the raw SQL dump and seed beritas, tag, and berita_tag tables.
     */
    public function run(): void
    {
        $sqlFile = database_path('berita (1).sql');

        if (! file_exists($sqlFile)) {
            $this->command->error('berita (1).sql not found in database/ folder.');
            return;
        }

        $rows    = $this->parseInserts($sqlFile);
        $userMap = User::pluck('id', 'username')->all();  // ['admin' => 1, ...]
        $tagMap  = [];   // ['pendidikan' => Tag model id]
        $slugs   = [];   // track used slugs for deduplication

        DB::transaction(function () use ($rows, $userMap, &$tagMap, &$slugs) {
            foreach ($rows as $row) {
                // Only migrate published (status = 'Y') rows
                if (($row['status'] ?? '') !== 'Y') {
                    continue;
                }

                // --- Resolve author ---
                $authorId = $userMap[$row['username']] ?? null;

                // --- Resolve slug (deduplicate) ---
                $baseSlug = Str::slug($row['judul_seo'], '-');
                $slug     = $baseSlug;
                if (in_array($slug, $slugs, true)) {
                    $slug = $baseSlug . '-' . $row['id_berita'];
                }
                $slugs[] = $slug;

                // --- Parse timestamps ---
                $createdAt = Carbon::parse($row['tanggal'] . ' ' . $row['jam']);

                // --- Insert berita ---
                $berita = Berita::create([
                    'judul'      => $row['judul'],
                    'slug'       => $slug,
                    'isi'        => $row['isi_berita'],
                    'gambar'     => $row['gambar'] ?: null,
                    'dokumen'    => null,
                    'author_id'  => $authorId,
                    'published'  => true,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);

                // --- Parse tags (CSV field) ---
                $rawTags = array_filter(
                    array_map('trim', explode(',', $row['tag'] ?? ''))
                );

                $tagIds = [];
                foreach ($rawTags as $tagline) {
                    if (! isset($tagMap[$tagline])) {
                        $tag             = Tag::firstOrCreate(['tagline' => $tagline]);
                        $tagMap[$tagline] = $tag->id;
                    }
                    $tagIds[] = $tagMap[$tagline];
                }

                if ($tagIds) {
                    $berita->tags()->syncWithoutDetaching($tagIds);
                }
            }
        });

        $this->command->info('BeritaSeeder: inserted ' . count($slugs) . ' berita records.');
    }

    /**
     * Extract all row-data arrays from the INSERT statements in the SQL file.
     *
     * Uses a stateful character-by-character parser so that semicolons and
     * other special characters inside quoted strings (e.g. HTML with inline
     * CSS like `style="height:576px; width:1024px"`) are never mistaken for
     * statement terminators.
     *
     * @return array<int, array<string, string>>
     */
    private function parseInserts(string $filePath): array
    {
        $columns = [
            'id_berita', 'id_kategori', 'username', 'judul', 'sub_judul',
            'youtube', 'judul_seo', 'headline', 'aktif', 'utama',
            'isi_berita', 'keterangan_gambar', 'hari', 'tanggal', 'jam',
            'gambar', 'dibaca', 'tag', 'status',
        ];

        $content = file_get_contents($filePath);
        $rows    = [];
        $len     = strlen($content);
        $needle  = "INSERT INTO `berita`";
        $pos     = 0;

        while (($pos = strpos($content, $needle, $pos)) !== false) {
            // Locate the VALUES keyword for this INSERT statement
            $valuesPos = stripos($content, 'VALUES', $pos);
            if ($valuesPos === false) {
                break;
            }

            $i = $valuesPos + 6; // skip past "VALUES"

            // Skip whitespace / newlines between VALUES and first '('
            while ($i < $len && ctype_space($content[$i])) {
                $i++;
            }

            // Statefully read the entire VALUES block until we reach a ';'
            // that sits outside of any quoted string or parenthesis group.
            $valuesBlock = '';
            $depth       = 0;
            $inStr       = false;
            $escape      = false;

            while ($i < $len) {
                $ch = $content[$i];

                if ($escape) {
                    $valuesBlock .= $ch;
                    $escape       = false;
                    $i++;
                    continue;
                }

                if ($ch === '\\' && $inStr) {
                    $valuesBlock .= $ch;
                    $escape       = true;
                    $i++;
                    continue;
                }

                if ($ch === "'") {
                    $inStr       = !$inStr;
                    $valuesBlock .= $ch;
                    $i++;
                    continue;
                }

                if (!$inStr) {
                    if ($ch === '(') {
                        $depth++;
                    } elseif ($ch === ')') {
                        $depth--;
                    } elseif ($ch === ';' && $depth === 0) {
                        $i++; // consume the ';'
                        break;
                    }
                }

                $valuesBlock .= $ch;
                $i++;
            }

            // Advance the outer search position past this statement
            $pos = $i;

            $tuples = $this->splitTuples($valuesBlock);
            foreach ($tuples as $tuple) {
                $values = $this->parseTuple($tuple);
                if (count($values) === count($columns)) {
                    $rows[] = array_combine($columns, $values);
                }
            }
        }

        return $rows;
    }

    /**
     * Split a VALUES block into individual "(…)" tuple strings,
     * correctly handling quoted strings with escaped characters.
     *
     * @return string[]
     */
    private function splitTuples(string $block): array
    {
        $tuples = [];
        $depth  = 0;
        $inStr  = false;
        $escape = false;
        $buf    = '';

        for ($i = 0, $len = strlen($block); $i < $len; $i++) {
            $ch = $block[$i];

            if ($escape) {
                $buf   .= $ch;
                $escape = false;
                continue;
            }

            if ($ch === '\\' && $inStr) {
                $buf   .= $ch;
                $escape = true;
                continue;
            }

            if ($ch === "'" && ! $escape) {
                $inStr = ! $inStr;
                $buf  .= $ch;
                continue;
            }

            if (! $inStr) {
                if ($ch === '(') {
                    $depth++;
                    if ($depth === 1) {
                        $buf = '(';
                        continue;
                    }
                } elseif ($ch === ')') {
                    $depth--;
                    if ($depth === 0) {
                        $buf    .= ')';
                        $tuples[] = $buf;
                        $buf    = '';
                        continue;
                    }
                }
            }

            $buf .= $ch;
        }

        return $tuples;
    }

    /**
     * Parse a "(val1, val2, ...)" tuple string into an ordered array of values.
     * Handles SQL-quoted strings (single-quoted, with \' and '' escapes) and NULL.
     *
     * @return string[]
     */
    private function parseTuple(string $tuple): array
    {
        // Strip surrounding parentheses
        $inner  = substr($tuple, 1, -1);
        $values = [];
        $i      = 0;
        $len    = strlen($inner);

        while ($i < $len) {
            // Skip leading whitespace / commas
            while ($i < $len && ($inner[$i] === ',' || $inner[$i] === ' ')) {
                $i++;
            }
            if ($i >= $len) {
                break;
            }

            if ($inner[$i] === "'") {
                // Quoted string value
                $i++;   // skip opening quote
                $val = '';
                while ($i < $len) {
                    $ch = $inner[$i];

                    if ($ch === '\\' && $i + 1 < $len) {
                        // Handle standard SQL escape sequences
                        $next = $inner[$i + 1];
                        $val .= match ($next) {
                            'n'  => "\n",
                            'r'  => "\r",
                            't'  => "\t",
                            "'"  => "'",
                            '\\' => '\\',
                            default => '\\' . $next,
                        };
                        $i += 2;
                        continue;
                    }

                    if ($ch === "'") {
                        if ($i + 1 < $len && $inner[$i + 1] === "'") {
                            // Escaped single-quote ''
                            $val .= "'";
                            $i  += 2;
                            continue;
                        }
                        // Closing quote
                        $i++;
                        break;
                    }

                    $val .= $ch;
                    $i++;
                }
                $values[] = $val;
            } elseif (strtoupper(substr($inner, $i, 4)) === 'NULL') {
                $values[] = '';
                $i       += 4;
            } else {
                // Unquoted value (integer, enum 'Y'/'N' without quotes, etc.)
                $end = $i;
                while ($end < $len && $inner[$end] !== ',') {
                    $end++;
                }
                $values[] = trim(substr($inner, $i, $end - $i));
                $i        = $end;
            }
        }

        return $values;
    }
}
