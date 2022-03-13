@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profil') }}</div>

                    <div class="card-body">
                        @php
                            $namaDepan = 'Budi';
                            $namaBelakang = 'Hartono';
                            $tahunLahir = 1993;
                            $tinggiBadan = 175;
                            $beratBadan = 60;
                            $bekerja = false;
                            $hobi = ['Berenang', 'Membaca', 'Belajar'];
                            function bmi($tinggiBadan, $beratBadan)
                            {
                                $bmi = $beratBadan / ($tinggiBadan / 100) ** 2;
                                return $bmi;
                            }
                            /* Object Oriented */
                            class tahunLahir
                            {
                                /* Properties */
                                public $tahunLahir;
                                /* Method */
                                public function __construct($tahunLahir)
                                {
                                    $this->tahunLahir = $tahunLahir;
                                }
                                public function hitungUmur()
                                {
                                    return 2022 - $this->tahunLahir;
                                }
                            }
                            /* Inheritance */
                            class cekUmur extends tahunLahir
                            {
                                public function apakahDewasa()
                                {
                                    if ($this->hitungUmur() >= 17) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            }
                            $umur = new CekUmur(1993);
                        @endphp

                        <h1>Biodata Diri</h1>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $namaDepan }} {{ $namaBelakang }}</td>
                                </tr>
                                <tr>
                                    <td>Tinggi Badan</td>
                                    <td>: {{ $tinggiBadan }} cm</td>
                                </tr>
                                <tr>
                                    <td>Berat Badan</td>
                                    <td>: {{ $beratBadan }} kg</td>
                                </tr>
                                <tr>
                                    <td>BMI</td>
                                    <td>: {{ bmi($tinggiBadan, $beratBadan) }}</td>
                                </tr>
                                <tr>
                                    <td>Status Berat Badan</td>
                                    <td>
                                        @if (bmi($tinggiBadan, $beratBadan) < 18.5)
                                            : Kurus
                                        @elseif(bmi($tinggiBadan, $beratBadan) <= 22.9)
                                            : Normal
                                        @elseif(bmi($tinggiBadan, $beratBadan) <= 29.9)
                                            : Berlebih
                                        @elseif(bmi($tinggiBadan, $beratBadan) > 30)
                                            : Obesitas
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>: {{ $umur->hitungUmur() }} tahun</td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Hobi</td>
                                    <td>: {{ $hobi[1] }}</td>
                                </tr>
                                <tr>
                                    <td>Lolos UJK</td>
                                    <td>:
                                        @if ($umur->apakahDewasa() === true && $bekerja === false)
                                            Anda bisa mendapatkan Beasiswa Uji Kompetensi
                                        @else
                                            Anda dapat mengikuti Uji Kompetensi secara Reguler
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
