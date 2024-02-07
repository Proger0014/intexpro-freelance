import { makeAutoObservable } from "mobx";
import { fromPromise } from "mobx-utils";
import { ordersApi } from "../api";

class OrderStore {
  order = undefined;

  fetchOrder(orderId) {
    const orderPromise = ordersApi.getById(orderId)
      .then(res => res.data);

    this.order = fromPromise(orderPromise);
  }

  constructor() {
    makeAutoObservable(this);
  }
}

export default OrderStore;