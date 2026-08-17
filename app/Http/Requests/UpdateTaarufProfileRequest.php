<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaarufProfileRequest extends FormRequest
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
            'gender'           => 'required|in:male,female',
            'full_name'        => 'required|string|max:255',
            'nickname'         => 'required|string|max:100',
            'birth_place_date' => 'required|string|max:255',

            // Asal Daerah
            'origin_province' => 'required|string|max:255',
            'origin_city'     => 'required|string|max:255',
            'origin_district' => 'required|string|max:255',
            'origin_village'  => 'required|string|max:255',

            // Domisili
            'current_residence'  => 'required|string|max:255',
            'residence_province' => 'required|string|max:255',
            'residence_city'     => 'required|string|max:255',
            'residence_district' => 'required|string|max:255',
            'residence_village'  => 'required|string|max:255',

            // Pendidikan
            'last_education'    => 'required|string|max:255',
            'education_level'   => 'required|string|in:SD,SMP,SMA,SMK,D3,D4,S1,S2,S3',
            'university'        => 'required|string',
            'custom_university' => 'nullable|string|required_if:university,Lainnya',
            'major'             => 'nullable|string',

            // Pekerjaan & Pernikahan
            'occupation'           => 'required|string|max:255',
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
            'informed_consent' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
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
            'gender'             => 'Jenis Kelamin',
            'full_name'          => 'Nama Lengkap',
            'nickname'           => 'Nama Panggilan',
            'birth_place_date'   => 'Tempat & Tanggal Lahir',
            'origin_province'    => 'Provinsi Asal',
            'origin_city'        => 'Kota/Kabupaten Asal',
            'origin_district'    => 'Kecamatan Asal',
            'origin_village'     => 'Kelurahan Asal',
            'current_residence'  => 'Domisili Saat Ini',
            'residence_province' => 'Provinsi Domisili',
            'residence_city'     => 'Kota/Kabupaten Domisili',
            'residence_district' => 'Kecamatan Domisili',
            'residence_village'  => 'Kelurahan Domisili',
            'last_education'     => 'Pendidikan Terakhir',
            'education_level'    => 'Strata Pendidikan',
            'university'         => 'Nama Institusi/Kampus',
            'major'              => 'Jurusan/Program Studi',
            'occupation'         => 'Pekerjaan',
            'informed_consent'   => 'Informed Consent',
        ];
    }
}
