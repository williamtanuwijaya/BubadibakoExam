<template>
    <Head>
        <title>Login Siswa - Aplikasi Ujian Online</title>
    </Head>
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                <div v-if="errors.message" class="alert alert-danger mt-2">
                    {{ errors.message }}
                </div>
                <div v-if="$page.props.session.error" class="alert alert-danger mt-2">
                    {{ $page.props.session.error }}
                </div>
                <div style="text-align: center;">
                    <img src="/assets/images/ppsk.png" alt="logo" style="align-items: center; height: 190px;" class="three-d-logo" >
                    <h5>CBT SMA XAVERIUS 1 PALEMBANG</h5>
                    <h6>by Bubadibako Team</h6>
                </div>
                <form @submit.prevent="submit" class="mt-4">

                    <div class="form-group mb-4">
                        <label for="email">Nisn</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-key"></i>
                            </span>
                            <input type="number" class="form-control" v-model="form.nisn" placeholder="Nisn">
                        </div>
                        <div v-if="errors.nisn" class="alert alert-danger mt-2">
                            {{ errors.nisn }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input type="password" placeholder="Password" class="form-control"
                                       v-model="form.password">
                            </div>
                            <div v-if="errors.password" class="alert alert-danger mt-2">
                                {{ errors.password }}
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-top mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="remember">
                                <label class="form-check-label mb-0" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-gray-800">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutStudent from '../../../Layouts/Student.vue';

//import Head from Inertia
import {
    Head
} from '@inertiajs/inertia-vue3';

//import reactive
import {
    reactive
} from 'vue';

//import inertia adapter
import {
    Inertia
} from '@inertiajs/inertia';

export default {

    //layout
    layout: LayoutStudent,

    //register component
    components: {
        Head
    },

    //props
    props: {
        errors: Object,
    },

    //inisialisasi composition API
    setup() {

        //define form state
        const form = reactive({
            nisn: '',
            password: '',
        });

        //submit method
        const submit = () => {

            //send data to server
            Inertia.post('/students/login', {

                //data
                nisn: form.nisn,
                password: form.password,
            });
        }

        //return
        return {
            form,
            submit
        }
    }

}

</script>

<style>

</style>
