import { makeAutoObservable } from "mobx";

class PaginationStore {
    totalPages = 1;
    currentPage = 1;

    setPage(page) {
        if (page > total || page < 0) return;

        this.currentPage = page;
    }

    setTotalPages(totalPages) {
        this.totalPages = totalPages;
    }

    constructor() {
        makeAutoObservable(this);
    }
}

export default PaginationStore;