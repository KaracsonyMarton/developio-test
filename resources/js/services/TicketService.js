import Vue from "vue";

export default {
    fetchAllTickets() {
        return axios.get("/spa/tickets").catch((error) => {
            console.log(error);
        });
    },
};
