import { api } from ".";

function getById(id) {
  return api.get(`/orders/categories/${id}`);
}

export { getById };