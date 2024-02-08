import { action, flow, makeObservable, observable } from "mobx";
import { fromPromise } from "mobx-utils";
import { ordersApi, ordersRequestApi } from "../api";
import { STATUS_ORDER_REQUEST_NOTHING, STATUS_ORDER_REQUEST_ACCEPTED, STATUS_ORDER_REQUEST_CANCELED, STATUS_ORDER_REQUEST_WAITING } from "../config";

const orderRequestBase = { data: { status: STATUS_ORDER_REQUEST_NOTHING }, canRequest: true };

class OrderStore {
  order = undefined;
  request = undefined;

  fetchOrderRequest(orderId) {
    if (this.authStore.authenticatedUser.roles.find(role => role.name == "executor") ?? false) {
      const requestOrderPromise = ordersRequestApi.getRequestByOrderIdAndUser(orderId)
        .then(resRequest => {
          const orderRequestObject = {
            canRequest: resRequest.data.status == STATUS_ORDER_REQUEST_NOTHING,
          };

          switch(resRequest.data.status) {
            case STATUS_ORDER_REQUEST_WAITING:
              orderRequestObject.additional.message = "Запрос ещё ожидает ответа";
              break;

            case STATUS_ORDER_REQUEST_ACCEPTED:
              orderRequestObject.additional.message = "Запрос одобрен";
              break;

            case STATUS_ORDER_REQUEST_CANCELED:
              orderRequestObject.additional.message = "Запрос отклонен";
              break;
          }

          return { ...resRequest.data, ...orderRequestObject };
        }).catch(resError => {
          return orderRequestBase;
        });

      this.request = fromPromise(requestOrderPromise);
    }
  }

  fetchOrder(orderId) {

    const orderPromise = ordersApi.getById(orderId)
      .then(resOrder => {
        return resOrder.data;
      });


    this.order = fromPromise(orderPromise);

    this.order.then(value => {
      this.fetchOrderRequest(value.id);
    })
  }

  constructor(authStore) {
    makeObservable(this, {
      order: observable,
      request: observable,
      fetchOrder: action,
      fetchOrderRequest: action
    });

    this.authStore = authStore;
  }
}

export default OrderStore;