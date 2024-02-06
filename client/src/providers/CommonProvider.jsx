import { ModalsProvider, NotificationsProvider, RoutingProvider, StoreProvider, ThemeProvider } from "./";

function CommonProvider() {
  return (
    <StoreProvider>
      <ThemeProvider>
        <ModalsProvider>
          <NotificationsProvider />
          <RoutingProvider />
        </ModalsProvider>
      </ThemeProvider>
    </StoreProvider>
  )
}

export default CommonProvider;