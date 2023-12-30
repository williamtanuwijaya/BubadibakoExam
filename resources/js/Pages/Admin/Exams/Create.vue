<template>
    <Head>
        <title>Tambah Ujian - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link href="/admin/exams" class="btn btn-md btn-primary border-0 shadow mb-3" type="button"><i class="fa fa-long-arrow-alt-left me-2"></i> Kembali</Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-edit"></i> Tambah Ujian</h5>
                        <hr>
                        <form @submit.prevent="submit">

                            <div class="mb-4">
                                <label>Nama Ujian</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Ujian" v-model="form.nama_ujian">
                                <div v-if="errors.nama_ujian" class="alert alert-danger mt-2">
                                    {{ errors.nama_ujian }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Mata Pelajaran</label>
                                        <select class="form-select" v-model="form.id_mapel">
                                            <option v-for="(lesson, index) in lessons" :key="index" :value="lesson.id_mapel">{{ lesson.nama_mapel }}</option>
                                        </select>
                                        <div v-if="errors.id_mapel" class="alert alert-danger mt-2">
                                            {{ errors.id_mapel }}
                                        </div>
                                    </div>
                                </div>
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
                            </div>


                            <div class="mb-4">
                                <label>Deskripsi</label>
                                <Editor
                                    api-key="no-api-key"
                                    v-model="form.deskripsi"
                                    :init="{
                                        menubar: false,
                                        plugins: 'lists link image emoticons',
                                        toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image emoticons'
                                    }"
                                />
                                <div v-if="errors.deskripsi" class="alert alert-danger mt-2">
                                    {{ errors.deskripsi }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Acak Soal</label>
                                        <select class="form-select" v-model="form.pertanyaan_acak">
                                            <option value="Y">Y</option>
                                            <option value="N">N</option>
                                        </select>
                                        <div v-if="errors.pertanyaan_acak" class="alert alert-danger mt-2">
                                            {{ errors.pertanyaan_acak }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Acak Jawaban</label>
                                        <select class="form-select" v-model="form.jawaban_acak">
                                            <option value="Y">Y</option>
                                            <option value="N">N</option>
                                        </select>
                                        <div v-if="errors.jawaban_acak" class="alert alert-danger mt-2">
                                            {{ errors.jawaban_acak }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Tampilkan Hasil</label>
                                        <select class="form-select" v-model="form.hasil">
                                            <option value="Y">Y</option>
                                            <option value="N">N</option>
                                        </select>
                                        <div v-if="errors.hasil" class="alert alert-danger mt-2">
                                            {{ errors.hasil }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Durasi (Menit)</label>
                                        <input type="number" min="1" class="form-control" placeholder="Masukkan Durasi Ujian (Menit)" v-model="form.durasi">
                                        <div v-if="errors.durasi" class="alert alert-danger mt-2">
                                            {{ errors.durasi }}
                                        </div>
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

//import tinyMCE
import Editor from '@tinymce/tinymce-vue';

export default {

    //layout
    layout: LayoutAdmin,
    //register components
    components: {
        Head,
        Link,
        Editor
    },
    //props
    props: {
        errors: Object,
        lessons: Array,
        classrooms: Array,
    },
    //inisialisasi composition API
    setup() {
        //define form with reactive
        const form = reactive({
            nama_ujian: '',
            id_mapel: '',
            id_kelas: '',
            durasi: '',
            deskripsi: '',
            pertanyaan_acak: '',
            jawaban_acak: '',
            hasil: '',
        });

        //method "submit"
        const submit = () => {

            //send data to server
            Inertia.post('/admin/exams', {
                //data
                nama_ujian: form.nama_ujian,
                id_mapel: form.id_mapel,
                id_kelas: form.id_kelas,
                durasi: form.durasi,
                deskripsi: form.deskripsi,
                pertanyaan_acak: form.pertanyaan_acak,
                jawaban_acak: form.jawaban_acak,
                hasil: form.hasil,
            }, {
                onSuccess: () => {
                    //show success alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Ujian Berhasil Disimpan!.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
            });
        }
        return {
            form,
            submit,
        };
    }
}
</script>

<style>

</style>
