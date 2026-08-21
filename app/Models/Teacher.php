<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'position',
        'photo',
        'order',
    ];

    /**
     * Get predefined list of positions in priority order.
     */
    public static function getPredefinedPositions(): array
    {
        return [
            'Kepala Sekolah',
            'Wakil Kepala Sekolah Bidang Kurikulum',
            'Wakil Kepala Sekolah Bidang Kesiswaan',
            'Wakil Kepala Sekolah Bidang Humas',
            'Wakil Kepala Sekolah Bidang Sarana & Prasarana',
            'Guru Bimbingan Konseling (BK)',
            'Guru Bahasa Indonesia',
            'Guru Bahasa Inggris',
            'Guru Matematika',
            'Guru Pendidikan Jasmani (PJOK)',
            'Guru Seni Budaya',
            'Guru IPA (Fisika/Kimia/Biologi)',
            'Guru IPS (Sejarah/Sosiologi/Ekonomi)',
            'Guru Pendidikan Agama & Budi Pekerti',
            'Staf Tata Usaha',
            'Pustakawan',
        ];
    }

    /**
     * Determine if the teacher is a staff member (non-teaching).
     */
    public function getIsStaffAttribute(): bool
    {
        $staffKeywords = ['tata usaha', 'pustakawan', 'administrasi', 'karyawan', 'staf', 'staff'];
        $position = strtolower($this->position ?? '');

        foreach ($staffKeywords as $keyword) {
            if (str_contains($position, $keyword)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Scope to sort teachers by predefined position priority.
     */
    public function scopeSorted($query)
    {
        $predefined = static::getPredefinedPositions();

        return $query->get()->sort(function ($a, $b) use ($predefined) {
            $posA = array_map('trim', explode(',', $a->position));
            $posB = array_map('trim', explode(',', $b->position));

            $priorityA = 999;
            foreach ($posA as $p) {
                $idx = array_search($p, $predefined);
                if ($idx !== false && $idx < $priorityA) {
                    $priorityA = $idx;
                }
            }

            $priorityB = 999;
            foreach ($posB as $p) {
                $idx = array_search($p, $predefined);
                if ($idx !== false && $idx < $priorityB) {
                    $priorityB = $idx;
                }
            }

            if ($priorityA !== $priorityB) {
                return $priorityA <=> $priorityB;
            }

            $posStringA = implode(', ', $posA);
            $posStringB = implode(', ', $posB);
            $posComp = strcasecmp($posStringA, $posStringB);
            if ($posComp !== 0) {
                return $posComp;
            }

            return strcasecmp($a->name, $b->name);
        })->values();
    }
}
