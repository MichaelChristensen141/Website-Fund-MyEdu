<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'NamaDepan' => 'required',
            'NamaBelakang' => 'required',
            'Alamat' => 'required',
            'TanggalLahir' => 'required|date',
            'JurusanID' => 'required',
            'JenjangID' => 'required',
            'NilaiRata' => 'required|numeric',
            'PekerjaanOrtu' => 'required',
            'PendapatanOrtu' => 'required',
            'TahunLulus' => 'required|integer|min:2000',
        ];
    }
}
