import { Button, Modal, PasswordInput, TextInput } from "@mantine/core";
import { useForm } from "@mantine/form";
import { useStores } from "../../../stores";
import { notifications } from "@mantine/notifications";
import { observer } from "mobx-react-lite";


const handleSubmit = (authStore, value, close, formSetErrors) => {
  authStore.login(value.login, value.password);

  setTimeout(() => {
    authStore.loginStatus.case({
      fulfilled: (value) => {
        notifications.show({ title: "Успешно", message: "Вы успешно вошли", color: "green" });
        close();
      },
      rejected: (value) => {
        if (value.status >= 400) {
          if (value.type == "/errors/invalid-login-or-password") {
            formSetErrors({ login: 'Неверный логин или пароль', password: 'Неверный логин или пароль' });
          }
        }
      }
    })
  }, 3000);
};

function Login({ opened, close }) {
  const { authStore } = useStores();
  
  const form = useForm({
    initialValues: {
      'login': '',
      'password': ''
    },

    validate: {
      login: (value) => (value.length < 8 ? "Логин должен быть не меньше 8 символов" : null),
      password: (value) => (value.length < 8 ? "Пароль должен быть не меньше 8 символов" : null)
    },
  });

  return (
    <Modal
      title="Войти"
      opened={opened}
      onClose={close}
      overlayProps={{
        backgroundOpacity: 0.5,
        blur: 3
      }}>
        <form method="POST" onSubmit={form.onSubmit((values) => handleSubmit(authStore, values, close, form.setErrors))}>
          <TextInput
            label="Логин" { ...form.getInputProps("login") } />

          <PasswordInput
            label="Пароль" { ...form.getInputProps("password") } />

          <Button type="submit" mt={25}>
            Войти
          </Button>
        </form>
    </Modal>
  )
}

export default observer(Login);