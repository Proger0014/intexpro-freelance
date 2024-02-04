import { ModalsProvider, NotificationsProvider, RoutingProvider, StoreProvider, ThemeProvider } from "./";

function CommonProvider() {
  return (
    <ThemeProvider>
      <ModalsProvider>
          <StoreProvider>
            <NotificationsProvider />
            <RoutingProvider />
          </StoreProvider>
      </ModalsProvider>
    </ThemeProvider>
  )
}

export default CommonProvider;