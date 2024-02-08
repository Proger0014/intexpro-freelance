import { makeAutoObservable } from "mobx";
import { authApi, usersApi } from "../api";
import { fromPromise } from "mobx-utils";
import { makePersistable } from "mobx-persist-store";

const AUTH_STORE = "AUTH_STORE";

class AuthStore {
  authenticatedUserId = -1;
  authenticatedUser = undefined;
  isAuthorized = false;
  loginStatus = undefined;

  fetchUser(authenticatedUserId) {
    const authenticatedUserPromise = usersApi.getById(authenticatedUserId)
      .then(userRes => {
        return usersApi.getRolesByUserId(authenticatedUserId)
          .then(rolesRes => {
            return { ...userRes.data, ...{ "roles": rolesRes.data.roles } }
          })
      });

    this.authenticatedUser = fromPromise(authenticatedUserPromise);
  }

  login(login, password) {
    const loginPromise = authApi.login(login, password)
      .then(data => {
        if (data.status == 200) {
          this.isAuthorized = true;
          this.authenticatedUserId = data.data.authenticatedUserId;

          this.fetchUser(data.data.authenticatedUserId);
        }

        return data;
      })
      .catch((error) => {
        return error.response.data;
      })

    this.loginStatus = fromPromise(loginPromise);
  }

  logout() {
    authApi.logout().then(res => {
      if (res.status < 300) {
        this.authenticatedUser = undefined;
        this.isAuthorized = false;
        this.authenticatedUserId = -1;
      }
    });

  }

  constructor() {
    makeAutoObservable(this);
    makePersistable(this, {
      name: AUTH_STORE,
      properties: [
        "authenticatedUserId",
        "isAuthorized",
      ],
      storage: localStorage
    });
    
    if (this.authenticatedUserId != -1) {
      this.fetchUser(this.authenticatedUserId);
    }
  }
}

export default AuthStore;