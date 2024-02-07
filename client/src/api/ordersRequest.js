import { api } from ".";

function request(orderId) {
  return api.post(`/orders/${orderId}/request`);
}

function requestIsExists(orderId) {
  return api.get(`/orders/${orderId}/exists`);
}

export { request, requestIsExists };