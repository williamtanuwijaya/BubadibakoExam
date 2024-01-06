<template>
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-dark navbar-theme-primary mb-4 shadow">
        <div class="container position-relative">
            <Link class="navbar-brand me-lg-3" href="/pelajar/dashboard">
                <img class="navbar-brand-dark" src="/assets/images/logo.png" style="height:70px">
            </Link>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                </ul>
                <form class="d-flex" v-if="$page.props.auth.pelajars">

                    <Link href="/logout" method="POST" class="btn btn-secondary shadow" as="button">LOGOUT</Link>
                </form>

            </div>
        </div>
    </nav>
    <div class="container">
        <slot />
    </div>
</template>

<script>

    //import Link
    import { Link } from '@inertiajs/inertia-vue3';

    export default {

        //register components
        components: {
            Link
        },

        //  mounted() {
        //     console.log('$page.props.auth:', $page.props.auth); // Check authentication data in the console
        // }
    }


</script>

<style>

</style>
