<template>
    <Head>
        <title>Edit Sesi Ujian - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link href="/admin/exam_sessions" class="btn btn-md btn-primary border-0 shadow mb-3" type="button"><i
                    class="fa fa-long-arrow-alt-left me-2"></i> Kembali</Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fas fa-stopwatch"></i> Edit Sesi</h5>
                        <hr>
                        <form @submit.prevent="submit">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Nama Sesi</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nama Sesi"
                                               v-model="form.sesi_ujian">
                                        <div v-if="errors.sesi_ujian" class="alert alert-danger mt-2">
                                            {{ errors.sesi_ujian }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Ujian</label>
                                        <select class="form-select" v-model="form.id_ujian">
                                            <option v-for="(exam, index) in exams" :key="index" :value="exam.id_ujian">
                                                {{ exam.nama_ujian }}</option>
                                        </select>
                                        <div v-if="errors.id_ujian" class="alert alert-danger mt-2">
                                            {{ errors.id_ujian }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Waktu Mulai</label>
                                        <Datepicker v-model="form.waktu_mulai" />
                                        <div v-if="errors.waktu_mulai" class="alert alert-danger mt-2">
                                            {{ errors.waktu_mulai }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Waktu Selesai</label>
                                        <Datepicker v-model="form.waktu_selesai" />
                                        <div v-if="errors.waktu_selesai" class="alert alert-danger mt-2">
                                            {{ errors.waktu_selesai }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-md btn-primary border-0 shadow me-2">Update</button>
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
import {
    reactive
} from 'vue';

//import inerita adapter
import {
    Inertia
} from '@inertiajs/inertia';

//import sweet alert2
import Swal from 'sweetalert2';

//import datepicker
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

export default {

    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
        Link,
        Datepicker
    },

    //props
    props: {
        errors: Object,
        exam_session: Object,
        exams: Array,
    },

    //inisialisasi composition API
    setup(props) {

        //define form with reactive
        const form = reactive({
            sesi_ujian: props.exam_session.sesi_ujian,
            id_ujian: props.exam_session.id_ujian,
            waktu_mulai: props.exam_session.waktu_mulai,
            waktu_selesai: props.exam_session.waktu_selesai,
        });

        //method "submit"
        const submit = () => {

            //send data to server
            Inertia.put(`/admin/exam_sessions/${props.exam_session.id_sesi_ujian}`, {
                //data
                sesi_ujian: form.sesi_ujian,
                id_ujian: form.id_ujian,
                waktu_mulai: form.waktu_mulai,
                waktu_selesai: form.waktu_selesai,
            }, {
                onSuccess: () => {
                    //show success alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Sesi Ujian Berhasil Diupdate!.',
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
        }

    }

}

</script>

<style>

</style>
