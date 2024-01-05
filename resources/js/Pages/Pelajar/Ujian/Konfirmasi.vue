<template>
    <Head>
        <title>Konfirmasi Ujian - Aplikasi Ujian Online</title>
    </Head>
    <div class="row">
        <div class="col-md-12">
            <Link href="/pelajar/dashboard" class="btn btn-md btn-primary border-0 shadow mb-3" type="button"><i
                class="fa fa-long-arrow-alt-left me-2"></i> Kembali</Link>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5> <i class="fa fa-file"></i> Deskripsi Ujian</h5>
                    <hr>
                    <div v-html="kelompok_ujian.ujian.deskripsi"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5> <i class="fa fa-list-ul"></i> Detail Peserta</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead>
                                <tr>
                                    <td class="fw-bold">Nisn</td>
                                    <td>{{ kelompok_ujian.pelajar.nisn }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Nama Lengkap</td>
                                    <td>{{ kelompok_ujian.pelajar.nama }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Kelas</td>
                                    <td>{{ kelompok_ujian.pelajar.kelas.nama_kelas }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Ujian</td>
                                    <td>{{ kelompok_ujian.ujian.nama_ujian }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Mata Pelajaran</td>
                                    <td>{{ kelompok_ujian.ujian.mata_pelajaran.nama_mapel }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Durasi</td>
                                    <td>{{ kelompok_ujian.ujian.durasi }} Menit</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div v-if="nilai.end_time == null">
                        <Link :href="`/pelajar/ujian-start/${kelompok_ujian.id}`"
                            class="btn btn-md btn-success border-0 shadow w-100 mt-2 text-white">Mulai</Link>
                    </div>
                    <div v-else>
                        <button class="btn btn-md btn-primary border-0 shadow w-100 mt-2" disabled>Sudah
                            Mengerjakan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //import layout pelajar
    import LayoutPelajar from '../../../Layouts/Pelajar.vue';

    //import Head and Link from Inertia
    import {
        Head,
        Link
    } from '@inertiajs/inertia-vue3';

    export default {
        //layout
        layout: LayoutPelajar,

        //register components
        components: {
            Head,
            Link
        },

        //props
        props: {
            kelompok_ujian: Object,
            nilai: Object
        },
    }

</script>

<style>

</style>