import { CommonProvider } from "./providers";

import "@mantine/core/styles.css";
import "@mantine/dates/styles.css";
import "@mantine/dropzone/styles.css";
import "@mantine/notifications/styles.css";
import "@mantine/spotlight/styles.css";


function App() {
  return (
    <CommonProvider />
  )
}

export { App };