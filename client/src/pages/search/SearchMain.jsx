import { Box, Divider, Skeleton, UnstyledButton } from "@mantine/core";
import { OrderPreview } from "../../components/order";
import { observer } from "mobx-react-lite";
import { useStores } from "../../stores";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import { ordersCagoriesApi } from "../../api";
import { ordersCategoriesUtils } from "../../utils";

function OrderPreviewListItem({ id, title, description, categoryId, expiresAt }) {
  const [category, setCategory] = useState(undefined);

  useEffect(() => {
    ordersCagoriesApi.getById(categoryId).then(res => {
      setCategory(ordersCategoriesUtils.translate(res.data.name));
    })
  }, [0]);

  return (
    <Box>
      <UnstyledButton component={Link} to={`/orders/${categoryId}`}>
        <OrderPreview
          title={title}
          description={description}
          category={category}
          expires={expiresAt}
          py={10}  />
      </UnstyledButton>
      
      <Divider color="indigo.2" />
    </Box>
  )
}

function OrderPreviewList({ orders }) {
  const list = orders.map(order => (
    <OrderPreviewListItem
      key={order.id}
      id={order.id}
      title={order.title}
      description={order.description}
      categoryId={order.categoryId}
      expiresAt={order.expiresAt}  />
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