<template>
    <div>
        <div v-if="ticketsIsLoading">
            <p>Loading...</p>
        </div>
        <div v-else class="container">
            <vue-good-table
                :columns="columns"
                :rows="getAllTickets"
                :pagination-options="{
                    enabled: true,
                    mode: 'records'
                }"
                :search-options="{
                enabled: true
                }"
            />
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState} from "vuex";

export default {
    name: "Tickets-Index",
    computed: {
        ...mapState(['tickets']),
        ...mapActions(['resetTicketsState', 'fetchAllTickets', 'ticketsLoading']),
        ...mapGetters([
            'ticketsIsLoading',
            'getAllTickets',
        ]),
    },
    data() {
        return {
            columns: [
                {
                    label: 'ID',
                    field: 'id',
                },
                {
                    label: 'Név',
                    field: 'person_name',
                },
                {
                    label: 'E-mail',
                    field: 'person_email',
                },
                {
                    label: 'Tárgy',
                    field: 'subject',
                },
                {
                    label: 'Üzenet',
                    field: 'message',
                },
                {
                    label: 'Esedékesség',
                    field: 'due_date',
                },
                {
                    label: 'Létrehozva',
                    field: 'created_at',
                },
            ],
        }
    },
    async created() {
        await this.$store.dispatch("ticketsLoading", true)
        await this.$store.dispatch('fetchAllTickets')
        await this.$store.dispatch('ticketsLoading', false)
    },
}
</script>

<style scoped>

</style>
