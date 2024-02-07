import { Group, Image, Stack, Text, Button } from "@mantine/core";
import HomeLinks from "./HomeLinks";

function Link({ logo, title }) {
  return (
    <Button bg="none" h={150}>
        <Stack align="center">
          <Image
            h={90}
            w={90}
            src={logo} />
        <Text c="gray.9">{title}</Text>
      </Stack>
    </Button>
  )
}

function HomeMain({ ...props }) {
  const homeLinks = HomeLinks.map((homeLink) => (
    <Link 
      key={homeLink.logo}
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