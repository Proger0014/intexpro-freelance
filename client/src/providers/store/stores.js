import { AuthStore, OrderStore, PaginationStore, SearchStore } from "../../stores";

const stores = { };

// domain
stores.authStore = new AuthStore();
stores.orderStore = new OrderStore(stores.authStore);

// ui
stores.paginationStore = new PaginationStore();
stores.searchStore = new SearchStore(stores.paginationStore);

export { stores };