import { makeAutoObservable } from "mobx";
import { authApi } from "../api";

class AuthStore {
  login(login, password) {
    authApi.login(login, password)
      .then(data => {
        console.log(data.data);
      })
      .catch((error) => {
        console.log(error);
      })
  }

  logout() {

  }

  constructor() {
    makeAutoObservable(this);
  }
}

export default AuthStore;