<template>
    <Head>
        <title>Ujian Dengan Nomor Soal : {{ page }} - Aplikasi Ujian Online</title>
    </Head>
    <div class="row mb-5">
        <div class="col-md-7">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="mb-0">Soal No. <strong class="fw-bold">{{ page }}</strong></h5>
                        </div>
                        <div>
                            <VueCountdown :time="durasi" @progress="handleChangeDuration" @end="showModalEndTimeExam = true" v-slot="{ hours, minutes, seconds }">
                                <span class="badge bg-info p-2"> <i class="fa fa-clock"></i> {{ hours }} jam,
                                    {{ minutes }} menit, {{ seconds }} detik.</span>
                            </VueCountdown>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div v-if="pertanyaan_aktif !== null">

                        <div>
                            <p v-html="pertanyaan_aktif.pertanyaan.pertanyaan"></p>
                        </div>

                        <table>
                            <tbody>
                                <tr v-for="(jawaban, index) in urutan_jawaban" :key="index">
                                    <td width="50" style="padding: 10px;">

                                        <button v-if="jawaban == pertanyaan_aktif.jawaban" class="btn btn-info btn-sm w-100 shdaow">{{ pilihan[index] }}</button>

                                        <button v-else @click.prevent="submitAnswer(pertanyaan_aktif.pertanyaan.ujian.id, pertanyaan_aktif.pertanyaan.id, jawaban)" class="btn btn-outline-info btn-sm w-100 shdaow">{{ pilihan[index] }}</button>

                                    </td>
                                    <td style="padding: 10px;">
                                        <p v-html="pertanyaan_aktif.pertanyaan['pilihan_'+jawaban]"></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div v-else>
                        <div class="alert alert-danger border-0 shadow">
                            <i class="fa fa-exclamation-triangle"></i> Soal Tidak Ditemukan!.
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div class="text-start">
                            <button v-if="page > 1" @click.prevent="prevPage" type="button" class="btn btn-gray-400 btn-sm btn-block mb-2">Sebelumnya</button>
                        </div>
                        <div class="text-end">
                            <button v-if="page < Object.keys(all_pertanyaan).length" @click.prevent="nextPage" type="button" class="btn btn-gray-400 btn-sm">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-0 shadow">
                <div class="card-header text-center">
                    <div class="badge bg-success p-2"> {{ pertanyaan_dijawab }} dikerjakan</div>
                </div>
                <div class="card-body" style="height: 330px;overflow-y: auto">

                    <div v-for="(pertanyaan, index) in all_pertanyaan" :key="index">
                        <div width="20%" style="width: 20%; float: left;">
                            <div style="padding: 5px;">

                                <button @click.prevent="clickQuestion(index)" v-if="index+1 == page" class="btn btn-gray-400 btn-sm w-100">{{ index + 1 }}</button>

                                <button @click.prevent="clickQuestion(index)" v-if="index+1 != page && pertanyaan.jawaban == 0" class="btn btn-outline-info btn-sm w-100">{{ index + 1 }}</button>

                                <button @click.prevent="clickQuestion(index)" v-if="index+1 != page && pertanyaan.jawaban != 0" class="btn btn-info btn-sm w-100">{{ index + 1 }}</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button @click="showModalEndExam = true" class="btn btn-danger btn-md border-0 shadow w-100">Akhiri Ujian</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal akhiri ujian -->
    <div v-if="showModalEndExam" class="modal fade" :class="{ 'show': showModalEndExam }" tabindex="-1" aria-hidden="true" style="display:block;" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Akhiri Ujian ?</h5>
                </div>
                <div class="modal-body">
                    Setelah mengakhiri ujian, Anda tidak dapat kembali ke ujian ini lagi. Yakin akan mengakhiri ujian?
                </div>
                <div class="modal-footer">
                    <button @click.prevent="endExam" type="button" class="btn btn-primary">Ya, Akhiri</button>
                    <button @click.prevent="showModalEndExam = false" type="button" class="btn btn-secondary">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal waktu ujian berakhir -->
    <div v-if="showModalEndTimeExam" class="modal fade" :class="{ 'show': showModalEndTimeExam }" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" style="display:block;" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Waktu Habis !</h5>
                </div>
                <div class="modal-body">
                    Waktu ujian sudah berakhir!. Klik <strong class="fw-bold">Ya</strong> untuk mengakhiri ujian.
                </div>
                <div class="modal-footer">
                    <button @click.prevent="endExam" type="button" class="btn btn-primary">Ya</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    //import layout student
    import LayoutPelajar from '../../../Layouts/Pelajar.vue';

    //import Head and Link from Inertia
    import {
        Head,
        Link
    } from '@inertiajs/inertia-vue3';

    //import ref
    import {
        ref
    } from 'vue';

    //import VueCountdown
    import VueCountdown from '@chenfengyuan/vue-countdown';

    //import axios
    import axios from 'axios';

    //import inertia adapter
    import {
        Inertia
    } from '@inertiajs/inertia';

    //import sweet alert2
    import Swal from 'sweetalert2';

    export default {
        //layout
        layout: LayoutStudent,

        //register components
        components: {
            Head,
            Link,
            VueCountdown
        },

        //props
        props: {
            id: Number,
            page: Number,
            kelompok_ujian: Object,
            all_pertanyaan: Array,
            pertanyaan_dijawab: Number,
            pertanyaan_aktif: Object,
            urutan_jawaban: Array,
            durasi: Object,
        },

        //composition API
        setup(props) {

            //define pilihan for jawaban
            let pilihan = ["A", "B", "C", "D", "E"];

            //define state counter
            const counter = ref(0);

            //define state durasi
            const durasi = ref(props.durasi.durasi);

            //handleChangeDuration
            const handleChangeDuration = (() => {

                //decrement durasi
                durasi.value = durasi.value - 1000;

                //increment counter
                counter.value = counter.value + 1;

                //cek jika durasi di atas 0
                if (durasi.value > 0) {

                    //update durasi if 10 seconds
                    if (counter.value % 10 == 1) {

                        //update durasi
                        axios.put(`/student/durasi-ujian/update/${props.durasi.id}`, {
                            durasi: durasi.value
                        })

                    }

                }

            });

            //metohd prevPage
            const prevPage = (() => {

                //update durasi
                axios.put(`/student/durasi-ujian/update/${props.durasi.id}`, {
                    durasi: durasi.value
                });

                //redirect to prevPage
                Inertia.get(`/student/ujian/${props.id}/${props.page - 1}`);

            });

            //method nextPage
            const nextPage = (() => {

                //update durasi
                axios.put(`/student/durasi-ujian/update/${props.durasi.id}`, {
                    durasi: durasi.value
                });

                //redirect to nextPage
                Inertia.get(`/student/ujian/${props.id}/${props.page + 1}`);
            });

            //method clickQuestion
            const clickQuestion = ((index) => {

                //update durasi
                axios.put(`/student/durasi-ujian/update/${props.durasi.id}`, {
                    durasi: durasi.value
                });

                //redirect to questin
                Inertia.get(`/student/ujian/${props.id}/${index + 1}`);
            });

            //method submit jawaban
            const submitAnswer = ((id_ujian, id_pertanyaan, jawaban) => {

                Inertia.post('/student/ujian-jawaban', {
                    id_ujian: id_ujian,
                    id_sesi_ujian: props.kelompok_ujian.sesi_ujian.id,
                    id_pertanyaan: id_pertanyaan,
                    jawaban: jawaban,
                    durasi: durasi.value
                });

            });

            //define state modal
            const showModalEndExam      = ref(false);
            const showModalEndTimeExam  = ref(false);

            //method endExam
            const endExam = (() => {

                Inertia.post('/pelajar/akhiri-ujian', {
                    id_kelompok_ujian: props.kelompok_ujian.id_kelompok_ujian,
                    id_ujian: props.kelompok_ujian.ujian.id_ujian,
                    id_sesi_ujian: props.kelompok_ujian.sesi_ujian.id_sesi_ujian,
                });

                //show success alert
                Swal.fire({
                    title: 'Success!',
                    text: 'Ujian Selesai!.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 4000
                });

            });

            //return
            return {
                pilihan,
                durasi,
                handleChangeDuration,
                prevPage,
                nextPage,
                clickQuestion,
                submitAnswer,
                showModalEndExam,
                showModalEndTimeExam,
                endExam,
            }

        }
    }

</script>

<style>

</style>
