<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\WaliKelas; // Ganti dengan model yang sesuai

class UniqueKelasGuruTa implements Rule
{
    private $guruId;
    private $taId;

    public function __construct($guruId, $taId)
    {
        $this->guruId = $guruId;
        $this->taId = $taId;
    }

    public function passes($attribute, $kelasId)
    {
        return !WaliKelas::where('guru_id', $this->guruId)
                         ->where('ta_id', $this->taId)
                         ->where('kelas_id', $kelasId)
                         ->exists();
    }

    public function message()
    {
        return 'Kombinasi kelas_id, guru_id, dan ta_id harus unik.';
    }
}
