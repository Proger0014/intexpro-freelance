import { action, makeObservable, observable } from "mobx";
import { fromPromise } from "mobx-utils";
import { ordersApi } from "../../api";

class SearchStore {
  orders = undefined;

  fetchPage(page) {
    const pagePromise = ordersApi.getAllInPage(page).then(res => {
      this.paginationStore.setTotalPages(res.data.lastPage);
      this.paginationStore.setPage(res.data.page);

      return res.data.data;
    });

    this.orders = fromPromise(pagePromise);
  }

  constructor(paginationStore) {
    makeObservable(this, {
      orders: observable,
      fetchPage: action
    });

    this.paginationStore = paginationStore;
  }
}

export default SearchStore;