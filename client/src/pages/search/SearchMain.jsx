import { Box, Divider } from "@mantine/core";
import { OrderPreview } from "../../components/order";

function OrderPreviewList(orders) {
  const list = orders.map(order => (
    <>
      <OrderPreview
        title={order.title}
        description={order.description}
        category={order.category}
        expires={order.expires}  />
      
      <Divider size="sm" />
    </>
  ));

  return (
    <Box>
      {list}
    </Box>
  )
}

function SearchMain() {
    return (
        <></>
    );
}

export default SearchMain;