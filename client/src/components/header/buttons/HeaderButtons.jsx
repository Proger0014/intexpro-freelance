import { useStores } from "../../../stores";
import LoginButton from "./LoginButton";

function HeaderButtons() {
  const { authStore } = useStores();

  return (
    <LoginButton />
  );
}

export default HeaderButtons;