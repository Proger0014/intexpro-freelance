import { createContext } from "react";
import { RootStore } from "../../stores";
import { stores } from "./stores";

const rootStore = new RootStore({...stores});

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