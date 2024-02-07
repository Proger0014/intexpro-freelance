import { Group, Title, Text } from "@mantine/core";

function OrderPreview({ title, description, category, expires, ...props }) {
  return (
    <Group {...props} >
      <Title>{title}</Title>

      <Text>{description}</Text>

      <Group>
        <Text>{category}</Text>
        <Text c="gray.5">{expires}</Text>
      </Group>
    </Group>
  );
}

export default OrderPreview;