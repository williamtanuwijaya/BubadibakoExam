<template>
    <Head>
        <title>Dashboard Siswa - Aplikasi Ujian Online</title>
    </Head>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success border-0 shadow">
                Selamat Datang <strong>{{ auth.pelajars.nama }}</strong>
            </div>
        </div>
    </div>
    <div class="row" v-if="kelompok_ujians.length > 0">
        <div class="col-md-6" v-for="(data, index) in kelompok_ujians" :key="index">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5>{{ data.kelompok_ujian.ujian.nama_ujian }}</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead>
                            <tr>
                                <td class="fw-bold">Mata Pelajaran</td>
                                <td>{{ data.kelompok_ujian.ujian.mata_pelajaran.nama_mapel }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kelas</td>
                                <td>{{ data.kelompok_ujian.pelajar.kelas.nama_kelas }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Sesi</td>
                                <td>{{ data.kelompok_ujian.sesi_ujian.sesi_ujian }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Mulai</td>
                                <td>{{ data.kelompok_ujian.sesi_ujian.waktu_mulai }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Selesai</td>
                                <td>{{ data.kelompok_ujian.sesi_ujian.waktu_selesai }}</td>
                            </tr>
                            </thead>
                        </table>
                    </div>

                    <!-- cek waktu selesai -->
                    <div v-if="data.nilai.waktu_selesai == null">

                        <!-- cek apakah ujian sudah dimulai, tapi waktu masih ada -->
                        <div
                            v-if="examTimeRangeChecker(data.kelompok_ujian.sesi_ujian.waktu_mulai, data.kelompok_ujian.sesi_ujian.waktu_selesai)">

                            <div v-if="data.nilai.waktu_mulai == null">
                                <Link :href="`/pelajar/konfirmasi-ujian/${data.kelompok_ujian.id_kelompok_ujian}`"
                                      class="btn btn-md btn-success border-0 shadow w-100 mt-2 text-white">Kerjakan
                                </Link>
                            </div>

                            <div v-else>
                                <Link :href="`/pelajar/mulai-ujian/${data.kelompok_ujian.id_kelompok_ujian}/1`"
                                      class="btn btn-md btn-info border-0 shadow w-100 mt-2">Lanjut Kerjakan
                                </Link>
                            </div>

                        </div>

                        <div v-else>

                            <!-- ujian belum mulai-->
                            <div v-if="examTimeStartChecker(data.kelompok_ujian.sesi_ujian.waktu_mulai)">
                                <button class="btn btn-md btn-gray-700 border-0 shadow w-100 mt-2" disabled>Belum
                                    Mulai
                                </button>
                            </div>

                            <!-- ujian terlewat -->
                            <div v-if="examTimeEndChecker(data.kelompok_ujian.sesi_ujian.waktu_selesai)">
                                <button class="btn btn-md btn-danger border-0 shadow w-100 mt-2" disabled>Waktu
                                    Terlewat
                                </button>
                            </div>

                        </div>

                    </div>

                    <div v-else>
                        <button class="btn btn-md btn-danger border-0 shadow w-100 mt-2" disabled>Sudah Dikerjakan
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row" v-else>
        <div class="col-md-12">
            <div class="alert alert-danger border-0 shadow">
                <i class="fa fa-info-circle"></i> Tidak ada ujian yang tersedia
            </div>
        </div>
    </div>
</template>

<script>
//import layout pelajar
import LayoutPelajar from '../../../Layouts/Pelajar.vue';

//import Link from Inertia
import {
    Link
} from '@inertiajs/inertia-vue3';

export default {

    //layout
    layout: LayoutPelajar,

    //register components
    components: {
        Link,
    },

    //register props
    props: {
        kelompok_ujians: Array,
        auth: Object
    },
    mounted() {
        console.log('kelompok_ujians:', this.kelompok_ujians);
        console.log('auth:', this.auth);
    },

}

</script>

<style>

</style>
