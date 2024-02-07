import { api } from ".";

function getAllInPage(page) {
  return api.get("/orders", {
    params: {
      page: page
    }
  })
}

export { getAllInPage };