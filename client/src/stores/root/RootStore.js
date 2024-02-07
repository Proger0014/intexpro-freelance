class RootStore {
  constructor({ authStore, paginationStore }) {
    this.authStore = authStore;
    this.paginationStore = paginationStore;
  }
}

export default RootStore;