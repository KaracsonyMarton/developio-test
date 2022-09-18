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
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Szűrés', // placeholder for filter input
                        filterDropdownItems: [], // dropdown (with selected values) instead of text input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },
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
        this.getFilterValues();
        await this.$store.dispatch('ticketsLoading', false)
    },
    methods: {
        getFilterValues() {
            let filterValues = [];
            this.getAllTickets.forEach((ticket) => {
                filterValues.push(ticket.person_name);
            });
            this.columns[1].filterOptions.filterDropdownItems = [...new Set(filterValues)];
        },
    },
}
</script>

<style scoped>

</style>
