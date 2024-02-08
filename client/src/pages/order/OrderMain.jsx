import { Box, Button, Group, Skeleton, Stack, Text, Title } from "@mantine/core";
import { observer } from "mobx-react-lite";
import { useStores } from "../../stores";
import { STATUS_ORDER_REQUEST_CANCELED, STATUS_ORDER_REQUEST_WAITING } from "../../config";

function OrderInfo({ title, category, expires, description, orderRequest }) {
  const onClick = orderRequest?.canRequest
    ? orderRequest.handler
    : undefined;

  const orderRequestStatus = !orderRequest?.canRequest
    ? (
      <Text c={
        orderRequest?.status == STATUS_ORDER_REQUEST_WAITING
          ? "orange"
          : orderRequest?.status == STATUS_ORDER_REQUEST_CANCELED
          ? "red"
          : "green"
      }>{orderRequest?.additional?.message}</Text>
    ) : undefined;

  return (
    <Stack>
      <Group justify="space-between">
        <Title fz="lg">{title}</Title>
        {orderRequestStatus}
      </Group>

      <Group mb={25} justify="space-between">
        <Text c="gray.5">{category}</Text>
        <Text c="gray.5">{expires}</Text>
      </Group>

      <Text>{description}</Text>

      <Group justify="end" mt={25}>
        <Button onClick={onClick} disabled={!orderRequest?.canRequest} size="compact-md">Откликнуться</Button>
      </Group>
    </Stack>
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

function OrderMain() {
  const { orderStore } = useStores();

  const order = orderStore.order.case({
    pending: () => <SkeletonLoading />,
    fulfilled: (value) => {
      function handleClick() {
        orderStore.makeRequest(value.id);
      }

      const orderRequest = {...orderStore.request.value, handler: handleClick };

      return (
        <OrderInfo 
        title={value.title}
        category={value.categoryId}
        expires={value.expiresAt}
        description={value.description}
        orderRequest={orderRequest} />
      ); 
    }
  });

  return (
    <Box>
      {order}
    </Box>
  )
}

export default observer(OrderMain);