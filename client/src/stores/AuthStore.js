import { makeAutoObservable } from "mobx";
import { authApi, usersApi } from "../api";
import { fromPromise } from "mobx-utils";

class AuthStore {
  authenticatedUser = undefined;
  isAuthorized = false;

  login(login, password) {
    return authApi.login(login, password)
      .then(data => {
        if (data.status == 200) {
          this.isAuthorized = true;

          const authenticatedUserPromise = usersApi.getById(data.data.authenticatedUserId)
            .then(userRes => {
              return usersApi.getRolesByUserId(data.data.authenticatedUserId)
                .then(rolesRes => {
                  return { ...userRes.data, ...{ "roles": rolesRes.data.roles } }
                })
            });

          this.authenticatedUser = fromPromise(authenticatedUserPromise);
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

  constructor() {
    makeAutoObservable(this);
  }
}

export default AuthStore;