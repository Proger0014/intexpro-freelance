import { Box, Button, Menu as MantineMenu, Text } from "@mantine/core";
import { observer } from "mobx-react-lite";
import { useStores } from "../../../../stores";
import { Link } from "react-router-dom";
import { IconSettings, IconLogout } from "@tabler/icons-react";
import c from "./menu.module.scss";
import { useEffect, useState } from "react";

function handleLogout(authStore) {
    authStore.logout();
}

function Menu() {
    const [userName, setUserName] = useState("");

    const { authStore } = useStores();

    useEffect(() => {
      authStore.authenticatedUser.case({
        fulfilled: (value) => {
          setUserName(`${value.firstName} ${value.lastName}`);
        }
      });
    }, [authStore.authenticatedUser.state]);

    return (
        <MantineMenu position="bottom-end" classNames={c.menu}>
            <MantineMenu.Target>
                <Button bg="gray.6">Меню</Button>
            </MantineMenu.Target>

            <MantineMenu.Dropdown className={c.dropdowns}>
                <Box p={5}>
                    <Text>{userName}</Text>
                </Box>

                <MantineMenu.Divider />
                <MantineMenu.Item component={Link} to="" leftSection={<IconSettings />}>
                    Настройки
                </MantineMenu.Item>
                <MantineMenu.Item color="red" leftSection={<IconLogout />} onClick={() => handleLogout(authStore)}>
                    Выйти
                </MantineMenu.Item>
            </MantineMenu.Dropdown>
        </MantineMenu>
    )
}

export default observer(Menu);