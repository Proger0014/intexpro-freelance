import { createBrowserRouter } from "react-router-dom";
import { HOME_ROUTE, HomePage, SEARCH_ROUTE, SearchPage } from "../pages";

const routes = createBrowserRouter([
  {
    path: HOME_ROUTE,
    element: <HomePage />
  },
  {
    path: SEARCH_ROUTE,
    element: <SearchPage />
  }
]);

export default routes;