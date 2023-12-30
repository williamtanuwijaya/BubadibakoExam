<template>
    <Head>
        <title>Siswa - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-5 col-12 mb-2">
                        <div class="row">
                            <div class="col-md-6 col-12 mb-2">
                                <Link href="/admin/students/create" class="btn btn-md btn-primary border-0 shadow w-100"
                                      type="button"><i class="fa fa-plus-circle"></i>
                                    Tambah</Link>
                            </div>
                            <div class="col-md-6 col-12 mb-2">
                                <Link href="routes('admin.students.import')" class="btn btn-md btn-success border-0 shadow w-100 text-white"
                                      type="button"><i class="fa fa-file-excel"></i>
                                    Import</Link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-12 mb-2">
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
                                    <th class="border-0">Nisn</th>
                                    <th class="border-0">Nama</th>
                                    <th class="border-0">Kelas</th>
                                    <th class="border-0">Jenis Kelamin</th>
                                    <th class="border-0">Password</th>
                                    <th class="border-0 rounded-end" style="width:15%">Aksi</th>
                                </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>
                                <tr v-for="(student, index) in students.data" :key="index">
                                    <td class="fw-bold text-center">
                                        {{ ++index + (students.current_page - 1) * students.per_page }}</td>
                                    <td>{{ student.nisn }}</td>
                                    <td>{{ student.nama }}</td>
                                    <td class="text-center">{{ student.classrooms.nama_kelas }}</td>
                                    <td class="text-center">{{ student.jenis_kelamin }}</td>
                                    <td>{{ student.kata_sandi }}</td>
                                    <td class="text-center">
                                        <Link :href="`/admin/students/${student.id_pelajar}/edit`" class="btn btn-sm btn-info border-0 shadow me-2" type="button"><i class="fa fa-pencil-alt"></i></Link>
                                        <button @click.prevent="destroy(student.id_pelajar)" class="btn btn-sm btn-danger border-0"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="students.links" align="end" />
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

//import sweet alert2
import Swal from 'sweetalert2';

//import inertia adapter
import {
    Inertia
} from '@inertiajs/inertia';

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
        students: Object,
    },

    //inisialisasi composition API
    setup() {

        //define state search
        const search = ref('' || (new URL(document.location)).searchParams.get('q'));

        //define method search
        const handleSearch = () => {
            Inertia.get('/admin/students', {

                //send params "q" with value from state "search"
                q: search.value,
            });
        }
        //define method destroy
        const destroy = (id_pelajar) => {
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

                        Inertia.delete(`/admin/students/${id_pelajar}`);

                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Siswa Berhasil Dihapus!.',
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
