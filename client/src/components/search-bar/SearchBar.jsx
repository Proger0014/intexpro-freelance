import { ActionIcon, Avatar, Box, Button, CloseButton, Group, TextInput, UnstyledButton } from "@mantine/core";
import { useForm } from "@mantine/form";
import { IconSearch, IconAdjustmentsHorizontal } from "@tabler/icons-react";
import { Link } from "react-router-dom";
import { SEARCH_ROUTE } from "../../pages";
import c from "./search-bar.module.scss";

function handleSearch() {

}

function SearchBar() {
  const form = useForm({
    initialValues: {
      search: ''
    }
  });

  return (
    <form onSubmit={form.onSubmit((values) => console.log(values))}>
      <Group>
        <TextInput
          style={{ flex: 1 }}
          placeholder="Поиск"
          {...form.getInputProps('search')}
          rightSection={<ActionIcon className={c.search} component={Link} to={SEARCH_ROUTE} radius="sm" c="gray" bg="gray.2" w="34.5px" h="34.5px">
            <IconSearch />
          </ActionIcon>} />
        <ActionIcon component={Link} to={SEARCH_ROUTE} c="gray" radius="sm" bg="gray.2" h="36px" w="36px">
          <IconAdjustmentsHorizontal/>
        </ActionIcon>
      </Group>
    </form>
  );
}

export default SearchBar;