import { MantineProvider, createTheme } from "@mantine/core";

function ThemeProvider({ children }) {
  const theme = createTheme();

  return (
    <MantineProvider theme={theme}>
      {children}
    </MantineProvider>
  )
}

export default ThemeProvider;