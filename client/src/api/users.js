import { api } from ".";

function getById(id) {
    return api.get(`/users/${id}`);
}

export { getById };