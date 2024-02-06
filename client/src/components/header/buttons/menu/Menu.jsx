import { Box, Button, Menu as MantineMenu, Text } from "@mantine/core";
import { observer } from "mobx-react-lite";
import { useStores } from "../../../../stores";
import { Link } from "react-router-dom";
import { IconSettings } from "@tabler/icons-react";
import c from "./menu.module.scss";

function handleLogout(authStore) {
    authStore.logout();
}

function Menu() {
    const { authStore } = useStores();

    console.log(authStore.isAuthorized);
    console.log(authStore.authenticatedUser);

    return (
        <MantineMenu position="bottom-end" classNames={c.menu}>
            <MantineMenu.Target>
                <Button bg="gray.6">Меню</Button>
            </MantineMenu.Target>

            <MantineMenu.Dropdown className={c.dropdowns}>
                <Box p={5}>
                    <Text>asd</Text>
                </Box>

                <MantineMenu.Item component={Link} to="" leftSection={<IconSettings />}>
                    Настройки
                </MantineMenu.Item>

                <MantineMenu.Divider />

                <MantineMenu.Item color="red" onClick={() => handleLogout(authStore)}>
                    Выйти
                </MantineMenu.Item>
            </MantineMenu.Dropdown>
        </MantineMenu>
    )
}

export default observer(Menu);