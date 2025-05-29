<template>

    <Head>
        <title>Tambah Ujian - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link href="/admin/exams" class="btn btn-md btn-primary border-0 shadow mb-3" type="button"><i
                    class="fa fa-long-arrow-alt-left me-2"></i> Kembali</Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-edit"></i> Tambah Ujian</h5>
                        <hr>
                        <form @submit.prevent="submit">

                            <div class="mb-4">
                                <label>Nama Ujian</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Ujian"
                                    v-model="form.title">
                                <div v-if="errors.title" class="alert alert-danger mt-2">
                                    {{ errors.title }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Mata Pelajaran</label>
                                        <select class="form-select" v-model="form.lesson_id">
                                            <option v-for="(lesson, index) in lessons" :key="index" :value="lesson.id">
                                                {{ lesson.title }}</option>
                                        </select>
                                        <div v-if="errors.lesson_id" class="alert alert-danger mt-2">
                                            {{ errors.lesson_id }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Kelas</label>
                                        <select class="form-select" v-model="form.classroom_id">
                                            <option v-for="(classroom, index) in classrooms" :key="index"
                                                :value="classroom.id">{{ classroom.title }}</option>
                                        </select>
                                        <div v-if="errors.classroom_id" class="alert alert-danger mt-2">
                                            {{ errors.classroom_id }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-4">
                                <label>Deskripsi</label>
                                <Editor api-key="'bepezp5d90820v5lat1y5yomgvk17f14nksbujco7z7w2v9l'"
                                    v-model="form.description" :init="{
                                        menubar: false,
                                        plugins: 'lists link image emoticons',
                                        toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image emoticons'
                                    }" />
                                <div v-if="errors.description" class="alert alert-danger mt-2">
                                    {{ errors.description }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Acak Soal</label>
                                        <select class="form-select" v-model="form.random_question">
                                            <option value="Y">Y</option>
                                            <option value="N">N</option>
                                        </select>
                                        <div v-if="errors.random_question" class="alert alert-danger mt-2">
                                            {{ errors.random_question }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Acak Jawaban</label>
                                        <select class="form-select" v-model="form.random_answer">
                                            <option value="Y">Y</option>
                                            <option value="N">N</option>
                                        </select>
                                        <div v-if="errors.random_answer" class="alert alert-danger mt-2">
                                            {{ errors.random_answer }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Tampilkan Hasil</label>
                                        <select class="form-select" v-model="form.show_answer">
                                            <option value="Y">Y</option>
                                            <option value="N">N</option>
                                        </select>
                                        <div v-if="errors.show_answer" class="alert alert-danger mt-2">
                                            {{ errors.show_answer }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Durasi (Menit)</label>
                                        <input type="number" min="1" class="form-control"
                                            placeholder="Masukkan Durasi Ujian (Menit)" v-model="form.duration">
                                        <div v-if="errors.duration" class="alert alert-danger mt-2">
                                            {{ errors.duration }}
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
            title: '',
            lesson_id: '',
            classroom_id: '',
            duration: '',
            description: '',
            random_question: '',
            random_answer: '',
            show_answer: '',
        });

        //method "submit"
        const submit = () => {

            //send data to server
            Inertia.post('/admin/exams', {
                //data
                title: form.title,
                lesson_id: form.lesson_id,
                classroom_id: form.classroom_id,
                duration: form.duration,
                description: form.description,
                random_question: form.random_question,
                random_answer: form.random_answer,
                show_answer: form.show_answer,
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

<style></style>
