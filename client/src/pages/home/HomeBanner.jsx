import { Stack, Text } from "@mantine/core";
import { SearchBar } from "../../components/search-bar";

function HomeBanner({ ...props }) {
  return (
    <Stack { ...props }>
      <Text c="gray.0" fz="xl">
        Улучшай свои навыки программирования, дизайна, web-разработки с помощью задач от INTEXPRO
      </Text>
      <SearchBar />
    </Stack>
  )
}

export default HomeBanner;