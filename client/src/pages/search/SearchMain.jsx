import { Box, Divider, Skeleton, UnstyledButton } from "@mantine/core";
import { OrderPreview } from "../../components/order";
import { observer } from "mobx-react-lite";
import { useStores } from "../../stores";
import { Link } from "react-router-dom";

function OrderPreviewList({ orders }) {
  const list = orders.map(order => (
    <Box key={order.id}>
      <UnstyledButton component={Link} to="/asd">
        <OrderPreview
          title={order.title}
          description={order.description}
          category={order.categoryId}
          expires={order.expiresAt}
          py={10}  />
      </UnstyledButton>
      
      <Divider color="indigo.2" />
    </Box>
  ));

  return (
    <Box>
      {list}
    </Box>
  )
}

function SkeletonLoading() {
  return (
    <>
      <Skeleton height={15} width="50%" radius="sm" mb={15} />
      <Skeleton height={8} width="80%" radius="xl" mb={5} />
      <Skeleton height={8} width="70%" radius="xl" mb={25} />
      <Skeleton height={4} width="100%" radius="xl" />
    </>
  )
}

function SearchMain() {
  const { searchStore } = useStores();

  const orders = searchStore.orders.case({
    pending: () => <SkeletonLoading />,
    fulfilled: (value) => <OrderPreviewList orders={value} />
  })


  return (
    <>
      {orders}
    </>
  )
}

export default observer(SearchMain);