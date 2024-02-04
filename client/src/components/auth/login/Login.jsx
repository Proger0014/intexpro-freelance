import { Modal } from "@mantine/core";

function Login() {

  return (
    <Modal
      opened={true}
      overlayProps={{
        backgroundOpacity: 0.5,
        blur: 3
      }}>
      Modal
    </Modal>
  )
}

export default Login;