import { AuthStore, PaginationStore, SearchStore } from "../../stores";

const paginationStore = new PaginationStore();

const stores = {
  // domain
  authStore: new AuthStore(),

  // ui
  paginationStore: paginationStore,
  searchStore: new SearchStore(paginationStore),
};

export { stores };