import { createBrowserRouter } from "react-router-dom";
import { HOME_ROUTE, HomePage, ORDER_ROUTE, OrderPage, SEARCH_ROUTE, SearchPage } from "../pages";

const routes = createBrowserRouter([
  {
    path: HOME_ROUTE,
    element: <HomePage />
  },
  {
    path: SEARCH_ROUTE,
    element: <SearchPage />
  },
  {
    path: ORDER_ROUTE,
    element: <OrderPage />
  }
]);

export default routes;