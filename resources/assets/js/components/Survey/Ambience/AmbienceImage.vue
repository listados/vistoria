<template>
    <div>

    </div>
</template>

<script>
export default {
    props: {
        idSurvey: Number
    },
    data() {
        return {

        }
    },
    created() {
        console.log('id' , this.idSurvey)
        this.getAmbience();
    },
    methods: {
        getAmbience() {
            axios.get(process.env.MIX_SENTRY_DSN_PUBLIC+'/api/files_ambience/show/' + this.idSurvey)
            .then( res => {
                console.log({res})
            })
        }
    }
}
</script>

<style>

</style>