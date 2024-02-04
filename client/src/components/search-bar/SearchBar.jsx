import { Avatar, Box, Button, CloseButton, Group, TextInput, UnstyledButton } from "@mantine/core";
import { useForm } from "@mantine/form";
import { IconSearch, IconAdjustmentsHorizontal } from "@tabler/icons-react";
import { Link } from "react-router-dom";

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
          rightSection={<Avatar component={UnstyledButton} onClick={() => console.log("click")} radius="sm" bg="gray.2" w="36px" h="36px">
            <IconSearch />
          </Avatar>} />
        <Avatar component={Link} radius="sm" bg="gray.2" h="36px" w="36px">
          <IconAdjustmentsHorizontal/>
        </Avatar>
      </Group>
    </form>
  );
}

export default SearchBar;