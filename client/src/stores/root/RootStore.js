class RootStore {
  authStore;

  constructor({ authStore }) {
    this.authStore = authStore;
  }
}

export default RootStore;