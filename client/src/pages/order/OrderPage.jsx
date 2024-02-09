import { useParams } from "react-router-dom";
import { ContentLayout } from "../../layouts";
import OrderMain from "./OrderMain";
import { useStores } from "../../stores";

const ROUTE = "orders/:id";

function OrderPage() {
  const { orderStore } = useStores();
  const { id } = useParams();

  orderStore.fetchOrder(id);

  return (
    <ContentLayout
      titleTop="Заказ"
      main={<OrderMain orderId={id} />} />
  )
}

export { ROUTE };
export default OrderPage;