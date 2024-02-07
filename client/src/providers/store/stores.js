import { AuthStore } from "../../stores";
import { PaginationStore } from "../../stores/ui";

const stores = {
  authStore: new AuthStore(),
  paginationStore: new PaginationStore()
};

export { stores };