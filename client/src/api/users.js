import { api } from ".";

function getById(id) {
    return api.get(`/users/${id}`);
}

function getRolesByUserId(userId) {
  return api.get(`/users/${userId}/roles`);
}

export { getById, getRolesByUserId };