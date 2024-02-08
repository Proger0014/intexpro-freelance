import { api } from ".";

function request(orderId) {
  return api.post(`/orders/${orderId}/request`);
}

function requestIsExists(orderId) {
  return api.get(`/orders/${orderId}/request/exists`);
}

function getRequestByOrderIdAndUser(orderId) {
  return api.get(`/orders/${orderId}/request`);
}

export { request, requestIsExists, getRequestByOrderIdAndUser };