import { Group, Title, Text, Stack, Skeleton } from "@mantine/core";

function OrderPreview({ title, description, category, expires, ...props }) {
  const categoryComponent = !category
    ? <Skeleton w={180} h={6} />
    : <Text c="gray.5">{category}</Text>;


  return (
    <Stack {...props} >
      <Title fz="lg">{title}</Title>

      <Text>{description}</Text>

      <Group justify="space-between">
        {categoryComponent}
        <Text c="gray.5">{expires}</Text>
      </Group>
    </Stack>
  );
}

export default OrderPreview;