.<template>
    <Head>
        <title>Dashboard Siswa - Aplikasi Ujian Online</title>
    </Head>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success border-0 shadow">
                Selamat Datang <strong>{{ auth.student.name }}</strong>
            </div>
        </div>
    </div>
    <div class="row" v-if="exam_groups.length > 0">
        <div class="col-md-6" v-for="(data, index) in exam_groups" :key="index">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5>{{ data.exam_group.exam.title }}</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead>
                            <tr>
                                <td class="fw-bold">Mata Pelajaran</td>
                                <td>{{ data.exam_group.exam.lesson.title }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kelas</td>
                                <td>{{ data.exam_group.student.classroom.title }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Sesi</td>
                                <td>{{ data.exam_group.exam_session.title }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Mulai</td>
                                <td>{{ data.exam_group.exam_session.start_time }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Selesai</td>
                                <td>{{ data.exam_group.exam_session.end_time }}</td>
                            </tr>
                            </thead>
                        </table>
                    </div>

                    <!-- cek waktu selesai -->
                    <div v-if="data.grade.end_time == null">

                        <!-- cek apakah ujian sudah dimulai, tapi waktu masih ada -->
                        <div v-if="examTimeRangeChecker(data.exam_group.exam_session.start_time, data.exam_group.exam_session.end_time)">

                            <div v-if="data.grade.start_time == null">
                                <Link :href="`/student/exam-confirmation/${data.exam_group.id}`" class="btn btn-md btn-success border-0 shadow w-100 mt-2 text-white">Kerjakan</Link>
                            </div>

                            <div v-else>
                                <Link :href="`/student/exam/${data.exam_group.id}/1`" class="btn btn-md btn-info border-0 shadow w-100 mt-2">Lanjut Kerjakan</Link>
                            </div>

                        </div>

                        <div v-else>

                            <!-- ujian belum mulai-->
                            <div v-if="examTimeStartChecker(data.exam_group.exam_session.start_time)">
                                <button class="btn btn-md btn-gray-700 border-0 shadow w-100 mt-2" disabled>Belum Mulai</button>
                            </div>

                            <!-- ujian terlewat -->
                            <div v-if="examTimeEndChecker(data.exam_group.exam_session.end_time)">
                                <button class="btn btn-md btn-danger border-0 shadow w-100 mt-2" disabled>Waktu Terlewat</button>
                            </div>

                        </div>

                    </div>

                    <div v-else>
                        <button class="btn btn-md btn-danger border-0 shadow w-100 mt-2" disabled>Sudah Dikerjakan</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row" v-else>
        <div class="col-md-12">
            <div class="alert alert-danger border-0 shadow">
                <i class="fa fa-info-circle"></i> Tidak ada ujian yang tersedia
            </div>
        </div>
    </div>
</template>

<script>
//import layout student
import LayoutStudent from '../../../Layouts/Student.vue';

//import Link from Inertia
import {
    Link
} from '@inertiajs/inertia-vue3';

export default {

    //layout
    layout: LayoutStudent,

    //register components
    components: {
        Link,
    },

    //register props
    props: {
        exam_groups: Array,
        auth: Object
    }

}

</script>

<style>

</style>
