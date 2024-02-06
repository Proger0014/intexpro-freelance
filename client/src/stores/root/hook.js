import { useContext } from "react";
import { RootStoreContext } from "../../providers/store";

function useStores() {
  const context = useContext(RootStoreContext);

  if (!context) {
    throw new Error("Вы забыли про сторы");
  }

  return context;
}

export default useStores;
