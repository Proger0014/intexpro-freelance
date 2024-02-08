import { action, makeObservable, observable } from "mobx";
import { fromPromise } from "mobx-utils";
import { ordersApi, ordersRequestApi } from "../api";
import { STATUS_ORDER_REQUEST_NOTHING, STATUS_ORDER_REQUEST_ACCEPTED, STATUS_ORDER_REQUEST_CANCELED, STATUS_ORDER_REQUEST_WAITING } from "../config";
import { notifications } from "@mantine/notifications";

const orderRequestBase = { data: { status: STATUS_ORDER_REQUEST_NOTHING }, canRequest: true };

class OrderStore {
  order = undefined;
  request = undefined;

  makeRequest(orderId) {
    if (!(this.authStore.authenticatedUser.roles.find(role => role.name == "executor") ?? false)) return;

    ordersRequestApi.request(orderId)
      .then(_ => {
        return this.fetchOrder(orderId);
      })
      .catch(_ => {
        return this.fetchOrder(orderId);
      });
  }

  fetchOrderRequest(orderId) {
    if (this.authStore.authenticatedUser.roles.find(role => role.name == "executor") ?? false) {
      const requestOrderPromise = ordersRequestApi.getRequestByOrderIdAndUser(orderId)
        .then(resRequest => {
          const orderRequestObject = {
            canRequest: false,
            additional: {}
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
        }).catch(_ => {
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


    const fetchResult = orderPromise.then(value => {
      this.fetchOrderRequest(value.id);

      return value;
    });

    this.order = fromPromise(fetchResult);
  }

  constructor(authStore) {
    makeObservable(this, {
      order: observable,
      request: observable,
      fetchOrder: action,
      fetchOrderRequest: action,
      makeRequest: action
    });

    this.authStore = authStore;
  }
}

export default OrderStore;