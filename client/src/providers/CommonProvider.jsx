import { RoutingProvider, ThemeProvider } from "./";

function CommonProvider() {
  return (
    <ThemeProvider>
      <RoutingProvider />
    </ThemeProvider>
  )
}

export default CommonProvider;