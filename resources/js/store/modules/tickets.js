import TicketService from "../../services/TicketService";

const defaultState = () => ({
    loading: true,
    all: null,
});

const state = defaultState();

const actions = {
    async resetTicketsState({commit}) {
        await commit('RESET_TICKETS_STATE')
    },
    async fetchAllTickets({commit}) {
        const serverResponse = await TicketService.fetchAllTickets();
        await commit("SET_TICKETS", serverResponse.data)
    },
    async ticketsLoading({commit}, payload) {
        await commit("TICKETS_LOADING", payload)
    },
};

const mutations = {
    RESET_TICKETS_STATE: (state) => Object.assign(state, defaultState()),
    TICKETS_LOADING: (state, payload) => state.loading = payload,
    SET_TICKETS: (state, tickets) => (state.all = tickets),
};

const getters = {
    ticketsIsLoading: (state) => state.loading,
    getAllTickets: (state) => state.all,
};

export default {
    state,
    getters,
    actions,
    mutations,
};
