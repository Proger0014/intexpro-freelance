import { useContext } from "react";
import { RootStoreContext } from "../providers/store";

class RootStore {
  authStore;

  constructor({ authStore }) {
    this.authStore = authStore;
  }
}

function useStores() {
  const context = useContext(RootStoreContext);

  if (!context) {
    throw new Error("Вы забыли про сторы");
  }

  return context;
}


export default RootStore;
export { useStores };