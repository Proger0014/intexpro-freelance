import { makeAutoObservable } from "mobx";

class PaginationStore {
    total = 1;
    currentPage = 1;

    setPage(page) {
        if (page > total || page < 0) return;

        this.currentPage = page;
    }

    setTotal(total) {
        this.total = total;
    }

    constructor() {
        makeAutoObservable(this);
    }
}

export default PaginationStore;