import { RouterProvider, createBrowserRouter } from "react-router-dom";
import { routes } from "../config";

function RoutingProvider() {
  const browserRouter = createBrowserRouter(routes);

  return (
    <RouterProvider router={browserRouter} />
  )
}

export default RoutingProvider;