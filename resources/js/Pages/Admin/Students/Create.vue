<template>
    <Head>
        <title>Tambah Siswa - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link href="/admin/students" class="btn btn-md btn-primary border-0 shadow mb-3" type="button"><i class="fa fa-long-arrow-alt-left me-2"></i> Kembali</Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-user"></i> Tambah Siswa</h5>
                        <hr>
                        <form @submit.prevent="submit">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Nisn</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nisn Siswa" v-model="form.nisn">
                                        <div v-if="errors.nisn" class="alert alert-danger mt-2">
                                            {{ errors.nisn }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nama Siswa" v-model="form.nama">
                                        <div v-if="errors.nama" class="alert alert-danger mt-2">
                                            {{ errors.nama }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Kelas</label>
                                        <select class="form-select" v-model="form.id_kelas">
                                            <option v-for="(classroom, index) in classrooms" :key="index" :value="classroom.id_kelas">{{ classroom.nama_kelas }}</option>
                                        </select>
                                        <div v-if="errors.id_kelas" class="alert alert-danger mt-2">
                                            {{ errors.id_kelas }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-select" v-model="form.jenis_kelamin">
                                            <option value="L">Laki - Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <div v-if="errors.jenis_kelamin" class="alert alert-danger mt-2">
                                            {{ errors.jenis_kelamin }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Masukkan Password" v-model="form.kata_sandi">
                                        <div v-if="errors.kata_sandi" class="alert alert-danger mt-2">
                                            {{ errors.kata_sandi }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" class="form-control" placeholder="Masukkan Konfirmasi Password" v-model="form.kata_sandi_confirmation">
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-md btn-primary border-0 shadow me-2">Simpan</button>
                            <button type="reset" class="btn btn-md btn-warning border-0 shadow">Reset</button>
                        </form>
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

//import reactive from vue
import { reactive } from 'vue';

//import inerita adapter
import { Inertia } from '@inertiajs/inertia';

//import sweet alert2
import Swal from 'sweetalert2';

export default {

    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
        Link
    },

    //props
    props: {
        errors: Object,
        classrooms: Array,
    },

    //inisialisasi composition API
    setup() {

        //define form with reactive
        const form = reactive({
            nisn: '',
            nama: '',
            id_kelas: '',
            jenis_kelamin: '',
            kata_sandi: '',
            kata_sandi_confirmation: ''
        });

        //method "submit"
        const submit = () => {
            console.log(form);
            //send data to server
            Inertia.post('/admin/students', {
                //data
                nisn: form.nisn,
                nama: form.nama,
                id_kelas: form.id_kelas,
                jenis_kelamin: form.jenis_kelamin,
                kata_sandi: form.kata_sandi,
                kata_sandi_confirmation: form.kata_sandi_confirmation
            }, {
                onSuccess: () => {
                    //show success alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Siswa Berhasil Disimpan.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
            });

        }

        //return
        return {
            form,
            submit,
        };

    }

}

</script>

<style>

</style>
