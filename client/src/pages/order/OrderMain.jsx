import { Box, Button, Group, Skeleton, Stack, Text, Title } from "@mantine/core";
import { observer } from "mobx-react-lite";
import { useStores } from "../../stores";
import { STATUS_ORDER_REQUEST_CANCELED, STATUS_ORDER_REQUEST_WAITING } from "../../config";
import { notifications } from "@mantine/notifications";
import { useEffect, useState } from "react";
import { ordersCagoriesApi } from "../../api";
import { ordersCategoriesUtils } from "../../utils";

function OrderInfo({ title, categoryId, expires, description, orderRequest }) {
  const [category, setCategory] = useState(undefined);

  useEffect(() => {
    ordersCagoriesApi.getById(categoryId)
      .then(res => {
        const translatedCategory = ordersCategoriesUtils.translate(res.data.name);
        setCategory(translatedCategory);
      });
  }, [0])

  const categoryComponent = !category
    ? <Skeleton w={180} h={6} />
    : <Text c="gray.5">{category}</Text>;

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
        {categoryComponent}
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

        orderStore.request
          .then(_ =>
            notifications.show({ message: "Запрос успешно отправлен", color: "green" }))
          .catch(_ =>
            notifications.show({ message: "Произошла неизвестная ошибка", color: "red" }));

      }

      const orderRequest = {...orderStore.request.value, handler: handleClick };

      return (
        <OrderInfo 
        title={value.title}
        categoryId={value.categoryId}
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