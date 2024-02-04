import { Group, Image, Stack, UnstyledButton, Text, ActionIcon } from "@mantine/core";
import HomeLinks from "./HomeLinks";

function Link({ logo, title }) {
  return (
    <UnstyledButton>
        <Stack align="center">
        <ActionIcon h={90} w={90} bg="none">
          <Image
            h={90}
            w={90}
            src={logo} />
        </ActionIcon>
        <Text>{title}</Text>
      </Stack>
    </UnstyledButton>
  )
}

function HomeMain({ ...props }) {
  const homeLinks = HomeLinks.map((homeLink) => (
    <Link 
      logo={homeLink.logo}
      title={homeLink.title} />
  ))

  return (
    <Group {...props}>
      <Group justify="space-between" w="100%">
        {homeLinks}
      </Group>
    </Group>
  )
}

export default HomeMain;