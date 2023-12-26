<template>
    <Head>
        <title>Mata Pelajaran - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 col-12 mb-2">
                        <Link href="/admin/mata_pelajaran/create" class="btn btn-md btn-primary border-0 shadow w-100" type="button">
                            <i class="fa fa-plus-circle"></i> Tambah
                        </Link>
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
                                    <th class="border-0">Nama Mata Pelajaran</th>
                                    <th class="border-0 rounded-end" style="width:15%">Aksi</th>
                                </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>
                                <tr v-for="(mata_pelajaran, index) in mata_pelajarans.data" :key="index">
                                    <td class="fw-bold text-center">{{ ++index + (mata_pelajarans.current_page - 1) * mata_pelajarans.per_page }}</td>
                                    <td>{{ mata_pelajaran.nama_mapel }}</td>
                                    <td class="text-center">
                                        <Link :href="`/admin/mata_pelajaran/${mata_pelajaran.id_mapel}/edit`" class="btn btn-sm btn-info border-0 shadow me-2" type="button">
                                        <i class="fa fa-pencil-alt"></i>
                                        </Link>
                                        <button @click.prevent="destroy(mata_pelajaran.id_mapel)" class="btn btn-sm btn-danger border-0">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="mata_pelajarans.links" align="end" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// Import layout
import LayoutAdmin from '../../../Layouts/Admin.vue';

// Import component pagination
import Pagination from '../../../Components/Pagination.vue';

// Import Head and Link from Inertia
import { Head, Link } from '@inertiajs/inertia-vue3';

// Import ref from vue
import { ref } from 'vue';

// Import inertia adapter
import { Inertia } from '@inertiajs/inertia';

// Import sweet alert2
import Swal from 'sweetalert2';

export default {
    // Layout
    layout: LayoutAdmin,

    // Register component
    components: {
        Head,
        Link,
        Pagination
    },

    // Props
    props: {
        mata_pelajarans: Object,
    },

    // Initialization of the composition API
    setup() {
        // Define state search
        const search = ref('' || (new URL(document.location)).searchParams.get('q'));

        // Define method search
        const handleSearch = () => {
            Inertia.get('/admin/mata_pelajaran', {
                // Send params "q" with value from state "search"
                q: search.value,
            });
        }

        // Define method destroy
        const destroy = (id_mapel) => {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(`/admin/mata_pelajaran/${id_mapel}`);
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Pelajaran Berhasil Dihapus!.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            });
        }

        // Return
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
