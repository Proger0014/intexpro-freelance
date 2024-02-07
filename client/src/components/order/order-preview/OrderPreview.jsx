import { Group, Title, Text, Stack } from "@mantine/core";

function OrderPreview({ title, description, category, expires, ...props }) {
  return (
    <Stack {...props} >
      <Title fz="lg">{title}</Title>

      <Text>{description}</Text>

      <Group justify="space-between">
        <Text c="gray.5">{category}</Text>
        <Text c="gray.5">{expires}</Text>
      </Group>
    </Stack>
  );
}

export default OrderPreview;