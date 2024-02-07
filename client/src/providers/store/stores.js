import { AuthStore, OrderStore, PaginationStore, SearchStore } from "../../stores";

const paginationStore = new PaginationStore();

const stores = {
  // domain
  authStore: new AuthStore(),
  orderStore: new OrderStore(),

  // ui
  paginationStore: paginationStore,
  searchStore: new SearchStore(paginationStore),
};

export { stores };