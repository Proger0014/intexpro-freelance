import { RouterProvider, createBrowserRouter } from "react-router-dom";
import { routes } from "../config";

function RoutingProvider() {
  return (
    <RouterProvider router={routes} />
  )
}

export default RoutingProvider;