import { api } from ".";

function getAllInPage(page) {
  return api.get("/orders", {
    params: {
      page: page
    }
  })
}

function getById(id) {
  return api.get(`/orders/${id}`);
}

export { getAllInPage, getById };