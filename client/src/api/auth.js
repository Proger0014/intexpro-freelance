import { api } from ".";

function login({ login, password }) {
  return api.post("/auth/login", {
    login: login,
    password: password
  });
}

function logout() {
  return api.post("/auth/logout");
}

export { login, logout };