import { createContext } from "react";
import { stores } from "./stores";

const rootStore = { ...stores };

const Context = createContext(stores);

function StoreProvider({ children }) {

  return (
    <Context.Provider value={rootStore}>
      {children}
    </Context.Provider>
  )
}

export default StoreProvider;
export { Context as RootStoreContext };