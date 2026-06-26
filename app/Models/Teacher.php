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
}
