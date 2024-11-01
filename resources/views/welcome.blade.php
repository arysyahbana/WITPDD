<!doctype html>
<html>

<title>WITPDD</title>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('dist/js/iziToast.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('dist/img/logo.webp') }}">
    <link href="{{ asset('dist/css/iziToast.min.css') }}" rel="stylesheet">
</head>

<body>
    {{-- Navbar --}}

    <nav class="bg-gradient-to-r from-[#45474B] to-[#343131] border-gray-200 fixed z-10 w-full">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#home" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('dist/img/logo.webp') }}" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold text-white whitespace-nowrap">WITPDD</span>
            </a>
            <button data-collapse-toggle="navbar-dropdown" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <li>
                        <a href="#home"
                            class="block py-2 px-3 text-[#E9EFEC] hover:text-[#23F9B5] rounded md:bg-transparent md:p-0"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#visi"
                            class="block py-2 px-3 text-[#E9EFEC] hover:text-[#23F9B5] rounded md:bg-transparent md:p-0"
                            aria-current="page">Visi</a>
                    </li>
                    <li>
                        <a href="#misi"
                            class="block py-2 px-3 text-[#E9EFEC] hover:text-[#23F9B5] rounded md:bg-transparent md:p-0"
                            aria-current="page">Misi</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="flex items-center justify-between w-full py-2 px-3 text-[#E9EFEC] rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#23F9B5] md:p-0 md:w-auto">APB
                            Desa
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg></button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar"
                            class="z-10 hidden font-normal bg-[#C4DAD2] divide-y divide-gray-100 rounded-lg shadow w-44">
                            <ul class="py-2 text-sm text-[#16423C]" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="#pendapatan" class="block px-4 py-2 hover:bg-gray-100">Pendapatan
                                        Dana Desa
                                    </a>
                                </li>
                                <li>
                                    <a href="#anggaran" class="block px-4 py-2 hover:bg-gray-100">Anggaran
                                        Dana Desa</a>
                                </li>
                                <li>
                                    <a href="#pembelanjaan" class="block px-4 py-2 hover:bg-gray-100">Pembelanjaan</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#laporan"
                            class="block py-2 px-3 text-[#E9EFEC] rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#23F9B5] md:p-0">Laporan
                            Keuangan</a>
                    </li>
                    <li>
                        <a href="#krisar"
                            class="block py-2 px-3 text-[#E9EFEC] rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#23F9B5] md:p-0">Kritik
                            dan Saran</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home">
        <div class="bg-gradient-to-r from-[#45474B] to-[#343131] w-full pt-20 py-12 rounded-b-[100px]">
            <div class="container mx-auto mt-1 lg:mt-24 mb-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="text-[#EBF4F6] py-16 mx-12 md:mx-0" data-aos="fade-right" data-aos-duration="1000">
                        <p class="text-xl text-[#23F9B5]">#Transparansi Dana Desa</p>
                        <p class="text-5xl font-bold mt-2 mb-1">
                            Website Informasi Transparansi Penggunaan Dana Desa
                        </p>
                        <p class="text-xl mb-5">Mempermudah masyarakat dalam mengawasi penggunaan dana desa secara
                            transparan dan
                            akuntabel</p>
                        <a href="{{ route('login') }}" type="button"
                            class="focus:outline-none text-[#45474B] bg-[#23F9B5] hover:text-white hover:bg-teal-600 focus:ring-4 focus:ring-teal-500 font-medium rounded-3xl text-sm px-5 py-2.5 mb-2">
                            Login
                        </a>
                    </div>
                    <div class="rounded-3xl shadow-xl mx-12 md:mx-0 max-h-[400px] relative" data-aos="fade-left"
                        data-aos-duration="1000">
                        <img src="{{ asset('dist/img/banner2.jpg') }}" alt=""
                            class="object-cover h-full w-full rounded-3xl border" />
                        <div class="hidden xl:block absolute h-full w-[250px] top-[-60px] left-[-60px] max-h-[250px]"
                            data-aos="zoom-in" data-aos-duration="1700">
                            <img src="{{ asset('dist/img/banner1.jpg') }}" alt=""
                                class="object-cover h-full w-full rounded-3xl shadow-xl border" />
                        </div>
                        <div class="hidden xl:block absolute h-full w-[250px] top-[220px] right-[-60px] max-h-[250px]"
                            data-aos="zoom-in" data-aos-duration="2000">
                            <img src="{{ asset('dist/img/banner3.jpg') }}" alt=""
                                class="object-cover h-full w-full rounded-3xl shadow-xl border" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="container mx-auto my-20">
        <!-- about -->
        <section id="about" class="grid grid-cols-1 md:grid-cols-2">
            <div class="overflow-hidden h-96 rounded-3xl" data-aos="fade-up" data-aos-duration="1200">
                <img src="{{ asset('dist/img/banner4.jpg') }}" alt="" class="object-cover rounded-3xl" />
            </div>
            <div class="px-12">
                <p class="text-teal-500">ABOUT</p>
                <p class="text-3xl font-bold text-[#45474B]">
                    Website Informasi Transparansi Penggunaan Dana Desa
                </p>
                <p class="mt-5 text-slate-600">
                    Aplikasi ini bertujuan mempermudah masyarakat dalam mengawasi penggunaan dana desa secara transparan
                    dan akuntabel. Dengan platform ini, masyarakat dapat mengakses informasi terkait alokasi dan
                    penggunaan dana desa secara detail, mulai dari tahap perencanaan hingga pelaksanaan. Hal ini
                    memungkinkan masyarakat untuk memantau setiap pengeluaran yang dilakukan oleh pemerintah desa,
                    sehingga menciptakan rasa kepercayaan yang lebih besar terhadap pengelolaan dana publik.

                    Selain itu, dengan kemudahan akses dan penyajian data yang jelas, aplikasi ini juga mendorong
                    partisipasi aktif dari masyarakat dalam proses pembangunan desa.
                </p>
            </div>
        </section>

        <!-- Visi -->
        <section id="visi" class="mt-32">
            <p class="text-center text-3xl font-bold text-teal-500">VISI</p>
            <p class="text-center text-[#45474B]">
                Berikut Visi Desa Durian IV Mbelang.
            </p>
            <p class="text-center text-slate-600 mt-5 italic px-72">
                "Mewujudkan Desa Durian IV Mbelang sebagai Pusat Usaha Pertanian (Agribisnis) di Kecamatan STM Hulu yang
                berasaskan Iman dan Taqwa serta Ilmu Pengetahuan dan Teknologi Tahun 2030"
            </p>
        </section>

        <!-- misi -->
        <section id="misi" class="mt-32">
            <p class="text-center text-3xl font-bold text-teal-500">MISI</p>
            <p class="text-center text-[#45474B]">
                Berikut Misi Desa Durian IV Mbelang.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 mt-5 justify-items-center">
                <div class="bg-gradient-to-r from-[#45474B] to-[#343131] hover:from-teal-300 hover:to-teal-500 max-w-lg text-white hover:text-[#45474B] rounded-xl shadow-xl"
                    target="blank" data-aos="fade-up" data-aos-duration="1000">
                    <div class="p-5 overflow-hidden rounded-xl">
                        <p class="text-sm">
                            Menyelenggarakan Pemerintahan Desa yang Partisipatif, Akuntabel, Transparan, Dinamis dan
                            Kreatif.
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#45474B] to-[#343131] hover:from-teal-300 hover:to-teal-500 max-w-lg text-white hover:text-[#45474B] rounded-xl shadow-xl"
                    target="blank" data-aos="fade-up" data-aos-duration="1300">
                    <div class="p-5 overflow-hidden rounded-xl">
                        <p class="text-sm">
                            Meningkatkan Kualitas dan Kuantitas Kegiatan Keagamaan.
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#45474B] to-[#343131] hover:from-teal-300 hover:to-teal-500 max-w-lg text-white hover:text-[#45474B] rounded-xl shadow-xl"
                    target="blank" data-aos="fade-up" data-aos-duration="1600">
                    <div class="p-5 overflow-hidden rounded-xl">
                        <p class="text-sm">
                            Meningkatkan Kualitas Sumber Daya Manusia Melalui Pembangunan Sektor Pertanian, Pendidikan,
                            Kesehatan, Kebudayaan, Kependudukan dan KetenagaKerjaan.
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#45474B] to-[#343131] hover:from-teal-300 hover:to-teal-500 max-w-lg text-white hover:text-[#45474B] rounded-xl shadow-xl"
                    target="blank" data-aos="fade-up" data-aos-duration="1900">
                    <div class="p-5 overflow-hidden rounded-xl">
                        <p class="text-sm">
                            Meningkatkan Produksi Pertanian dan Perkebunan Masyarakat Melalui Pengelolaan Pertanian
                            Intensifikasi yang Maju, Unggul dan Ramah Lingkungan Menuju Desa Agrobisnis.
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#45474B] to-[#343131] hover:from-teal-300 hover:to-teal-500 max-w-lg text-white hover:text-[#45474B] rounded-xl shadow-xl"
                    target="blank" data-aos="fade-up" data-aos-duration="2100">
                    <div class="p-5 overflow-hidden rounded-xl">
                        <p class="text-sm">
                            Meningkatkan Infrastruktur Desa Melalui Peningkatan Prasarana Jalan, Energi Listrik,
                            Pengelolaan Sumber Daya Air, Pengelolaan Lingkungan, Penataan Ruang dan Perumahan.
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#45474B] to-[#343131] hover:from-teal-300 hover:to-teal-500 max-w-lg text-white hover:text-[#45474B] rounded-xl shadow-xl"
                    target="blank" data-aos="fade-up" data-aos-duration="2400">
                    <div class="p-5 overflow-hidden rounded-xl">
                        <p class="text-sm">
                            Menanggulangi Kemiskinan Melalui Permberdayaan Ekonomi Kerakyatan dan Perekonomian
                            Perdesaan.
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#45474B] to-[#343131] hover:from-teal-300 hover:to-teal-500 max-w-lg text-white hover:text-[#45474B] rounded-xl shadow-xl"
                    target="blank" data-aos="fade-up" data-aos-duration="2700">
                    <div class="p-5 overflow-hidden rounded-xl">
                        <p class="text-sm">
                            Menyusun Regulasi Desa dan Menata Dokumen-dokumen yang menjadi Kewajiban Desa sebagai Payung
                            Hukum Pembangunan Desa.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filter Tahun -->
        <div class="flex justify-center mb-5 w-full mt-32">
            <form method="GET" action="{{ url()->current() }}">
                <div class="flex">
                    <select name="tahun" id="tahun"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block p-2.5">
                        @foreach ($availableYears as $year)
                            <option value="{{ $year }}" {{ $year == $filterYear ? 'selected' : '' }}>
                                Data Tahun
                                {{ $year }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="ml-2 px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600">Filter</button>
                </div>
            </form>
        </div>

        <!-- pendapatan -->
        <section id="pendapatan" class="mt-5">
            <p class="text-center text-3xl font-bold text-teal-500">PENDAPATAN DANA DESA</p>
            <p class="text-center text-[#45474B]">
                Berikut Pendapatan Dana Desa Durian IV Mbelang.
            </p>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5" data-aos="fade-up"
                data-aos-duration="1000">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-[#45474B]">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sumber Dana
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Anggaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bukti Transaksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendapatans as $pendapatan)
                            <tr class="bg-gray-500 border-b  hover:bg-gray-600 ">
                                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap ">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4 text-white">
                                    {{ \Carbon\Carbon::parse($pendapatan->tgl_input ?? '')->locale('id')->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 text-white">
                                    {{ $pendapatan->sumber_dana ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-white">
                                    Rp. {{ number_format($pendapatan->jumlah_anggaran, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-white">
                                    <a href="{{ asset('/dist/assets/img/pendapatan/' . $pendapatan->img) }}"
                                        target="_blank"><img
                                            src="{{ asset('/dist/assets/img/pendapatan/' . $pendapatan->img) }}"
                                            alt="{{ $pendapatan->sumber_dana }}" class="img-fluid img-thumbnail"
                                            style="max-width: 100px"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </section>

        <!-- anggaran -->
        <section id="anggaran" class="mt-32">
            <p class="text-center text-3xl font-bold text-teal-500">ANGGARAN DANA DESA</p>
            <p class="text-center text-[#45474B]">
                Berikut Anggaran Dana Desa Durian IV Mbelang.
            </p>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5" data-aos="fade-up"
                data-aos-duration="1200">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-[#45474B]">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bidang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Anggaran
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggarans as $anggaran)
                            <tr class="bg-gray-500 border-b  hover:bg-gray-600 ">
                                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap ">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4 text-white">
                                    {{ \Carbon\Carbon::parse($anggaran->tgl_input ?? '')->locale('id')->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 text-white">
                                    {{ $anggaran->bidang ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-white">
                                    Rp. {{ number_format($anggaran->jumlah_anggaran, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </section>

        <!-- pembelanjaan -->
        <section id="pembelanjaan" class="mt-32">
            <p class="text-center text-3xl font-bold text-teal-500">
                PEMBELANJAAN DANA DESA</p>
            <p class="text-center text-[#45474B]">
                Berikut Pembelanjaan Dana Desa Durian IV Mbelang.
            </p>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5" data-aos="fade-up"
                data-aos-duration="1400">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-[#45474B] text-center">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Transaksi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Uraian
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bidang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sumber Dana
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Anggaran Dana yang di Pakai
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bukti Transaksi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Foto Kegiatan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bukti Terealisasi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Keterangan
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelanjaans as $pembelanjaan)
                            <tr class="bg-gray-500 border-b  hover:bg-gray-600 ">
                                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap ">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4 text-white">
                                    {{ \Carbon\Carbon::parse($pembelanjaan->tgl_transaksi ?? '')->locale('id')->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 text-white break-words whitespace-normal max-w-md">
                                    {{ $pembelanjaan->uraian ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-white">
                                    {{ $pembelanjaan->rAnggaran->bidang ?? '' }}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap ">
                                    {{ $pembelanjaan->rPendapatan->sumber_dana ?? '' }}
                                </th>
                                <td class="px-6 py-4 text-white">
                                    Rp. {{ number_format($pembelanjaan->jumlah_anggaran, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-white">
                                    <a href="{{ asset('dist/assets/img/transaksi/' . $pembelanjaan->img_transaksi ?? '') }}"
                                        target="_blank">
                                        <img src="{{ asset('dist/assets/img/transaksi/' . $pembelanjaan->img_transaksi ?? '') }}"
                                            alt="{{ $pembelanjaan->img_transaksi ?? '' }}"
                                            class="img-fluid img-thumbnail" style="max-width: 100px">
                                    </a>
                                </td>
                                <td class="py-4 text-white">
                                    @if ($pembelanjaan->img_kegiatan)
                                        @foreach (explode(',', $pembelanjaan->img_kegiatan) as $kegiatan)
                                            @if (trim($kegiatan) != '')
                                                <p class="mb-0 text-xs">
                                                    <a href="{{ asset('dist/assets/img/kegiatan/' . trim($kegiatan)) }}"
                                                        target="_blank">
                                                        Lihat Gambar {{ $loop->iteration }}
                                                    </a>
                                                </p>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap ">
                                    @if ($pembelanjaan->img_terealisasi)
                                        <a href="{{ asset('dist/assets/img/terealisasi/' . $pembelanjaan->img_terealisasi ?? '') }}"
                                            target="_blank">
                                            <img src="{{ asset('dist/assets/img/terealisasi/' . $pembelanjaan->img_terealisasi ?? '') }}"
                                                alt="{{ $pembelanjaan->img_terealisasi ?? '' }}"
                                                class="img-fluid img-thumbnail" style="max-width: 100px">
                                        </a>
                                    @else
                                        <span>Tidak Ada</span>
                                    @endif
                                </th>
                                <td class="px-6 py-4 text-white">
                                    {{ $pembelanjaan->status ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </section>

        <!-- laporan -->
        <section id="laporan" class="mt-32">
            <p class="text-center text-3xl font-bold text-teal-500">LAPORAN KEUANGAN</p>
            <p class="text-center text-[#45474B]">
                Berikut Laporan Keuangan Desa Durian IV Mbelang.
            </p>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5" data-aos="fade-up"
                data-aos-duration="1600">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-[#45474B]">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tahun
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Pendapatan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Pembelanjaan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Surplus/Defisit
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $index => $laporan)
                            <tr class="bg-gray-500 border-b  hover:bg-gray-600 ">
                                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap ">
                                    {{ $index + 1 }}
                                </th>
                                <td class="px-6 py-4 text-white">
                                    {{ $laporan->year }}
                                </td>
                                <td class="px-6 py-4 text-white">
                                    Rp. {{ number_format($laporan->total_pendapatan, 0, ',', '.') }}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap ">
                                    Rp. {{ number_format($laporan->total_pembelanjaan, 0, ',', '.') }}
                                </th>
                                <td class="px-6 py-4 text-white">
                                    Rp. {{ number_format($laporan->surplus_defisit, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </section>

        <!-- krisar -->
        <section id="krisar" class="mt-32">
            <p class="text-center text-3xl font-bold text-teal-500">KRITIK DAN SARAN</p>
            <p class="text-center text-[#45474B]">
                Sampaikan Kritik dan Saranmu
            </p>

            <form action="{{ route('krisar.store') }}" class="max-w-2xl mx-auto mt-12" data-aos="fade-up"
                data-aos-duration="1000" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" id="nama"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Masukan Nama" required name="nama" />
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Masukan Email" required name="email" />
                </div>
                <div class="mb-5">
                    <label for="kritik" class="block mb-2 text-sm font-medium text-gray-900">Kritik</label>
                    <textarea id="kritik" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukan Kritik..." name="kritik"></textarea>
                </div>
                <div class="mb-5">
                    <label for="saran" class="block mb-2 text-sm font-medium text-gray-900">Saran</label>
                    <textarea id="saran" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukan Saran..." name="saran"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Kirimkan</button>
                </div>
            </form>


        </section>
    </main>

    <footer class="bg-gradient-to-r from-[#45474B] to-[#343131] shadow-xl">
        <p class="text-center text-white py-2">
            Copyright Website Informasi Transparansi Penggunaan Dana Desa 2024 All right reserved
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script>
        AOS.init();
    </script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                iziToast.error({
                    title: '',
                    position: 'topRight',
                    message: '{{ $error }}',
                });
            </script>
        @endforeach
    @endif
    @if (session()->get('success'))
        <script>
            iziToast.success({
                title: '',
                position: 'topRight',
                message: '{{ session()->get('success') }}',
            });
        </script>
    @endif
</body>

</html>
