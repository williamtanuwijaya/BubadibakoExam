<template>
    <Head>
        <title>Hasil Ujian - Aplikasi Ujian Online</title>
    </Head>
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5> <i class="fa fa-check-circle"></i> Ujian Selesai</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead>
                                <tr>
                                    <td class="fw-bold">Nisn</td>
                                    <td>{{ kelompok_ujian.student.nisn }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Nama Lengkap</td>
                                    <td>{{ kelompok_ujian.student.Nama }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Kelas</td>
                                    <td>{{ kelompok_ujian.student.classroom.nama_kelas }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Ujian</td>
                                    <td>{{ kelompok_ujian.ujian.nama_ujian }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Mata Pelajaran</td>
                                    <td>{{ kelompok_ujian.ujian.lesson.nama_mapel }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Mulai Mengerjakan</td>
                                    <td>{{ nilai.start_time }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Selesai Mengerjakan</td>
                                    <td>{{  nilai.end_time  }}</td>
                                </tr>
                            </thead>
                            <tbody v-if="kelompok_ujian.ujian.show_answer == 'Y'">
                                    <tr>
                                        <td class="fw-bold">Jumlah Benar</td>
                                        <td>{{  nilai.total_correct  }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Nilai</td>
                                        <td>{{  nilai.nilai  }}</td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //import layout student
    import LayoutPelajar from '../../../Layouts/Student.vue';

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