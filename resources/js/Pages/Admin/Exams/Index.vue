<template>
    <Head>
        <title>Ujian - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 col-12 mb-2">
                        <Link href="/admin/exams/create" class="btn btn-md btn-primary border-0 shadow w-100" type="button"><i
                            class="fa fa-plus-circle"></i>
                            Tambah</Link>
                    </div>
                    <div class="col-md-9 col-12 mb-2">
                        <form @submit.prevent="handleSearch">
                            <div class="input-group">
                                <input type="text" class="form-control border-0 shadow" v-model="search" placeholder="masukkan kata kunci dan enter...">
                                <span class="input-group-text border-0 shadow">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-dark">
                                <tr class="border-0">
                                    <th class="border-0 rounded-start" style="width:5%">No.</th>
                                    <th class="border-0">Ujian</th>
                                    <th class="border-0">Pelajaran</th>
                                    <th class="border-0">Kelas</th>
                                    <th class="border-0">Jumlah Soal</th>
                                    <th class="border-0 rounded-end" style="width:15%">Aksi</th>
                                </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>
                                <tr v-for="(exam, index) in exams.data" :key="index">
                                    <td class="fw-bold text-center">{{ ++index + (exams.current_page - 1) * exams.per_page }}</td>
                                    <td>{{ exam.nama_ujian }}</td>
                                    <td>{{ exam.mata_pelajaran.nama_mapel }}</td>
                                    <td class="text-center">{{ exam.kelas.nama_kelas }}</td>
                                    <td class="text-center">{{ exam.pertanyaan.length }}</td>
                                    <td class="text-center">
                                        <Link :href="`/admin/exams/${exam.id_ujian}`" class="btn btn-sm btn-primary border-0 shadow me-2" type="button"><i class="fa fa-plus-circle"></i></Link>
                                        <Link :href="`/admin/exams/${exam.id_ujian}/edit`" class="btn btn-sm btn-info border-0 shadow me-2" type="button"><i class="fa fa-pencil-alt"></i></Link>
                                        <button @click.prevent="destroy(exam.id_ujian)" class="btn btn-sm btn-danger border-0"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="exams.links" align="end" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutAdmin from '../../../Layouts/Admin.vue';

//import component pagination
import Pagination from '../../../Components/Pagination.vue';

//import Heade and Link from Inertia
import {
    Head,
    Link
} from '@inertiajs/inertia-vue3';

//import ref from vue
import {
    ref
} from 'vue';

//import inertia adapter
import { Inertia } from '@inertiajs/inertia';

//import sweet alert2
import Swal from 'sweetalert2';

export default {
    //layout
    layout: LayoutAdmin,

    //register component
    components: {
        Head,
        Link,
        Pagination
    },

    //props
    props: {
        exams: Object,
    },

    //inisialisasi composition API
    setup() {

        //define state search
        const search = ref('' || (new URL(document.location)).searchParams.get('q'));

        //define method search
        const handleSearch = () => {
            Inertia.get('/admin/exams', {
                //send params "q" with value from state "search"
                q: search.value,
            });
        }

        //define method destroy
        const destroy = (id_ujian) => {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
                .then((result) => {
                    if (result.isConfirmed) {

                        Inertia.delete(`/admin/exams/${id_ujian}`);

                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Ujian Berhasil Dihapus!.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                })
        }
        //return
        return {
            search,
            handleSearch,
            destroy
        }
    }
}

</script>

<style>

</style>
