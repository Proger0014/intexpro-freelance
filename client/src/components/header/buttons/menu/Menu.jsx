import { Box, Button, Menu as MantineMenu, Text } from "@mantine/core";
import { observer } from "mobx-react-lite";
import { useStores } from "../../../../stores";
import { Link } from "react-router-dom";
import { IconSettings, IconLogout } from "@tabler/icons-react";
import c from "./menu.module.scss";
import { useEffect, useState } from "react";
import { rolesUtils } from "../../../../utils";

function handleLogout(authStore) {
    authStore.logout();
}

function Menu() {
    const { authStore } = useStores();

    const userName = `${authStore.authenticatedUser?.firstName} ${authStore.authenticatedUser?.lastName}`;
    
    console.log(authStore.authenticatedUser);

    const rolesBlocks = authStore.authenticatedUser?.roles?.map(role => (
      <Text key={role.id}>{rolesUtils.translateRole(role.name)}</Text>
    ));

    return (
        <MantineMenu position="bottom-end" classNames={c.menu}>
            <MantineMenu.Target>
                <Button bg="gray.6">Меню</Button>
            </MantineMenu.Target>

            <MantineMenu.Dropdown className={c.dropdowns} w={250}>
                <Box p={5}>
                    <Text fz="xl" ta="center">{userName}</Text>

                    Роли
                    {rolesBlocks}
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