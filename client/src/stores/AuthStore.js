import { makeAutoObservable } from "mobx";
import { authApi } from "../api";

class AuthStore {
  authenticatedUser = undefined;
  isAuthorized = false;

  login(login, password) {
    return authApi.login(login, password)
      .then(data => {
        if (data.status == 200) {
          this.isAuthorized = true;
        }

        return data;
      })
      .catch((error) => {
        return error.response.data;
      })
  }

  logout() {
    authApi.logout().then(res => {
      if (res.status < 300) {
        this.authenticatedUser = undefined;
        this.isAuthorized = false;
      }
    });

  }

  setAuthenticatedUser(authenticatedUser) {
    this.authenticatedUser = authenticatedUser;
  }

  constructor() {
    makeAutoObservable(this);
  }
}

export default AuthStore;