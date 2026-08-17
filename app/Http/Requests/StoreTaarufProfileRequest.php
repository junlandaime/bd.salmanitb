<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaarufProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Identitas
            'gender'             => 'required|in:male,female',
            'full_name'          => 'required|string|max:255',
            'nickname'           => 'required|string|max:100',
            'birth_place_date'   => 'required|string|max:255',

            // Lokasi
            'current_residence'  => 'required|string|max:255',

            // Pendidikan & Pekerjaan
            'last_education'     => 'required|string|max:255',
            'occupation'         => 'required|string|max:255',

            // Pernikahan
            'marriage_target_year' => 'nullable|integer|min:2025|max:2050',

            // Kepribadian & Harapan
            'personality'            => 'nullable|string|max:255',
            'expectation'            => 'nullable|string',
            'ideal_partner_criteria' => 'nullable|string',
            'visi_misi'              => 'nullable|string',
            'kelebihan_kekurangan'   => 'nullable|string',

            // Media & Sosial
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'instagram' => 'nullable|string|max:255',

            // Dokumen
            'informed_consent' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ];
    }

    /**
     * Get custom attribute names for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'gender'               => 'Jenis Kelamin',
            'full_name'            => 'Nama Lengkap',
            'nickname'             => 'Nama Panggilan',
            'birth_place_date'     => 'Tempat & Tanggal Lahir',
            'current_residence'    => 'Domisili Saat Ini',
            'last_education'       => 'Pendidikan Terakhir',
            'occupation'           => 'Pekerjaan',
            'marriage_target_year' => 'Target Tahun Menikah',
            'informed_consent'     => 'Informed Consent',
        ];
    }
}
