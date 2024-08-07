<?php

namespace App\Livewire\Forms;

use App\Models\WaliKelas as ModelsWaliKelas;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AnggotaRombel extends Form
{
    Public ?ModelsWaliKelas $post;

    public $WaliKelas;
    public $id_wl;
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
        $this->id_wl = $post->id_wl;
        $this->guru_id = $post->guru_id;
        $this->kelas_id = $post->kelas_id;
        $this->ta_id = $post->ta_id; 
        
    }

    public function store()
    {  
        $this->validate([
            'id_wl'     => 'required|unique:wali_kelas,id_wl', 
            'guru_id'   => [
                'required',
                Rule::unique('wali_kelas')->where(function ($query) {
                    return $query->where('kelas_id', $this->kelas_id)
                                 ->where('ta_id', $this->ta_id);
                }),
            ],
            'kelas_id'  => [
                'required',
                Rule::unique('wali_kelas')->where(function ($query) {
                    return $query->where('guru_id', $this->guru_id)
                                 ->where('ta_id', $this->ta_id);
                }),
            ],
            'ta_id'     => 'required',
        ]);

        ModelsWaliKelas::create([
            'id_wl'      => $this->id_wl,       
            'guru_id'    => $this->guru_id,
            'kelas_id'   => $this->kelas_id,
            'ta_id'      => $this->ta_id,
        ]);

        $this->reset();
    }

    public function update()
    {
        $rules = [
            'id_wl' => 'required',
            'guru_id' => [
                'required',
                Rule::unique('wali_kelas')->where(function ($query) {
                    return $query->where('kelas_id', $this->kelas_id)
                                 ->where('ta_id', $this->ta_id);
                })->ignore($this->id_wl, 'id_wl')
            ],
            'kelas_id' => [
                'required',
                Rule::unique('wali_kelas')->where(function ($query) {
                    return $query->where('guru_id', $this->guru_id)
                                 ->where('ta_id', $this->ta_id);
                })->ignore($this->id_wl, 'id_wl')
            ],
            'ta_id' => [
                'required',
                Rule::unique('wali_kelas')->where(function ($query) {
                    return $query->where('guru_id', $this->guru_id)
                                 ->where('kelas_id', $this->kelas_id);
                })->ignore($this->id_wl, 'id_wl')
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

        $walikelas = ModelsWaliKelas::find($this->id_wl);
        if ($walikelas) {
            $walikelas->update([
                'id_wl' => $validatedData['id_wl'],
                'guru_id' => $validatedData['guru_id'],
                'kelas_id' => $validatedData['kelas_id'],
                'ta_id' => $validatedData['ta_id'],
            ]);
        }
        $this->reset();
    }
}
