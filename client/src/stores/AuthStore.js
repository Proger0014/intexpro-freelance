import { makeAutoObservable } from "mobx";
import { authApi } from "../api";

class AuthStore {
  isAuthorized = false;

  login(login, password) {
    return authApi.login(login, password)
      .then(data => {
        this.isAuthorized = true;

        return data;
      })
      .catch((error) => {
        return error.response.data;
      })
  }

  logout() {
    authApi.logout();

    this.isAuthorized = false;
  }

  constructor() {
    makeAutoObservable(this);
  }
}

export default AuthStore;