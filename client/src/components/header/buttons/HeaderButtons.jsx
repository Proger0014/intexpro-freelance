import { useStores } from "../../../stores";
import { observer } from "mobx-react-lite";
import LoginButton from "./LoginButton";
import { Menu } from "./menu";

function HeaderButtons() {
  const { authStore } = useStores();

  const buttons = authStore.isAuthorized
    ? <Menu />
    : <LoginButton />

  return (
    <>
      {buttons}
    </>
  )
}

export default observer(HeaderButtons);