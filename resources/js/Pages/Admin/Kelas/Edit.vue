<template>
    <Head>
        <title>Edit Kelas - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link href="/admin/kelas" class="btn btn-md btn-primary border-0 shadow mb-3" type="button"><i class="fa fa-long-arrow-alt-left me-2"></i> Kembali</Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-clone"></i> Edit Kelas</h5>
                        <hr>
                        <form @submit.prevent="submit">

                            <div class="mb-4">
                                <label>Nama Kelas</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Kelas" v-model="form.nama_kelas">

                                <div v-if="errors.nama_kelas" class="alert alert-danger mt-2">
                                    {{ errors.nama_kelas }}
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
            kelas: Object
        },

        //inisialisasi composition API
        setup(props) {

            //define form with reactive
            const form = reactive({
                nama_kelas: props.kelas.nama_kelas,
                id_kelas: props.kelas.id_kelas
            });

            //method "submit"
            const submit = () => {


                //send data to server
                Inertia.put(`/admin/kelas/${props.kelas.id_kelas}`, {
                    //data
                    nama_kelas: form.nama_kelas,
                    id_kelas: form.id_kelas

                }, {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Kelas Berhasil Diupdate!.',
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
            }

        }

    }

</script>

<style>

</style>
