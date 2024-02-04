import { RoutingProvider, StoreProvider, ThemeProvider } from "./";

function CommonProvider() {
  return (
    <ThemeProvider>
      <StoreProvider>
        <RoutingProvider />
      </StoreProvider>
    </ThemeProvider>
  )
}

export default CommonProvider;