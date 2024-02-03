import { createBrowserRouter } from "react-router-dom";
import { HOME_ROUTE, HomePage } from "../pages";

const routes = createBrowserRouter([
  {
    path: HOME_ROUTE,
    element: <HomePage />
  }
]);

export default routes;