<template>
    <Head>
        <title>Konfirmasi Ujian - Aplikasi Ujian Online</title>
    </Head>
    <div class="row">
        <div class="col-md-12">
            <Link href="/student/dashboard" class="btn btn-md btn-primary border-0 shadow mb-3" type="button"><i
                class="fa fa-long-arrow-alt-left me-2"></i> Kembali</Link>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5> <i class="fa fa-file"></i> Deskripsi Ujian</h5>
                    <hr>
                    <div v-html="exam_group.exam.description"></div>
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
                                <td>{{ exam_group.student.nisn }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Nama Lengkap</td>
                                <td>{{ exam_group.student.name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kelas</td>
                                <td>{{ exam_group.student.classroom.title }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Ujian</td>
                                <td>{{ exam_group.exam.title }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Mata Pelajaran</td>
                                <td>{{ exam_group.exam.lesson.title }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Durasi</td>
                                <td>{{ exam_group.exam.duration }} Menit</td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div v-if="grade.end_time == null">
                        <Link :href="`/student/exam-start/${exam_group.id}`"
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
//import layout student
import LayoutStudent from '../../../Layouts/Student.vue';

//import Head and Link from Inertia
import {
    Head,
    Link
} from '@inertiajs/inertia-vue3';

export default {
    //layout
    layout: LayoutStudent,

    //register components
    components: {
        Head,
        Link
    },

    //props
    props: {
        exam_group: Object,
        grade: Object
    },
}

</script>

<style>

</style>
