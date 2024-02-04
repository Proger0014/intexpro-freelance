import { ModalsProvider as MantineModalsProvider } from "@mantine/modals"

function ModalsProvider({ children }) {
  return (
    <MantineModalsProvider>
      {children}
    </MantineModalsProvider>
  )
}

export default ModalsProvider;