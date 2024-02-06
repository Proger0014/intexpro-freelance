import { Button } from "@mantine/core";
import { useDisclosure } from "@mantine/hooks";
import { Login } from "../../auth";

function LoginButton() {
  const [opened, { open, close }] = useDisclosure(false);

  return (
    <>
      <Login opened={opened} close={close} />
      <Button onClick={open}>Войти</Button>
    </>
  )
}

export default LoginButton;