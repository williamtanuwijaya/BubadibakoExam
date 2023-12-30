<template>
    <Head>
        <title>Detail Ujian - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">

                <Link href="/admin/exams" class="btn btn-md btn-primary border-0 shadow mb-3" type="button"><i class="fa fa-long-arrow-alt-left me-2"></i> Kembali</Link>

                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <h5> <i class="fa fa-edit"></i> Detail Ujian</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                                <tbody>
                                <tr>
                                    <td style="width:30%" class="fw-bold">Nama Ujian</td>
                                    <td>{{ exam.nama_ujian }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Mata Pelajaran</td>
                                    <td>{{ exam.mata_pelajaran.nama_mapel }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Kelas</td>
                                    <td>{{ exam.kelas.nama_kelas }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Jumlah Soal</td>
                                    <td>{{ exam.pertanyaan.data.length }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Durasi (Menit)</td>
                                    <td>{{ exam.durasi }} Menit</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5> <i class="fa fa-question-circle"></i> Soal Ujian</h5>
                        <hr>

                        <Link :href="`/admin/exams/${exam.id_ujian}/questions/create`" class="btn btn-md btn-primary border-0 shadow me-2" type="button"><i class="fa fa-plus-circle"></i> Tambah</Link>
                        <Link :href="`/admin/exams/${exam.id_ujian}/questions/import`" class="btn btn-md btn-success border-0 shadow text-white" type="button"><i class="fa fa-file-excel"></i> Import</Link>

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-dark">
                                <tr class="border-0">
                                    <th class="border-0 rounded-start" style="width:5%">No.</th>
                                    <th class="border-0">Soal</th>
                                    <th class="border-0 rounded-end" style="width:15%">Aksi</th>
                                </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutAdmin from '../../../Layouts/Admin.vue';

//import Heade and Link from Inertia
import {
    Head,
    Link
} from '@inertiajs/inertia-vue3';

export default {

    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
        Link,
    },

    //props
    props: {
        errors: Object,
        exam: Object,
    },

}

</script>

<style>

</style>
