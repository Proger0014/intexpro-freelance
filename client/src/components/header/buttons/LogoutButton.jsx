import { Button } from "@mantine/core";
import { useStores } from "../../../stores";

function handleLogout(authStore) {
    
    authStore.logout();
}

function LogoutButton() {
    const { authStore } = useStores();

    return (
        <Button onClick={() => handleLogout(authStore)}>Выйти</Button>
    )
}

export default LogoutButton;