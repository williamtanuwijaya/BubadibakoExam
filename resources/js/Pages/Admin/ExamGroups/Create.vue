<template>
    <Head>
        <title>Enrolle Siswa - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link :href="`/admin/exam_sessions/${exam_session.id}`" class="btn btn-md btn-primary border-0 shadow mb-3" type="button"><i
                    class="fa fa-long-arrow-alt-left me-2"></i> Kembali</Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-user-plus"></i> Enrolle Siswa</h5>
                        <hr>
                        <form @submit.prevent="submit">

                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                                    <thead class="thead-dark">
                                    <tr class="border-0">
                                        <th class="border-0 rounded-start" style="width:5%">
                                            <input type="checkbox" v-model="form.allSelected" @change="selectAll" />
                                        </th>
                                        <th class="border-0">Nama Siswa</th>
                                        <th class="border-0">Kelas</th>
                                        <th class="border-0">Jenis Kelamin</th>
                                    </tr>
                                    </thead>
                                    <div class="mt-3"></div>
                                    <tbody>
                                    <tr v-for="student of students" :key="student.id">
                                        <td>
                                            <input type="checkbox" v-model="form.student_id" :id="student.id" :value="student.id" number :checked="form.allSelected" />
                                        </td>
                                        <td>{{ student.name }}</td>
                                        <td class="text-center">{{ student.classroom.title }}</td>
                                        <td class="text-center">{{ student.gender }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div v-if="errors.student_id" class="alert alert-danger mt-2">
                                    {{ errors.student_id }}
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
import {
    computed,
    reactive
} from 'vue';

//import inerita adapter
import {
    Inertia
} from '@inertiajs/inertia';

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
        exam: Object,
        exam_session: Object,
        students: Array,
    },

    //inisialisasi composition API
    setup(props) {

        //define form with reactive
        const form = reactive({
            exam_id: props.exam.id,
            student_id: [],
            allSelected: false,
        });

        //define method "selectAll"
        const selectAll = () => {
            if (form.allSelected) {
                form.student_id = props.students.map(student => student.id);
            } else {
                form.student_id = [];
            }
        }

        //method "submit"
        const submit = () => {

            //send data to server
            Inertia.post(`/admin/exam_sessions/${props.exam_session.id}/enrolle/store`, {
                //data
                exam_id: form.exam_id,
                student_id: form.student_id,
            }, {
                onSuccess: () => {
                    //show success alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Enrolle Siswa Berhasil Disimpan!.',
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
            selectAll,
            submit,
        };

    }

}

</script>

<style>

</style>
