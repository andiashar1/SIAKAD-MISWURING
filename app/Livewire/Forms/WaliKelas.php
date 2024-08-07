<?php

namespace App\Livewire\Forms;

use App\Models\WaliKelas as ModelsWaliKelas;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Rules\UniqueKelasGuruTa;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class WaliKelas extends Form
{
    Public ?ModelsWaliKelas $post;

    public $WaliKelas;
    public $id;
    public $guru_id;
    public $kelas_id;
    public $ta_id;

    public function hapus()
    {
        $this->reset();
        $this->resetErrorBag();
        session()->forget('message');
        session()->forget('error');
    }

    public function setPost(ModelsWaliKelas $post){

        $this->post = $post;
        $this->id = $post->id;
        $this->guru_id = $post->guru_id;
        $this->kelas_id = $post->kelas_id;
        $this->ta_id = $post->ta_id; 
        
    }

    protected function rules()
    {
        return [
            'kelas_id' => [
                'required',
                new UniqueKelasGuruTa($this->guru_id, $this->ta_id)
            ],
            'guru_id' => 'required|exists:gurus,id',
            'ta_id' => 'required|exists:tahun_ajarans,id',
        ];
    }

    public function store()
    {  
        // $this->validate();

        $kelas = Kelas::where('id', $this->kelas_id)->pluck('nama_kelas')->first();
        $tahun_ajaran = TahunAjaran::where('id', $this->ta_id)->pluck('kode_ta')->first();
        $nama_ta = substr($tahun_ajaran, 2, 4) . substr($tahun_ajaran, -1);

        ModelsWaliKelas::create([     
            'guru_id'    => $this->guru_id,
            'kelas_id'   => $this->kelas_id,
            'ta_id'      => $this->ta_id,
        ]);

        $this->reset();
    }

    public function update()
    {
        $rules = [
            'guru_id' => [
                'required',
                Rule::unique('wali_kelas')->where(function ($query) {
                    return $query->where('kelas_id', $this->kelas_id)
                                 ->where('ta_id', $this->ta_id);
                })->ignore($this->id, 'id')
            ],
            'kelas_id' => [
                'required',
                Rule::unique('wali_kelas')->where(function ($query) {
                    return $query->where('guru_id', $this->guru_id)
                                 ->where('ta_id', $this->ta_id);
                })
            ],
            'ta_id' => [
                'required',
                Rule::unique('wali_kelas')->where(function ($query) {
                    return $query->where('guru_id', $this->guru_id)
                                 ->where('kelas_id', $this->kelas_id);
                })
            ],
        ];

        $messages = [
            'guru_id.required' => 'Guru harus diisi.',
            'guru_id.unique' => 'Guru ini sudah terdaftar di kelas lain.',
            'kelas_id.required' => 'Kelas harus diisi.',
            'kelas_id.unique' => 'Kelas ini sudah diisi guru lain.',
            'ta_id.unique' => 'Tahun ajaran ini sudah diisi untuk kombinasi guru dan kelas yang sama.',
        ];

        $validatedData = $this->validate($rules, $messages);

        $walikelas = ModelsWaliKelas::find($this->id);
        if ($walikelas) {
            $walikelas->update([
                'guru_id' => $validatedData['guru_id'],
                'kelas_id' => $validatedData['kelas_id'],
                'ta_id' => $validatedData['ta_id'],
            ]);
        }
        $this->reset();
    }
}
