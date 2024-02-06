import { useStores } from "../../../stores";
import { observer } from "mobx-react-lite";
import LoginButton from "./LoginButton";
import LogoutButton from "./LogoutButton";

function HeaderButtons() {
  const { authStore } = useStores();
  console.log(authStore);

  const buttons = authStore.isAuthorized
    ? <LogoutButton />
    : <LoginButton />

  return (
    <>
      {buttons}
    </>
  )
}

export default observer(HeaderButtons);